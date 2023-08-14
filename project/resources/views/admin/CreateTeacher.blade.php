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
    <link rel="stylesheet" href="{{ asset('/css/studentsList.css')  }}" >
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
                        <x-primary-button onclick="location.href='{{route('dashboard')}}'" >メニューに戻る</x-primary-button>
                    </div>
                    @if($mnge=="modify")
                        <form method="post" action="{{ route('teachers.update', $teacher_inf->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('teachers.store') }}" class="mt-6 space-y-6">
                            @csrf
                    @endif
                        <div>
                            <x-input-label for="serial_teacher" value="講師番号" />{{ $teacher_serial }}
                            <input type="hidden" id="serial_teacher" name="serial_teacher" value="{{ $teacher_serial }}">
                        </div>
                        <div>
                            <x-input-label for="name_sei" value="姓" />
                            <x-text-input id="name_sei" name="name_sei" type="text" class="mt-1 block w-full" :value="old('name_sei',optional($teacher_inf)->name_sei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei" value="名" />
                            <x-text-input id="name_mei" name="name_mei" type="text" class="mt-1 block w-full" :value="old('name_mei',optional($teacher_inf)->name_mei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei')" />
                        </div>
                        <div>
                            <x-input-label for="name_sei_kana" value="セイ" />
                            <x-text-input id="name_sei_kana" name="name_sei_kana" type="text" class="mt-1 block w-full" :value="old('name_sei_kana',optional($teacher_inf)->name_sei_kana)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei_kana')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei_kana" value="名" />
                            <x-text-input id="name_mei_kana" name="name_mei_kana" type="text" class="mt-1 block w-full" :value="old('name_mei_kana',optional($teacher_inf)->name_mei_kana)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei_kana')" />
                        </div>
                        <div>
                            <x-input-label for="email" value="email" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email',optional($teacher_inf)->email)"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        @if($mnge=="modify")
                            <div>
                                {{--<x-primary-button>ログインパスワードの変更</x-primary-button>--}}
                                <button type="button" name="ChngPassBtn" id="ChngPassBtn" onclick="location.href='{{route('teachers.show_change_password',$teacher_inf->id)}}'" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">ログインパスワードの変更</button>
                            </div>
                        @else
                            <div>
                                <x-input-label for="password" value="ログインパスワード" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :value="old('email',optional($teacher_inf)->email)"/>
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                        @endif
                        <div>
                            <x-input-label for="rank" value="閲覧範囲" />
                            {!!$html_rank_ckbox!!}
                            <x-input-error class="mt-2" :messages="$errors->get('rank')" />
                        </div>
                        <div>
                            <x-input-label for="phone" value="電話" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone',optional($teacher_inf)->phone)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="note" value="メモ" />
                            <textarea id="note" name="note" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6">{{ old('note',optional($teacher_inf)->note) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('note')" />
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