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
            <div class="pb-4">
                <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">新規登録</a>
            </div>
            <table class="w-full">
                <tr>
                    <th>生徒番号</th>
                    <th>姓</th>
                    <th>名</th>
                    <th>学年</th>
                    <th>メールアドレス</th>
                    <th>電話</th>
                    <th>メモ</th>
                    <th>履歴</th>
                </tr>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->serial_student }}</td>
                    <td>{{ $student->name_sei }}</td>
                    <td>{{ $student->name_mei }}</td>
                    <td>{{ $student->grade }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->note }}</td>
                    <td>履歴</td>
                    <td>
                        <form method="post" action="{{ route('books.destroy', $book->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('books.show', $book->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">詳細</a>
                            <a href="{{ route('books.edit', $book->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">編集</a>
                            <button type="submit" onClick="return clickDelete()" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
</div>
