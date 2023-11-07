<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                    <div>
                        <x-input-label for="student_serial_txt" value="生徒番号の読み込み" />
                        <x-text-input type="text" class="mt-1 block w-full" name="student_serial_txt" autofocus />
                        {{$seated_msg}}{{$student_serial}}
                        @if (session('flash_message'))
                            <div class="flash_message bg-success text-center py-3 my-0">
                                {{$seated_msg}}{{ session('flash_message') }}
                            </div>
                        @endif
                        <x-input-error class="mt-2" :messages="$errors->get('student_serial')" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>