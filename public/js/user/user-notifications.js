let userNotificationsButtonClicks = 0;
let userNotificationsButton = document.querySelector('#user-notifications-button');
userNotificationsButton.onclick = () => {
    let userNotificationsDiv = document.querySelector('#user-notifications');
    if(userNotificationsButtonClicks == 0){
        userNotificationsDiv.style.display = 'block';
        userNotificationsButtonClicks++;
    } else {
        userNotificationsDiv.style.display = 'none';
        userNotificationsButtonClicks--;
    }
}