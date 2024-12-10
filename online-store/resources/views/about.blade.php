<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('О нас') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Левая колонка с текстом -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-primary">Молдавские изделия ручной работы</h3>
                        <p class="text-gray-600">
                            Мы - команда увлеченных мастеров, создающих уникальные изделия ручной работы, 
                            которые отражают богатое культурное наследие Молдовы.
                        </p>
                        <p class="text-gray-600">
                            Каждое изделие в нашем магазине - это частичка молдавской культуры, 
                            созданная с любовью и вниманием к деталям. Мы стремимся сохранить 
                            традиционные техники рукоделия, добавляя современные элементы дизайна.
                        </p>
                        
                        <div class="border-l-4 border-primary pl-4 mt-6">
                            <h4 class="text-lg font-semibold mb-2">Наша миссия</h4>
                            <p class="text-gray-600">
                                Сохранение и популяризация молдавского культурного наследия через 
                                создание уникальных hand-made изделий, доступных для ценителей 
                                аутентичного искусства по всему миру.
                            </p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg mt-6">
                            <h4 class="text-lg font-semibold mb-4">Почему выбирают нас:</h4>
                            <ul class="list-disc list-inside space-y-2 text-gray-600">
                                <li>Уникальные авторские работы</li>
                                <li>Традиционные молдавские мотивы</li>
                                <li>Высокое качество материалов</li>
                                <li>Ручная работа</li>
                                <li>Индивидуальный подход к каждому заказу</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Правая колонка с изображениями -->
                    <div class="space-y-6">
                        <img src="{{ asset('storage/about/workshop.jpg') }}" 
                             alt="Наша мастерская" 
                             class="rounded-lg shadow-md w-full h-64 object-cover mb-4">
                        
                        <div class="grid grid-cols-2 gap-4">
                            <img src="{{ asset('storage/about/craftsman1.jpg') }}" 
                                 alt="Мастер за работой" 
                                 class="rounded-lg shadow-md w-full h-48 object-cover">
                            <img src="{{ asset('storage/about/craftsman2.jpg') }}" 
                                 alt="Процесс создания" 
                                 class="rounded-lg shadow-md w-full h-48 object-cover">
                        </div>

                        <div class="bg-primary bg-opacity-10 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold mb-4">Контактная информация</h4>
                            <div class="space-y-2 text-gray-600">
                                <p>📍 Кишинёв, Молдова</p>
                                <p>📞 +373 XX XXX XXX</p>
                                <p>✉️ info@moldavianhandmade.md</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>