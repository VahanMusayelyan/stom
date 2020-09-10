@extends('layout')

@section('content')

    <form class="log_form" action="{{route('login')}}" method="POST">
        @csrf
        
                <div class="login-div">
            <div class="login-profile">
                <img src="images/userlog.svg">

            </div>
            <div class="login-header">Логин</div>
            <div class="login-account">Войти в свой аккаунт</div>
            <div class="social-sites">
                <div class="login-facebook"><a href="login/facebook"><img src="images/facebook.svg"></a></div>
                <div class="login-gmail"><a href="login/google"><img src="images/gmail.svg"></a></div>
               
            </div>
            <div class="border-div">
<!--                <div class="border-line"></div>-->
                <div class="login-alt-version">Или войдите с помощью эл. почты</div>
<!--                <div class="border-line"></div>-->
            </div>
            <div class="email-div">
                <label class="email-label" for="email">Эл. почта</label>
                <input type="text" name="email" class="email">
                
            </div>
            <div class="pass-div">
                <label class="pass-label" for="pass">Пароль</label>
                <a href="#"><span class="forget-pass">Забыли пароль ?</span></a>
                <div class="pass-div-inp"><input type="password" name="password" class="pass"><img class="show-pass" src="images/forget-pass.svg"></div>
                
            </div>
            <div class="login-btn-div">
                <button type="sumbit" class="login-btn">Далее</button>
            </div>
            <div class="have-account">
                У вас еще нет аккаунта?
            </div>
            <div class="have-account">
                <a href="/register">Зарегистрироваться</a>
            </div>
        </div>
    </form>

@endsection