<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Корзина пуста');
        }

        $totalAmount = 0;
        
        // Проверяем наличие достаточного количества товара
        foreach ($cartItems as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->back()->with('error', "Недостаточно товара {$item['name']} на складе. Доступно: {$product->stock}");
            }
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'notes' => $validated['notes'],
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        // Создаем записи о товарах и уменьшаем их количество
        foreach ($cartItems as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            // Уменьшаем количество товара на складе
            $product = Product::find($id);
            $product->decrement('stock', $item['quantity']);
        }

        // Очищаем корзину
        session()->forget('cart');

        return redirect()->route('orders.success', $order)
            ->with('success', 'Заказ успешно оформлен!');
    }

    public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }

    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (auth()->user()->isAdmin() || auth()->id() === $order->user_id) {
            return view('orders.show', compact('order'));
        }
        return abort(403);
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (!auth()->user()->isAdmin()) {
            return abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $validated['status'];

        // Если заказ отменяется, возвращаем товары на склад
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }
        // Если отмененный заказ возвращается в обработку, снова уменьшаем количество товаров
        elseif ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        }

        $order->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Статус заказа обновлен');
    }

    // Добавим метод для удаления заказа
    public function destroy(Order $order)
    {
        if (!auth()->user()->isAdmin()) {
            return abort(403);
        }

        // Если заказ не отменен, возвращаем товары на склад перед удалением
        if ($order->status !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Заказ успешно удален');
    }

    public function adminIndex()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }
}