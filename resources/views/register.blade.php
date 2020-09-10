 @extends('layout')

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">x</button>	
        @foreach($errors->all() as $value)
        <h5><strong>{{ $value }}</strong></h5>
        @endforeach
</div>
@endif

<form class="reg_form" action="{{'register'}}" method="POST">
    <div class="regitter-div">
        

        @csrf
        <div class="back-div">
            <a href="/login"><img src="images/back.svg"></a>
            <div class="register-profile-div">
                <div class="login-profile">
                    <img src="images/userlog.svg">

                </div>
            </div>
        </div>
        <div class="register-header">Регистрация</div>
        <div class="login-account"></div>
        <div class="social-sites social-sites-register">
            <div class="login-facebook"><img src="images/facebook.svg"></div>
            <div class="login-gmail"><img src="images/gmail.svg"></div>
            
        </div>
   
        <div class="email-div register-email-div">
            <label class="name-label" for="l_name">Фамилия</label>
            <input type="text" name="l_name" value="{{old('l_name')}}" class="l_name">
        </div>
        <div class="email-div register-email-div">
            <label class="name-label" for="name">Имя</label>
            <input type="text" name="name" value="{{old('name')}}" class="name">
        </div>
        
        <div class="email-div register-email-div">
            <label class="name-label" for="m_name">Отчество</label>
            <input type="text" name="m_name" value="{{old('m_name')}}" class="m_name">
        </div>
        <div class="email-div register-email-div">
            <label class="name-label" for="name">Тел.</label>
            <div class='tel_div'><span class="plus">+</span><input class="name" id="phone_number" value="{{old('phone')}}" name="phone" type="tel"></div>
        </div>

        <div class="email-div register-email-div">
            <label class="email-label" for="email">Эл. Почта</label>
            <input type="text" name="email" value="{{old('email')}}" class="email">
        </div>
        <div class="email-div register-email-div">
            <label class="name-label" for="login">Логин</label>
            <input type="text" name="login" value="{{old('login')}}" class="login">
        </div>


        <div class="email-div register-email-div">
            <label class="pass-label" for="password_r">Пароль</label>
            <input type="password" name="password_r" class="password_r passw">
        </div>
        <div class="email-div register-email-div">
            <label class="pass-label" for="password_re">Подтвердить Пароль</label>
            <input type="password" name="password_re" class="password_re passw">
        </div>

        

        <div class="register-btn-div">
            <button type="sumbit" class="register-btn">Зарегистрироваться</button>
        </div>

    </div>

</form>



@endsection