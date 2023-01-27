<div id="user-notifications">
    <h4>Your notifications</h4>
    @foreach (Auth::user()->notifications as $notification)
        {{$notification->body}}
    @endforeach
</div>