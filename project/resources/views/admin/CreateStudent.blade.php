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
                        <x-primary-button onclick="location.href='{{route('dashboard')}}'" >メニューに戻る</x-primary-button>
                    </div>
                    {{--  
                        <button type="button" name="ToMenuBtn" id="ToMenuBtn" onclick="location.href='{{route('dashboard')}}'" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">メニューに戻る</button>
                    --}}
                    <form method="post" action="{{ route('student.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="serial_student" value="生徒番号" />{{ $student_serial }}
                            <input type="hidden" id="serial_student" name="serial_student" value="{{ $student_serial }}">
                            {{--
                            <x-text-input id="serial_student" name="serial_student" type="text" class="mt-1 block w-full" readonly value="{{ $student_serial }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('serial_student')" />
                            --}}
                        </div>
                        <div>
                            <x-input-label for="name_sei" value="姓" />
                            <x-text-input id="name_sei" name="name_sei" type="text" class="mt-1 block w-full" :value="old('name_sei')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei" value="名" />
                            <x-text-input id="name_mei" name="name_mei" type="text" class="mt-1 block w-full" :value="old('name_mei')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei')" />
                        </div>
                        <div>
                            <x-input-label for="name_sei_kana" value="セイ" />
                            <x-text-input id="name_sei_kana" name="name_sei_kana" type="text" class="mt-1 block w-full" :value="old('name_sei_kana')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei_kana')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei_kana" value="名" />
                            <x-text-input id="name_mei_kana" name="name_mei_kana" type="text" class="mt-1 block w-full" :value="old('name_mei_kana')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei_kana')" />
                        </div>
                        <div>
                            <x-input-label for="email" value="email" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone" value="電話" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="protector" value="保護者氏名" />
                            <x-text-input id="protector" name="protector" type="text" class="mt-1 block w-full" :value="old('protector')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('protector')" />
                        </div>
                        <div>
                            <x-input-label for="grade" value="学年" />
                            <select id="grade" name="grade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled selected style="display:none;"></option>
                                <option value="{{ $students_array['el1'] }}" @if(old('grade')==$students_array['el1']) selected @endif>{{ $students_array['el1'] }}</option>
                                <option value="{{ $students_array['el2'] }}" @if(old('grade')==$students_array['el2']) selected @endif>{{ $students_array['el2'] }}</option>
                                <option value="{{ $students_array['el3'] }}" @if(old('grade')==$students_array['el3']) selected @endif>{{ $students_array['el3'] }}</option>
                                <option value="{{ $students_array['el4'] }}" @if(old('grade')==$students_array['el4']) selected @endif>{{ $students_array['el4'] }}</option>
                                <option value="{{ $students_array['el5'] }}" @if(old('grade')==$students_array['el5']) selected @endif>{{ $students_array['el5'] }}</option>
                                <option value="{{ $students_array['el6'] }}" @if(old('grade')==$students_array['el6']) selected @endif>{{ $students_array['el6'] }}</option>
                                <option value="{{ $students_array['jh1'] }}" @if(old('grade')==$students_array['jh1']) selected @endif>{{ $students_array['jh1'] }}</option>
                                <option value="{{ $students_array['jh2'] }}" @if(old('grade')==$students_array['jh2']) selected @endif>{{ $students_array['jh2'] }}</option>
                                <option value="{{ $students_array['jh3'] }}" @if(old('grade')==$students_array['jh3']) selected @endif>{{ $students_array['jh3'] }}</option>
                                <option value="{{ $students_array['hs1'] }}" @if(old('grade')==$students_array['hs1']) selected @endif>{{ $students_array['hs1'] }}</option>
                                <option value="{{ $students_array['hs2'] }}" @if(old('grade')==$students_array['hs2']) selected @endif>{{ $students_array['hs2'] }}</option>
                                <option value="{{ $students_array['hs3'] }}" @if(old('grade')==$students_array['hs3']) selected @endif>{{ $students_array['hs3'] }}</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('grade')" />
                        </div>
                        {{--
                        <div>
                            <x-input-label for="evaluation" value="学年" />
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="el1" value="1" @if(old('evaluation')=='1') checked @endif> 1</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="el1" value="2" @if(old('evaluation')=='2') checked @endif> 2</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="el1" value="3" @if(old('evaluation')=='3') checked @endif> 3</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="4" @if(old('evaluation')=='4') checked @endif> 4</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="5" @if(old('evaluation')=='5') checked @endif> 5</x-input-label>
                            <x-input-error class="mt-2" :messages="$errors->get('evaluation')" />
                        </div>
                        
                        <div>
                            <x-input-label for="purchase_date" value="購入日" />
                            <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" :value="old('purchase_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('purchase_date')" />
                        </div>
                        --}}
                        <div>
                            <x-input-label for="note" value="メモ" />
                            <textarea id="note" name="note" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6">{{ old('note') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('note')" />
                        </div>
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