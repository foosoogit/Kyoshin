<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
	@livewireStyles
</head>
<body class="font-sans antialiased">
    <livewire:standby-display >
	@livewireScripts
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var audio_out= new Audio("time_out.mp3");
		var audio_in= new Audio("true.mp3");
		var audio_false= new Audio("false.mp3");
		var audio;
		$(document).ready( function(){
			document.getElementById('student_serial_txt').focus();
		});
		$('#student_serial_txt').keypress(function(e) {
			//console.log("TEST");
			if(e.which == 13) {
				$.ajax({
					url: 'check_attendant.php',
					type: 'post', // getかpostを指定(デフォルトは前者)
					dataType: 'text', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
					scriptCharset: 'utf-8',
					data: {"targetNo":$('#student_serial_txt').val()},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}).done(function (data) {
					var dt = JSON.parse(data);
					if(dt.flgToroku==true){
						audio=audio_true;	
						$('#ckToroku').text('○');
						$('#resUketukeNo').text(dt.uketukeNo);
						$('#genzaijikoku').text(dt.registTime);
						$('#ckUketuke').text(dt.flgUketuke);
						if(dt.flgUketuke>1){
							audio=audio_false_cnt;	
						}
						if(dt.flgTime==true){
							$('#ckTime').text('○');
							$('#torokuTime').html(dt.reservTime);

							//$('#torokuTime').html(dt.registTime);
						}else{
							console.log(dt.reservTime);
							$('#ckTime').text('☓');
							moji="<SPAN style='color:red'>"+dt.reservTime+"</SPAN>"
							$('#torokuTime').html(moji);
							audio=audio_false_time;
						}
					}else{
						//alert(dt.flgToroku);
						$('#resUketukeNo').html("<SPAN style='color:red'>"+dt.uketukeNo+"</SPAN>");
						$('#ckToroku').text('☓');
						audio=audio_false_uketukeNo;
					}
					audio.play();
					document.getElementById('uketukeNo').focus();
					document.getElementById('uketukeNo').value="";
					data=null;
				}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.status);
					alert(textStatus);
					alert(errorThrown);	
					alert('エラー');
				});
			}else{
				//alert("TEST");
			}
		});
	</script>
</body>
</html>