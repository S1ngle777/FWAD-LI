<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Молдавские изделия ручной работы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Рекомендуемые категории -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold mb-6">Категории</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach ($categories as $category)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h4 class="text-lg font-semibold">{{ $category->name }}</h4>
                                <p class="text-gray-600 mt-2">{{ Str::limit($category->description, 100) }}</p>
                                <a href="{{ route('categories.show', $category) }}" 
                                   class="mt-4 inline-block text-indigo-600 hover:text-indigo-900">
                                    Просмотреть категорию →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Рекомендуемые продукты -->
            <div>
                <h3 class="text-2xl font-bold mb-6">Рекомендуемые продукты</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                @if ($product->image)
                                    <a href="{{ route('products.show', $product) }}" class="block mb-4">
                                        <img src="{{ Storage::url($product->image) }}" 
                                             alt="{{ $product->name }}"
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
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>