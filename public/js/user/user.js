let imageFileInput = document.getElementById('profile-picture-input');
document.getElementById('profile-picture-img').addEventListener('click', () => {
    imageFileInput.click();
})
imageFileInput.onchange = function(event) {
    event.preventDefault();
    document.getElementById('profile-picture').submit();
}
let successMSG = document.getElementsByClassName('profile-msg-success')[0] 
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
let button = document.querySelector('.edit-profile-button') 
    ? document.querySelector('.edit-profile-button')
    : '';
if(button){
    let h1Name = document.querySelector('.user-name')

    let firstNameInput = document.createElement('input')
    firstNameInput.value = h1Name.textContent.split(' ')[0]
    firstNameInput.type = 'text'
    firstNameInput.name = 'firstName'
    firstNameInput.placeholder = 'First name...'
    firstNameInput.classList.add('user-input', 'user-edit-name')

    let lastNameInput = document.createElement('input')
    lastNameInput.value = h1Name.textContent.split(' ')[1]
    lastNameInput.type = 'text'
    lastNameInput.name = 'lastName'
    lastNameInput.placeholder = 'Last name...'
    lastNameInput.classList.add('user-input', 'user-edit-name')

    let cancel = document.createElement('p')
    cancel.textContent = 'Cancel'
    cancel.style.color = '#434E53';
    cancel.style.marginTop = '0.6em';
    cancel.onmouseover = () => {
        cancel.style.textDecoration = 'underline';
        cancel.style.cursor = 'pointer';
    }
    cancel.onmouseleave = () => {
        cancel.style.textDecoration = 'none';
    }
    cancel.onclick = () => {
        window.location.reload();
    }
    

    clicks = 0;

    button.onclick = () => {

        if (clicks == 0){

            h1Name.parentNode.parentNode.querySelector('.user-location').style.display = 'none';
            h1Name.parentNode.parentNode.querySelector('.user-activity').style.display = 'none';
    
            h1Name.parentNode.replaceChild(firstNameInput, h1Name)
            firstNameInput.parentNode.appendChild(lastNameInput)
    
            firstNameInput.focus()

            button.textContent = 'Save profile'

            button.after(cancel)

            clicks++;

        } else {

            if(firstNameInput.value == ''               
                || !/^[a-zA-Z]+$/.test(firstNameInput.value)) {

                    firstNameInput.style.borderColor = 'red';
                    lastNameInput.style.borderColor = 'rgb(179, 177, 177)';
                    
                } else if (lastNameInput.value == '' 
                || !/^[a-zA-Z]+$/.test(lastNameInput.value)) {
                    
                    firstNameInput.style.borderColor = 'rgb(179, 177, 177)';
                    lastNameInput.style.borderColor = 'red';
                    
                } else {
                    
                firstNameInput.style.borderColor = 'rgb(179, 177, 177)';
                lastNameInput.style.borderColor = 'rgb(179, 177, 177)';
                document.querySelector('.user-update-profile-form').submit();

                clicks--;
                
            }    

        }
 
    }
    
}