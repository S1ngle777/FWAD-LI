<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Корзина покупок') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (count($cartItems) > 0)
                        <div class="flow-root">
                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @foreach ($cartItems as $id => $item)
                                    <li class="flex py-6">
                                        <div
                                            class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            @if ($item['image'])
                                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}"
                                                    class="h-full w-full object-cover object-center">
                                            @endif
                                        </div>
                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>{{ $item['name'] }}</h3>
                                                    <p class="ml-4"><?php echo e($item['price'] * $item['quantity']); ?> MDL</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="text-gray-500">Кл-во {{ $item['quantity'] }}</p>
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-500">Убрать</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <hr class="my-6 border-t border-gray-200">

                        <div class="mt-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Всего</p>
                                <p>{{ $totalPrice }} MDL</p>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('orders.checkout') }}"
                                    class="flex items-center justify-center rounded-md border border-transparent bg-primary px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-primary-dark">
                                    Оформить заказ
                                </a>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-center">Ваша корзина пуста</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
