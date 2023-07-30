<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') == 'books-stored')
            <div class="mb-4 font-medium text-sm text-green-600">新規登録が完了しました。</div>
            @elseif (session('status') == 'books-updated')
            <div class="mb-4 font-medium text-sm text-green-600">更新が完了しました。</div>
            @elseif (session('status') == 'books-deleted')
            <div class="mb-4 font-medium text-sm text-green-600">削除が完了しました。</div>
            @endif
            <div class="pb-4 row justify-content-center align-middle">
            <div class="col-auto">
            {{--<a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">メニューに戻る</a>--}}
            <button type="button" name="ToMenuBtn" id="ToMenuBtn" onclick="location.href='{{route('dashboard')}}'" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">メニューに戻る</button></div>    
            <div class="col-auto"><button type="button" name="CreateBtn" id="CreateBtn" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">新規登録</button></div>
                <div class="col-auto"><x-text-input id="kensakukey_txt" name="kensakukey_txt" type="text" class="mt-1 block w-full" :value="old('kensakukey')" required autofocus wire:model.defer="kensakukey"/></div>
                {{--  <a wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</a>--}}
                <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</button></div>
                <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索解除</button></div>
                {{--<a href="{{ route('student.create') }}" >新規登録</a> --}}
            </div>
            <table id="table_responsive">
                <tr>
                    <th>生徒番号<br><button type="button" class="btn-orderby-border" wire:click="sort('serial_student-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('serial_student-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>氏名<br><button type="button" class="btn-orderby-border" wire:click="sort('name_sei-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>シメイ<br><button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>学年<br><button type="button" class="btn-orderby-border" wire:click="sort('grade-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('grade-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>メールアドレス<br><button type="button" class="btn-orderby-border" wire:click="sort('email-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('email-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>電話</th>
                    <th>メモ</th>
                    <th>履歴</th>
                </tr>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->serial_student }}</td>
                    <td>{{ $student->name_sei }} {{ $student->name_mei }}</td>
                    <td>{{ $student->name_sei_kana }} {{ $student->name_mei_kana }}</td>
                    <td>{{ $student->grade }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->note }}</td>
                    <td>履歴</td>
                    <td>{{--  
                        <form method="post" action="{{ route('student.destroy', $book->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('student.show', $book->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">詳細</a>
                            <a href="{{ route('student.edit', $book->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">編集</a>
                            <button type="submit" onClick="return clickDelete()" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md">削除</button>
                        </form>
                        --}}
                    </td>
                </tr>
                @endforeach
            </table>
            {{$students->appends(request()->query())->links('pagination::bootstrap-4')}}
        </div>
</div>
