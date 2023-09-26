@extends('layouts.mail_form_master')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                        {{--
                        @if($mnge=="modify")

                        <form method="post" action="{{ route('student.update', $stud_inf->id) }}" class="mt-6 space-y-6" class="form-inline text-right">
                        @csrf
                        @method('PUT')
                        --}}

                        <div>
                            <x-input-label for="subject" value="件名" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" :value="old('subject',optional($stud_inf)->name_sei)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                        </div>
                        <div>
                            <x-input-label for="message" value="メモ" />
                            <textarea id="message" name="message" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('message',optional($stud_inf)->note) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        </div>
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="flex items-center gap-4">
                            <x-primary-button>送信する</x-primary-button>
                        </div>
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
@endsection