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
            <button type="button" name="ToMenuBtn" id="ToMenuBtn" onclick="location.href='{{route('menu')}}'" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">メニューに戻る</button></div>    
            <div class="col-auto"><button type="button" name="CreateBtn" id="CreateBtn" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700" onclick="location.href='{{route('teachers.create')}}'" >新規登録</button></div>
                <div class="col-auto"><x-text-input id="kensakukey_txt" name="kensakukey_txt" type="text" class="mt-1 block w-full" :value="old('kensakukey','optional(target_key)')" required autofocus wire:model.defer="kensakukey"/></div>
                {{--  <a wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</a>--}}
                <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</button></div>
                <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索解除</button></div>
                {{--<a href="{{ route('student.create') }}" >新規登録</a> --}}
            </div>
            <table id="table_responsive">
                <tr>
                    <th>編集<br><button type="button" class="btn-orderby-border" wire:click="sort('serial_student-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('serial_student-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>氏名<br><button type="button" class="btn-orderby-border" wire:click="sort('name_sei-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>シメイ<br><button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>閲覧範囲<br><button type="button" class="btn-orderby-border" wire:click="sort('rank-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>メールアドレス<br><button type="button" class="btn-orderby-border" wire:click="sort('email-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>電話</th>
                    <th>メモ</th>
                    <th>削除</th>
                </tr>
                @foreach ($teachers as $teacher)
                <tr>
                    <td><form action="{{ route('teachers.edit') }}" method="POST">@csrf<input name="TeacherSerial_Btn" type="submit" value="{{ $teacher->serial_user}}"></form>
                    </td>
                    <td>{{ $teacher->name_sei }} {{ $teacher->name_mei }}</td>
                    <td>{{ $teacher->name_sei_kana }} {{ $teacher->name_mei_kana }}</td>
                    <td>{{ $teacher->rank }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->note }}</td>
                    <td>
                        <form method="post" action="{{ route('teachers.destroy', $teacher->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" onClick="return clickDelete('{{ $teacher->name_sei }} {{ $teacher->name_mei }}')" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md" value="削除">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {{$teachers->appends(request()->query())->links('pagination::bootstrap-4')}}
        </div>
</div>