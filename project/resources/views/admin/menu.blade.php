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
			<li><a href="{{ route('teachers.show_delivery_email') }}">メール配信</a></li>
			<li><a href="{{ route('Students.List') }}">生徒一覧（新規登録・追加・削除）</a></li>
			<li><a href="{{ route('Students.Create') }}">新規生徒登録</a></li>
			{{--<li><a href="{{ route('Students.NewNumList') }}">新規生徒登録2</a></li>--}}
			<li><a href="{{ route('teachers.index') }}">講師登録・追加・削除</a></li>
			<li><a href="{{ route('teachers.show_setting') }}">環境設定</a></li>
			<li><a href="{{ route('teachers.show_email_account_setup') }}">メールアカウントのセットアップ</a></li>
		</ul>
		<form action="{{ route('logout') }}" method="post">
			@csrf
			<input type="submit" value="ログアウト">
		  </form>
	</div>

	

<h2>Favorite books</h2>
<ul class="accordion-menu">
  <li>
    <div class="dropdownlink"><i class="fa fa-road" aria-hidden="true"></i> History
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="#">History book 1</a></li>
      <li><a href="#">History book 2</a></li>
      <li><a href="#">History book 3</a></li>
    </ul>
  </li>
  <li>
    <div class="dropdownlink"><i class="fa fa-paper-plane" aria-hidden="true"></i> Fiction
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="#">Fiction book 1</a></li>
      <li><a href="#">Fiction book 2</a></li>
      <li><a href="#">Fiction book 3</a></li>
    </ul>
  </li>
  <li>
    <div class="dropdownlink"><i class="fa fa-quote-left" aria-hidden="true"></i> Fantasy
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="#">Fantasy book 1</a></li>
      <li><a href="#">Fantasy book 2</a></li>
      <li><a href="#">Fantasy book 3</a></li>
    </ul>
  </li>
  <li>
    <div class="dropdownlink"><i class="fa fa-motorcycle" aria-hidden="true"></i> Action
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="#">Action book 1</a></li>
      <li><a href="#">Action book 2</a></li>
      <li><a href="#">Action book 3</a></li>
    </ul>
  </li>
</ul>


</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
<script>
	$(function() {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    // more then one submenu open?
    this.multiple = multiple || false;
    
    var dropdownlink = this.el.find('.dropdownlink');
    dropdownlink.on('click',
                    { el: this.el, multiple: this.multiple },
                    this.dropdown);
  };
  
  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el,
        $this = $(this),
        //this is the ul.submenuItems
        $next = $this.next();
    
    $next.slideToggle();
    $this.parent().toggleClass('open');
    
    if(!e.data.multiple) {
      //show only one menu at the same time
      $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
    }
  }
  
  var accordion = new Accordion($('.accordion-menu'), false);
})
</script>
</body>
</html>