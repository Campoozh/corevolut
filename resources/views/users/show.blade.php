@extends('layouts.main')
@section('title', $user->name.' - Corevolut')
@section('content')

    <div class="user-profile-background">
        <div class="container">
            @if (session('msg'))
                <p class="msg-success profile-msg-success">{{session('msg')}}</p>        
            @endif
            <div class="user-profile">
                <div class="user-profile-card">
                    @if (Auth::guest() || Auth::user()->id != $user->id)
                        <img src="/assets/img/profile/{{$user->image_url}}" alt="profile-picture" class="profile-picture-img">
                    @else
                    <form method="POST" action="/user/edit_image/{{$user->id}}" class="profile-picture" id="profile-picture" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')      
                        <input type="file" id="profile-picture-input" style="display:none;" name="image" accept="image/png, image/jpeg">
                        <img src="/assets/img/profile/{{$user->image_url}}" alt="profile-picture" class="profile-picture-img" id="profile-picture-img">
                    </form>
                    @endif
                    <form action="/user/update_profile/{{$user->id}}" method="POST" class="user-update-profile-form">
                        @csrf
                        @method('PUT')
                        <h1 class="user-name">{{$user->name}}</h1>
                    </form> 
                    <h3 class="user-location"><ion-icon name="people-outline"></ion-icon>Followers: {{count($followers)}}</h3>
                    <h2 class="user-activity"><img src="/assets/svg/icons/ellipse-outline-green.svg" alt=""> Online</h2>

                    @if (Auth::guest() || Auth::user()->id != $user->id && !$following)                    
                        <form action="/user/follow/{{$user->id}}" method="POST">
                            @csrf
                            <button class="blue-bg-button user-follow-btn" type="submit">Follow</button>
                        </form>
                    @elseif($following)
                        <div class="following-buttons">
                            <button class="green-bg-button user-follow-btn following-button"><ion-icon name="checkmark-outline"></ion-icon><span>Following</span></button>
                            <button  class="green-bg-button user-follow-btn message-button"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></button>
                        </div>
                    @else
                        <button class="blue-bg-button user-follow-btn edit-profile-button"><ion-icon name="pencil-outline"></ion-icon> Edit profile</button>
                    @endif

                </div>

                <div class="user-recent-interactions">
                    <h1 class="main-title">Recent interactions</h1>
                </div>
                <div class="user-level-card">
                    <h1 class="user-level">Level: <span class="user-level-{{strtolower($user->level)}}">{{$user->level}}</span></h1>
                    <h2 ><a href="#" class="user-rankings">See user rankings</a></h2>
                </div>
            </div>

            <div class="profile-suggested-user">
                <h2>Similar people:</h2>
                <div>
                    <p>Not similar people found :(</p>
                </div>
            </div>
        </div>
    </div> 
    <script src="/js/user/user.js"></script>

@endsection

