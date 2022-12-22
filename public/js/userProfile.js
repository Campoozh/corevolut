imageFileInput = document.getElementById('profile-picture-input');
document.getElementById('profile-picture-img').addEventListener('click', () => {
    imageFileInput.click();
})
imageFileInput.onchange = function(event) {
    event.preventDefault();
    document.getElementById('profile-picture').submit();
}
successMSG = document.getElementsByClassName('profile-msg-success')[0] 
    ? document.getElementsByClassName('profile-msg-success')[0] 
    : ''
if(successMSG){
    setTimeout( () => {
        successMSG.style.transition = '1s';
        successMSG.style.opacity = '0';
    }, 3000)
    setTimeout(() => {
        successMSG.remove();
    }, 4000);
}
