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
                            <x-input-label for="title" value="タイトル" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="category" value="カテゴリ" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled selected style="display:none;"></option>
                                <option value="{{ BookCategoryType::NOVEL }}" @if(old('category')==BookCategoryType::NOVEL) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::NOVEL) }}</option>
                                <option value="{{ BookCategoryType::SPORTS }}" @if(old('category')==BookCategoryType::SPORTS) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::SPORTS) }}</option>
                                <option value="{{ BookCategoryType::PROGRAMMING }}" @if(old('category')==BookCategoryType::PROGRAMMING) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::PROGRAMMING) }}</option>
                                <option value="{{ BookCategoryType::BUSINESS }}" @if(old('category')==BookCategoryType::BUSINESS) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::BUSINESS) }}</option>
                                <option value="{{ BookCategoryType::OTHER }}" @if(old('category')==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
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