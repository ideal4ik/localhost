<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; color: green;">
            Добро пожаловать на сайт с огромным количеством интересных тестов!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button id="openButton" class="openButton">Категории:</button>
                    <div id="popupContainer" class="popup">
                        <div class="popup-content" id="popupContent">
                            <span class="close" id="closeButton">&times;</span>
                            <p><a href="#">Пользовательские</a></p>
                            <p><a href="#">От сообщества</a></p>
                            <p><a href="#">Аниме</a></p>
                            <p><a href="#">фильмы</a></p>
                        </div>
                    </div>
                    <script src="{{ asset('js/script.js') }}"></script>
                    <!-- -->
                    <div class="product-catalog">
                        @foreach ($tests as $test)
                        <a href="dashboard/{{ $test->id }}" class="product">
                            <div class="CatalogItemName">{{ $test->name }}</div>
                            <div class="CatalogItemImgContainer"><img src="{{ $test->img }}" alt="" class="CatalogItemImg"></div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
