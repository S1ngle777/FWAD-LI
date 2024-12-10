<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Оформление заказа') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Контактная информация</h3>
                                
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Имя')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', auth()->user()->name)" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', auth()->user()->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="phone" :value="__('Телефон')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="address" :value="__('Адрес доставки')" />
                                    <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="notes" :value="__('Примечания к заказу')" />
                                    <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-4">Ваш заказ</h3>
                                
                                <div class="space-y-4">
                                    @foreach ($cartItems as $id => $item)
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h4 class="font-medium">{{ $item['name'] }}</h4>
                                                <p class="text-sm text-gray-600">{{ $item['quantity'] }} x {{ $item['price'] }} MDL</p>
                                            </div>
                                            <p class="font-medium">{{ $item['price'] * $item['quantity'] }} MDL</p>
                                        </div>
                                    @endforeach
                                    
                                    <div class="border-t pt-4 mt-4">
                                        <div class="flex justify-between items-center font-bold">
                                            <p>Итого:</p>
                                            <p>{{ $totalPrice }} MDL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 text-right">
                            <x-primary-button class="ml-4">
                                {{ __('Оформить заказ') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>