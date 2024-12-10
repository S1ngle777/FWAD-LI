<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex">
                    <div class="w-1/2">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                        @endif
                    </div>
                    <div class="w-1/2 pl-6">
                        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
                        <p class="text-gray-600 mt-4">{{ $product->description }}</p>
                        <p class="text-lg font-bold mt-2"><?php echo e($product->price); ?> MDL</p>
                        <p class="text-gray-600 mt-2">Кол-во: {{ $product->stock }}</p>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                            @csrf
                            <div class="flex items-center gap-4">
                                <x-text-input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" />
                                <x-primary-button>Добавить в корзину</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>