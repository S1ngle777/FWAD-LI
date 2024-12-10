<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Заказ #') }}{{ $order->id }}
            </h2>
            @if (auth()->user()->isAdmin())
                <div class="flex items-center space-x-4">
                    <form action="{{ route('orders.update-status', $order) }}" method="POST"
                        class="flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        <select name="status"
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>В ожидании
                            </option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                                Обрабатывается</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Завершен
                            </option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Отменен
                            </option>
                        </select>
                        <x-primary-button>Обновить статус</x-primary-button>
                    </form>
                    
                    <form action="{{ route('orders.destroy', $order) }}" method="POST"
                        onsubmit="return confirm('Вы уверены, что хотите удалить этот заказ?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Удалить заказ</x-danger-button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Информация о заказе</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Статус:</span> <span
                                        class="px-2 inline-flex text-s leading-5 font-semibold rounded-full {{ $order->statusBadge['class'] }}">
                                        {{ $order->statusBadge['text'] }}
                                    </span></p>
                                <p><span class="font-medium">Дата заказа:</span>
                                    {{ $order->created_at->format('d.m.Y H:i') }}</p>
                                <p><span class="font-medium">Сумма заказа:</span> {{ $order->total_amount }} MDL</p>
                            </div>

                            <h3 class="text-lg font-semibold mt-6 mb-4">Контактная информация</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Имя:</span> {{ $order->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $order->email }}</p>
                                <p><span class="font-medium">Телефон:</span> {{ $order->phone }}</p>
                                <p><span class="font-medium">Адрес:</span> {{ $order->address }}</p>
                                @if ($order->notes)
                                    <p><span class="font-medium">Примечания:</span> {{ $order->notes }}</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Товары</h3>
                            <div class="space-y-4">
                                @foreach ($order->items as $item)
                                    <div class="flex justify-between items-center border-b pb-4">
                                        <div>
                                            <h4 class="font-medium">{{ $item->product->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $item->quantity }} x
                                                {{ $item->price }} MDL</p>
                                        </div>
                                        <p class="font-medium">{{ $item->quantity * $item->price }} MDL</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
