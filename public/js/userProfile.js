console.log('a');
imageFileInput = document.getElementById('profile-picture-input');
document.getElementById('profile-picture-img').addEventListener('click', () => {
    imageFileInput.click();
})
imageFileInput.onchange = function(event) {
    event.preventDefault();
    document.getElementById('profile-picture').submit();
}