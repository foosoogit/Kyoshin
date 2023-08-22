<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                    <form method="post" action="{{ route('teachers.sendmail') }}" class="mt-6 space-y-6">@csrf
                        <div>
                            <x-input-label for="name_sei" value="生徒番号の読み込み" />
                            <x-text-input id="student_serial" name="student_serial" type="text" class="mt-1 block w-full" autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('student_serial')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
