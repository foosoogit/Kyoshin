<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>入退出メニュー</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="{{ asset('/css/menu.css')  }}" >
</head>
<body>
<div id="container">
	<div id="main">
		<ul class="sidenav">
			<li><a href="{{ route('teachers.show_standby_display') }}">待ち受け画面</a></li>
			{{--<li><a href="{{ route('teachers.index') }}">待ち受け画面</a></li>--}}
			<li><a href="{{ route('admin.showRireki') }}">入退出履歴</a></li>
			<li><a href="#mail">メール配信</a></li>
			<li><a href="{{ route('Students.List') }}">生徒一覧（新規登録・追加・削除）</a></li>
			<li><a href="{{ route('Students.Create') }}">新規生徒登録</a></li>
			{{--<li><a href="{{ route('Students.NewNumList') }}">新規生徒登録2</a></li>--}}
			<li><a href="{{ route('teachers.index') }}">講師登録・追加・削除</a></li>
			<li><a href="{{ route('teachers.show_setting') }}">環境設定</a></li>
		</ul>
		<form action="{{ route('logout') }}" method="post">
			@csrf
			<input type="submit" value="ログアウト">
		  </form>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>