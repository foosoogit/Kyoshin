{{-- <x-app-layout> --}}
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
</head>
<body class="font-sans antialiased">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    {{--  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>
    --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" style="line-height: 40px">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニュー</x-primary-button>
                        <x-primary-button onclick="location.href='{{route('Students.List')}}'" >生徒一覧</x-primary-button>
                    </div>
                    <div>
                        {!! $barcode !!}
                        <x-input-label for="serial_student" value="生徒番号" />
                        <x-text-input id="serial_student" name="serial_student" type="text" class="mt-1 block w-full" value="{{optional($stud_inf)->serial_student}}" readonly/>
                        <x-input-error class="mt-2" :messages="$errors->get('serial_student')" />
                    </div>
                    <div style="line-height: 2.0;">
                        <x-input-label for="name_sei" value="姓" />
                        <x-text-input id="name_sei" name="name_sei" type="text" class="mt-1 block w-full" :value="old('name_sei',optional($stud_inf)->name_sei)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name_sei')" />
                    </div>
                    <div style="line-height: 2.0;">
                        <x-input-label for="name_mei" value="名" />
                        <x-text-input id="name_mei" name="name_mei" type="text" class="mt-1 block w-full" :value="old('name_mei',optional($stud_inf)->name_mei)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name_mei')" />
                    </div>
                    <div style="line-height: 2.0;">
                        <x-input-label for="name_sei_kana" value="セイ" />
                        <x-text-input id="name_sei_kana" name="name_sei_kana" type="text" class="mt-1 block w-full" :value="old('name_sei_kana',optional($stud_inf)->name_sei_kana)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name_sei_kana')" />
                    </div>
                    <div>
                        <x-input-label for="name_mei_kana" value="メイ" />
                        <x-text-input id="name_mei_kana" name="name_mei_kana" type="text" class="mt-1 block w-full" :value="old('name_mei_kana',optional($stud_inf)->name_mei_kana)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name_mei_kana')" />
                    </div>
                    <div>
                        <x-input-label for="name_mei_kana" value="性別" />
                        {!!$html_gender_ckbox!!}
                        <x-input-error class="mt-2" :messages="$errors->get('name_mei_kana')" />
                    </div>
                    <div>
                        <x-input-label for="course" value="コース" />
                        {!!$html_cource_ckbox!!}
                        <x-input-error class="mt-2" :messages="$errors->get('course')" />
                    </div>
                    <div class="form-group">
                        <x-input-label for="protector_array[0]" value="送信先宛名-1" class="control-label"/>
                        <x-text-input id="protector_array[0]" name="protector_array[0]" type="text" class="mt-1 block w-full" value="{{ old('protector_array[0]',$protector_array[0]) }}" class="form-control"/>様
                        <x-input-label for="email_array[0]" value="email-1" />
                        <x-text-input id="email_array[0]" name="email_array[0]" type="text" class="mt-1 block w-full" value="{{ old('email_array[0]',$email_array[0]) }}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('email_array[0]')" />
                    </div>
                    <div class="form-group">
                        <x-input-label for="protector_array[1]" value="送信先宛名-2" class="control-label"/>
                        <x-text-input id="protector_array[1]" name="protector_array[1]" type="text" class="mt-1 block w-full" value="{{ old('protector_array[1]',$protector_array[1]) }}" class="form-control"/>様
                        <x-input-label for="email_array[1]" value="email-2" />
                        <x-text-input id="email_array[1]" name="email_array[1]" type="text" class="mt-1 block w-full" value="{{ old('email_array[1]',$email_array[1]) }}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('email_array[1]')" />
                    </div> 
                    <div class="form-group">
                        <x-input-label for="protector_array[2]" value="送信先宛名-3" class="control-label"/>
                        <x-text-input id="protector_array[2]" name="protector_array[2]" type="text" class="mt-1 block w-full" value="{{ old('protector_array[2]',$protector_array[2]) }}" class="form-control"/>様
                        <x-input-label for="email_array[2]" value="email-3" />
                        <x-text-input id="email_array[2]" name="email_array[2]" type="text" class="mt-1 block w-full" value="{{ old('email_array[2]',$email_array[2]) }}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('email_array[2]')" />
                    </div>
                    <x-primary-button name="SendMsgToProtectorBtn" value="SendMsgToProtectorBtn" onclick="save_manage('mail');">保護者へ着信確認テストメールを送信</x-primary-button>
                    @if( session('flash.send') )
                        <div class="alert alert-send">{{ session('flash.send') }}</div>
                    @endif
                    <div>
                        <x-input-label for="pass_for_protector" value="保護者確認用パスワード" />
                        <x-text-input id="pass_for_protector" name="pass_for_protector" type="text" class="mt-1 block w-full" :value="old('pass_for_protector',optional($stud_inf)->pass_for_protector)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('pass_for_protector')" />
                    </div>
                    <div>
                        <x-input-label for="phone" value="電話" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone',optional($stud_inf)->phone)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>
                    <div>
                        <x-input-label for="grade" value="学年" />
                        {!!$html_grade_slct!!}
                        <x-input-error class="mt-2" :messages="$errors->get('grade')" />
                    </div>
                    <div>
                        <x-input-label for="elementary" value="小学校名" />
                        <x-text-input id="elementary" name="elementary" type="text" class="mt-1 block w-full" :value="old('elementary',optional($stud_inf)->elementary)"/>
                        <x-input-error class="mt-2" :messages="$errors->get('elementary')" />
                    </div>
                    <div>
                        <x-input-label for="junior_high" value="中学校名" />
                        <x-text-input id="junior_high" name="junior_high" type="text" class="mt-1 block w-full" :value="old('junior_high',optional($stud_inf)->junior_high)"/>
                        <x-input-error class="mt-2" :messages="$errors->get('junior_high')" />
                    </div>
                    <div>
                        <x-input-label for="high_school" value="高校名" />
                        <x-text-input id="high_school" name="high_school" type="text" class="mt-1 block w-full" :value="old('high_school',optional($stud_inf)->high_school)"/>
                        <x-input-error class="mt-2" :messages="$errors->get('high_school')" />
                    </div>
                    <div>
                        <x-input-label for="note" value="メモ" />
                        <textarea id="note" name="note" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('note',optional($stud_inf)->note) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('note')" />
                    </div>
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="flex items-center gap-4">
                        @if( session('flash.modify') )
                            <div class="alert alert-modify">{{ session('flash.modify') }}</div>
                        @endif
                            <x-primary-button onclick="save_manage('save');">登録する</x-primary-button>
                        </div>
                    {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        function gender_manage(obj){
            console.log("id="+obj.id);
            if(obj.checked==true){
                if(document.getElementById('gender[1]').id==obj.id){
                    document.getElementById('gender[0]').checked=false;
                }else{
                    document.getElementById('gender[1]').checked=false;
                }
            }
        }
        function save_manage(type){
            const email_array = [],protector_array = [],course_array=[],gender_array=[];
            var course=document.getElementsByName("course[]");
            for(i=0;i<course.length;i++){
                if(course[i].value!=''){
                    course_array.push(course[i].value);
                }
            }
            const courses=course_array.join(',');
            for(i=0;i<3;i++){
                if(document.getElementById("email_array["+i+"]").value!=''){
                    email_array.push(document.getElementById("email_array["+i+"]").value);
                    protector_array.push(document.getElementById("protector_array["+i+"]").value);
                }
            }
            gender="";
            var gender_array=document.getElementsByName("gender[]");
            for(i=0;i<gender_array.length;i++){
                if(gender_array[i].value!=''){
                    gender=gender_array[i].value;
                    break;
                }
            }

            const emails=email_array.join(',');
            const protectors=protector_array.join(',');
            $.ajax({
                url: 'update_JQ',
                type: 'post', // getかpostを指定(デフォルトは前者)
                dataType: 'text', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
                scriptCharset: 'utf-8',
                data: {
                    "serial_student":$('#serial_student').val(),
                    "email":emails,
                    "name_sei":$('#name_sei').val(),
                    "name_mei":$('#name_mei').val(),
                    "name_sei_kana":$('#name_sei_kana').val(),
                    "name_mei_kana":$('#name_mei_kana').val(),
                    "protector":protectors,
                    "pass_for_protector":$('#pass_for_protector').val(),
                    "gender":gender,
                    "phone":$('#phone').val(),
                    "grade":$('#grade').val(),
                    "elementary":$('#elementary').val(),
                    "junior_high":$('#junior_high').val(),
                    "high_school":$('#high_school').val(),
                    "note":$('#note').val(),
                    "course":courses,
                    "type":type

                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (data) {
                //console.log(data);
                alert(data);
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
{{-- </x-app-layout> --}}