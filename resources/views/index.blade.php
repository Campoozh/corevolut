@extends('layouts.main')
@section('title', 'Corevolut')

@section('content')

<div class="index-main-content">
    <div class="index-main-image">
        <img src="/assets/svg/index-main.svg" alt="index-main-image">
    </div>
    <div class="index-main-text">
        <h1>THE FUTURE OF <br> LEARNING HOW TO <span class="span-blue-color">CODE</span></h1>
        <h3>Learn <span class="span-blue-color">any tecnhology</span> and <br> get help from the <span class="span-blue-color">best</span></h3>
        @auth
            <a class="blue-bg-button" href="">Explore</a>
        @endauth

        @guest
            <a class="blue-bg-button" href="/register">Jump in</a>     
        @endguest
    </div>   
</div>

@endsection