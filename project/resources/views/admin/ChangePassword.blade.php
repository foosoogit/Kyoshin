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
                    <form method="post" action="{{ route('teachers.store_password') }}" class="mt-6 space-y-6">@csrf
                        <div>
                            <x-input-label for="serial_teacher" value="講師番号" />{{ $teacher_inf->serial_user }}
                            <input type="hidden" id="id_teacher" name="id_teacher" value="{{ $teacher_inf->id }}">
                        </div>
                        <div>
                            @if( session('flash') )
                                @foreach (session('flash') as $key => $item)
                                    <div class="alert alert-{{ $key }} text-danger">{{ session('flash.' . $key) }}</div>
                                @endforeach
                            @endif
                            <x-input-label for="OldPass" value="現在のパスワード" />
                            <x-text-input id="OldPass" name="OldPass" type="Password" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('OldPass')" />
                        </div>
                        <div>
                            <x-input-label for="NewPassword_confirmation" value="新しいパスワード" />
                            <x-text-input id="NewPassword_confirmation" name="NewPassword_confirmation" type="Password" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('NewPassword_confirmation')" />
                        </div>
                        <div>
                            <x-input-label for="NewPassword" value="新しいパスワードの再入力" />
                            <x-text-input id="NewPassword" name="NewPassword" type="Password" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('NewPassword')" />
                        </div>
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="flex items-center gap-4">
                            <x-primary-button>変更する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
{{-- </x-app-layout> --}}