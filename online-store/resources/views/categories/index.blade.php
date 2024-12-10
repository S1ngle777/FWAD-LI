<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Категории') }}
            </h2>
            @auth
                @if (auth()->user()->isAdmin())
                    <x-primary-button onclick="window.location='{{ route('categories.create') }}'">
                        {{ __('Добавить категорию') }}
                    </x-primary-button>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                            <p class="text-gray-600">{{ $category->description }}</p>
                            <div class="mt-4">
                                <a href="{{ route('categories.show', $category->slug) }}"
                                    class="text-red-600 hover:text-red-900">
                                    Просмотреть продукты
                                </a>
                            </div>
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <div class="mt-4 flex space-x-2 justify-end">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-indigo-600 hover:text-indigo-900 font-bold">Изменить</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 font-bold">Удалить</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
