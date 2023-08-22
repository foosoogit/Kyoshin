{{-- <x-app-layout> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    {{--  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>
    --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                        <form method="post" action="{{ route('student.update', $stud_inf->id) }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="rows_number" value="一覧表の行数" />
                            <x-text-input id="rows_number" name="rows_number" type="text" class="mt-1 block w-full" :value="old('rows_number',optional($stud_inf)->serial_student)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('serial_student')" />
                        </div>
                        <div>
                            <x-input-label for="name_sei" value="学年" />
                            <x-text-input id="name_sei" name="name_sei" type="text" class="mt-1 block w-full" :value="old('name_sei',optional($stud_inf)->name_sei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei" value="コース" />
                            <x-text-input id="name_mei" name="name_mei" type="text" class="mt-1 block w-full" :value="old('name_mei',optional($stud_inf)->name_mei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei')" />
                        </div>
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="flex items-center gap-4">
                            <x-primary-button>登録する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
{{-- </x-app-layout> --}}