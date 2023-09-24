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
                     {{--@if($mnge=="modify")--}}
                        <form method="post" action="{{ route('student.update', $stud_inf->id) }}" class="mt-6 space-y-6" class="form-inline text-right">
                        @csrf
                        @method('PUT')
                        {{--
                            @else
                        <form method="post" action="{{ route('student.store') }}" class="mt-6 space-y-6">
                            @csrf
                    @endif
                    --}}
                        <div>
                            <x-input-label for="serial_student" value="生徒番号" />
                            <x-text-input id="serial_student" name="serial_student" type="text" class="mt-1 block w-full" value="{{optional($stud_inf)->serial_student}}" readonly/>
                            <x-input-error class="mt-2" :messages="$errors->get('serial_student')" />
                            {{--
                            <input type="hidden" id="serial_student" name="serial_student" value="{{ $student_serial }}">
                            <x-text-input id="serial_student" name="serial_student" type="text" class="mt-1 block w-full" readonly value="{{ $student_serial }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('serial_student')" />
                            --}}
                        </div>
                        <div>
                            <x-input-label for="name_sei" value="姓" />
                            <x-text-input id="name_sei" name="name_sei" type="text" class="mt-1 block w-full" :value="old('name_sei',optional($stud_inf)->name_sei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei" value="名" />
                            <x-text-input id="name_mei" name="name_mei" type="text" class="mt-1 block w-full" :value="old('name_mei',optional($stud_inf)->name_mei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei')" />
                        </div>
                        <div>
                            <x-input-label for="name_sei_kana" value="セイ" />
                            <x-text-input id="name_sei_kana" name="name_sei_kana" type="text" class="mt-1 block w-full" :value="old('name_sei_kana',optional($stud_inf)->name_sei_kana)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_sei_kana')" />
                        </div>
                        <div>
                            <x-input-label for="name_mei_kana" value="メイ" />
                            <x-text-input id="name_mei_kana" name="name_mei_kana" type="text" class="mt-1 block w-full" :value="old('name_mei_kana',optional($stud_inf)->name_mei_kana)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name_mei_kana')" />
                        </div>
                        <div>
                            <x-input-label for="course" value="コース" />
                            {!!$html_cource_ckbox!!}
                            {{--                            
                                <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="checkbox" name="course[]" value="学習塾" @if(old('evaluation')=='1') checked @endif> 学習塾</x-input-label>
                                <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="checkbox" name="course[]" value="英会話" @if(old('evaluation')=='2') checked @endif> 英会話</x-input-label>
                            --}}
                            <x-input-error class="mt-2" :messages="$errors->get('course')" />
                        </div>
                        <div class="form-group">
                            <x-input-label for="protector_array[0]" value="送信先宛名-1" class="control-label"/>
                            <x-text-input id="protector_array[0]" name="protector_array[0]" type="text" class="mt-1 block w-full" value="{{ old('protector_array[0]',$protector_array[0]) }}" class="form-control"/>様
                            <x-input-label for="email_array[0]" value="email-1" />
                            <x-text-input id="email_array[0]" name="email_array[0]" type="text" class="mt-1 block w-full" value="{{ old('email_array[0]',$email_array[0]) }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email_array[0]')" />
                        </div>
                        <div class="form-group">
                            <x-input-label for="protector_array[1]" value="送信先宛名-2" class="control-label"/>
                            <x-text-input id="protector_array[1]" name="protector_array[1]" type="text" class="mt-1 block w-full" value="{{ old('protector_array[1]',$protector_array[1]) }}" class="form-control"/>様
                            <x-input-label for="email_array[1]" value="email-2" />
                            <x-text-input id="email_array[1]" name="email_array[1]" type="text" class="mt-1 block w-full" value="{{ old('email_array[1]',$email_array[1]) }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email_array[1]')" />
                        </div> 
                        <div class="form-group">
                            <x-input-label for="protector_array[2]" value="送信先宛名-3" class="control-label"/>
                            <x-text-input id="protector_array[2]" name="protector_array[2]" type="text" class="mt-1 block w-full" value="{{ old('protector_array[2]',$protector_array[2]) }}" class="form-control"/>様
                            <x-input-label for="email_array[2]" value="email-3" />
                            <x-text-input id="email_array[2]" name="email_array[2]" type="text" class="mt-1 block w-full" value="{{ old('email_array[2]',$email_array[2]) }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email_array[2]')" />
                        </div> 
                        <div>
                            <x-input-label for="phone" value="電話" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone',optional($stud_inf)->phone)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        {{--  
                        <div>
                            <x-input-label for="protector" value="保護者氏名" />
                            <x-text-input id="protector" name="protector" type="text" class="mt-1 block w-full" :value="old('protector',optional($stud_inf)->protector)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('protector')" />
                        </div>
                        --}}
                        <div>
                            <x-input-label for="grade" value="学年" />
                            {!!$html_grade_slct!!}
                            <x-input-error class="mt-2" :messages="$errors->get('grade')" />
                        </div>
                        <div>
                            <x-input-label for="elementary" value="小学校名" />
                            <x-text-input id="elementary" name="elementary" type="text" class="mt-1 block w-full" :value="old('elementary',optional($stud_inf)->elementary)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('elementary')" />
                        </div>
                        <div>
                            <x-input-label for="junior_high" value="中学校名" />
                            <x-text-input id="junior_high" name="junior_high" type="text" class="mt-1 block w-full" :value="old('junior_high',optional($stud_inf)->junior_high)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('junior_high')" />
                        </div>
                        <div>
                            <x-input-label for="high_school" value="高校名" />
                            <x-text-input id="high_school" name="high_school" type="text" class="mt-1 block w-full" :value="old('high_school',optional($stud_inf)->junior_high)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('high_school')" />
                        </div>
                        <div>
                            <x-input-label for="note" value="メモ" />
                            <textarea id="note" name="note" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('note',optional($stud_inf)->note) }}</textarea>
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