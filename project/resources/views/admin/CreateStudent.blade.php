<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('books.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="serial_student" value="生徒番号" />
                            <x-text-input id="serial_student" name="serial_student" type="text" class="mt-1 block w-full" :value="old('serial_student')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('serial_student')" />
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
                            <x-input-label for="phone" value="名" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="grade" value="学年" />
                            <select id="grade" name="grade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled selected style="display:none;"></option>
                                <option value="{{ BookCategoryType::小学1年 }}" @if(old('category')==BookCategoryType::NOVEL) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::NOVEL) }}</option>
                                <option value="{{ BookCategoryType::小学2年 }}" @if(old('category')==BookCategoryType::SPORTS) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::SPORTS) }}</option>
                                <option value="{{ BookCategoryType::小学3年 }}" @if(old('category')==BookCategoryType::PROGRAMMING) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::PROGRAMMING) }}</option>
                                <option value="{{ BookCategoryType::小学4年 }}" @if(old('category')==BookCategoryType::BUSINESS) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::BUSINESS) }}</option>
                                <option value="{{ BookCategoryType::小学5年 }}" @if(old('category')==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
                                <option value="{{ BookCategoryType::小学6年 }}" @if(old('category')==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
                                <option value="{{ BookCategoryType::中学1年 }}" @if(old('category')==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
                                <option value="{{ BookCategoryType::中学2年 }}" @if(old('category')==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
                                <option value="{{ BookCategoryType::中学3年 }}" @if(old('category')==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>
                        <div>
                            <x-input-label for="author" value="著者" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author')" />
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>
                        <div>
                            <x-input-label for="purchase_date" value="購入日" />
                            <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" :value="old('purchase_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('purchase_date')" />
                        </div>
                        <div>
                            <x-input-label for="evaluation" value="評価" />
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="1" @if(old('evaluation')=='1') checked @endif> 1</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="2" @if(old('evaluation')=='2') checked @endif> 2</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="3" @if(old('evaluation')=='3') checked @endif> 3</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="4" @if(old('evaluation')=='4') checked @endif> 4</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="5" @if(old('evaluation')=='5') checked @endif> 5</x-input-label>
                            <x-input-error class="mt-2" :messages="$errors->get('evaluation')" />
                        </div>
                        <div>
                            <x-input-label for="memo" value="メモ" />
                            <textarea id="memo" name="memo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6">{{ old('memo') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('memo')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>登録する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>