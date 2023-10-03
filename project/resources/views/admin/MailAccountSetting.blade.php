{{-- <x-app-layout> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache"> 
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                        <form method="post" action="{{ route('teachers.email_account.update') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="MAIL_USERNAME" value="ユーザー名" />
                            <x-text-input id="MAIL_USERNAME" name="MAIL_USERNAME" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_USERNAME']}}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_USERNAME')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_FROM_ADDRESS" value="メールアドレス" />
                            <x-text-input id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_FROM_ADDRESS']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_FROM_ADDRESS')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_FROM_NAME" value="差出人名" />
                            <x-text-input id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_FROM_NAME']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_FROM_NAME')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_PASSWORD" value="パスワード" />
                            <x-text-input id="MAIL_PASSWORD" name="MAIL_PASSWORD" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_PASSWORD']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_PASSWORD')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_MAILER" value="通信プロトコル" />
                            <x-text-input id="MAIL_MAILER" name="MAIL_MAILER" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_MAILER']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_MAILER')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_HOST" value="サーバー名" />
                            <x-text-input id="MAIL_HOST" name="MAIL_HOST" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_HOST']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_HOST')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_ENCRYPTION" value="接続の保護" />
                            <x-text-input id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_ENCRYPTION']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_ENCRYPTION')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_PORT" value="ポート番号" />
                            <x-text-input id="MAIL_PORT" name="MAIL_PORT" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_PORT']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_PORT=')" />
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