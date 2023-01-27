<div id="user-notifications">
    <h2>Your notifications</h2>
    @foreach (Auth::user()->notifications as $notification)
        <div class="user-notification">
            <div class="user-notification-body">
                <p>{{$notification->sender_id == Null ? "Corevolut" : $notification->sender_id}}</p>
                {{$notification->body}}
            </div>
            <ion-icon class="user-notification-icon" name="exit-outline"></ion-icon>
        </div>
    @endforeach
</div>