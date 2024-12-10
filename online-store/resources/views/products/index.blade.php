<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Товары') }}
            </h2>
            @auth
                @if (auth()->user()->isAdmin())
                    <x-primary-button onclick="window.location='{{ route('products.create') }}'">
                        {{ __('Добавить товар') }}
                    </x-primary-button>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            @if ($product->image)
                                <a href="{{ route('products.show', $product) }}" class="block mb-4">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover transition-opacity hover:opacity-75">
                                </a>
                            @endif
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <p class="text-gray-600">{{ Str::limit($product->description, 100) }}</p>
                            <p class="text-lg font-bold mt-2 text-right"><?php echo e($product->price); ?> MDL</p>
                            @auth
                                <div class="mt-4 text-right">
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <x-primary-button>Добавить в корзину</x-primary-button>
                                    </form>
                                </div>

                                @auth
                                    @if (auth()->user()->isAdmin())
                                        <div class="mt-4 flex space-x-2 justify-end">
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="text-indigo-600 hover:text-indigo-900 font-bold">Изменить</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-bold">Удалить</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
