@extends('layouts.main')
@section('title', $user->name.' - Corevolut')
@section('content')
    <div class="user-profile-background">
        <div class="container">
            <div class="user-profile">
                <div class="user-profile-card">
                    <img src="/assets/img/profile/default.png" alt="profile-picture" class="profile-picture">
                    <h1 class="user-name">{{$user->name}}</h1>
                    <h3 class="user-location"><ion-icon name="location-outline"></ion-icon>Not found :(</h3>
                    <h2 class="user-activity"><img src="/assets/svg/icons/ellipse-outline-green.svg" alt=""> Online</h2>
                    <button class="blue-bg-button user-follow-btn">Follow</button>
                </div>

                <div class="user-recent-interactions">
                    <h1 class="main-title">Recent interactions</h1>
                </div>
                <div class="user-level-card">
                    <h1 class="user-level">Level: <span class="user-level-{{strtolower($user->level)}}">{{$user->level}}</span></h1>
                    <h2 ><a href="#" class="user-rankings">See user rankings</a></h2>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div> 
@endsection

