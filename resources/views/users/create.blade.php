@extends('layouts.main')
@section('title', 'Register - Corevolut')

@section('content')

<div class="container">
    <div class="register-content">
        <div class="register-form">
            <form action="/user/register" method="POST">
                @csrf
                <input type="text" name="firstName" placeholder="First name...">
                <input type="text" name="lastName" placeholder="Last name...">
                <input type="email" name="email" placeholder="Email...">
                <input type="password" name="password" placeholder="Password...">
                <input type="password" name="confirmPassword" placeholder="Confirm password...">
                @if (session('msg'))
                    <p class="msg-red">{{session('msg')}}</p>
                @endif
                <button type="submit" class="blue-bg-button">Create account</button>
            </form>
        </div>
        <div class="register-image">
            <h1>Jump into the community <br> and <span class="span-blue-color">learn everyday</span>!</h1>
            <img src="/assets/svg/register_svg.svg" alt="register_svg">
            <h2>Already registered? <a href="/login"><span class="span-blue-color">Login in</span></a></h2>
        </div>
    </div>
</div>
@endsection