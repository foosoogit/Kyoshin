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
    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="flex items-center gap-4">
                            <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                        </div>
                        {{--<form method="post" action="{{ route('teachers.show_standby_display') }}" class="mt-6 space-y-6">@csrf--}}
                        {{-- <form method="post" class="mt-6 space-y-6" wire:submit="send_mail_wire(document.getElementById('student_serial').value)">@csrf --}}
                        {{--<form method="post" action="{{ route('teachers.sendmail') }}" class="mt-6 space-y-6">@csrf--}}
                        {{--<form wire:submit>--}}
                            <div>
                                <x-input-label for="name_sei" value="生徒番号の読み込み" />
                                {{--<x-text-input id="student_serial" name="student_serial" type="text" class="mt-1 block w-full" autofocus/>--}}
                                {{--<x-text-input id="student_serial" name="student_serial" type="text" class="mt-1 block w-full" wire:model.lazy="student_serial" autofocus/>--}}
                                {{--<x-text-input type="text" class="mt-1 block w-full" name="student_serial_txt" wire:model="student_serial" autofocus />--}}
                                <x-text-input type="text" class="mt-1 block w-full" name="student_serial_txt" id="student_serial_txt" autofocus />
                                {{--<x-text-input type="text" class="mt-1 block w-full" wire:keydown.enter.model="student_serial" autofocus />--}}
                                <x-input-error class="mt-2" :messages="$errors->get('student_serial')" />
                            </div>
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var audio_out= new Audio("time_out.mp3");
		var audio_in= new Audio("true.mp3");
		var audio_false= new Audio("false.mp3");
		//var audio;
		$(document).ready( function(){
			document.getElementById('student_serial_txt').focus();
		});
		$('#student_serial_txt').keypress(function(e) {
			console.log("TEST0");
			if(e.which == 13) {
				$.ajax({
					//url: 'send_mail',
					url: 'in_out_manage',
					type: 'post', // getかpostを指定(デフォルトは前者)
					dataType: 'text', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
					scriptCharset: 'utf-8',
					data: {"student_serial":$('#student_serial_txt').val()},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}).done(function (data) {
					//console.log("seated_type="+data);
					const item_json = JSON.parse(data);
					//console.log("seated_type="+item_json.seated_type);
					if(item_json.seated_type=="false"){
						audio_false.play();
						//console.log(data);
					}else if(item_json.seated_type=="in"){
						audio_in.play();
						send_mail(data);
						//console.log(data);
					}else if(item_json.seated_type=="out"){
						audio_out.play();
						send_mail(data);
						//console.log(data);
					}
					document.getElementById('student_serial_txt').value="";
					document.getElementById('student_serial_txt').focus();
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

		function send_mail(item_json){
			console.log("TEST1");
			$.ajax({
				url: 'send_mail_in_out',
				type: 'post', // getかpostを指定(デフォルトは前者)
				dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
				scriptCharset: 'utf-8',
				data: {"item_json":item_json},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			}).done(function (data) {
				console.log("ok");
				data=null;
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(XMLHttpRequest.status);
				alert(textStatus);
				alert(errorThrown);	
				alert('エラー');
			});
		}

	</script>
</body>
</html>