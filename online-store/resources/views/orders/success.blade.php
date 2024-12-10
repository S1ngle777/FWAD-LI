<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Заказ оформлен') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <div class="mb-6">
                        <svg class="mx-auto h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Спасибо за заказ!</h3>
                    <p class="text-gray-600 mb-6">Ваш заказ #{{ $order->id }} успешно оформлен.</p>
                    <div class="text-sm text-gray-600 mb-6">
                        <p>Мы отправили подтверждение на {{ $order->email }}</p>
                        <p class="mt-2">Статус заказа: <span class="font-semibold">{{ $order->status }}</span></p>
                    </div>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                            Посмотреть детали заказа
                        </a>
                        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            Продолжить покупки
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>