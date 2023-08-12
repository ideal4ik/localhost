<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; color: green;">
            Список ваших тестов
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="product-catalog">
                        @foreach ($tests as $test)
                        <a href="dashboard/{{ $test->id }}" class="product">
                            <div class="CatalogItemName">{{ $test->name }}</div>
                            <div class="CatalogItemImgContainer"><img src="/public/storage/{{ $test->img }}" alt="" class="CatalogItemImg"></div>
                        </a>
                        @endforeach
                        <a href="/test/create" class="product">
                            <div class="CatalogItemName">Создать тест</div>
                            <div class="CatalogItemImgContainer"><img src="{{ asset('images/Add-Button-PNG-Isolated-HD.png') }}" alt="" class="CatalogItemImg"></div>
                        </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
