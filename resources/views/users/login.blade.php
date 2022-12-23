@extends('layouts.main')
@section('title', 'Login - Corevolut')
@section('content')

<div class="container">
    <div class="login-content">
        <div class="login-image">
            <h1>Welcome back!</h1>
            <img src="/assets/svg/login_svg.svg" alt="login_svg">
            <h2>First time here? </h2>
            <h3><a href="/register"><span class="span-blue-color">Create an account</span></a></h3>
        </div>
        <div class="login-form">
            <form action="/user/login" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email...">
                <input type="password" name="password" placeholder="Password...">
                <button type="submit" class="blue-bg-button">Login</button>
                @if (session('msg'))
                    <p class="msg-red" style="margin-top: 1em">{{session('msg')}}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection