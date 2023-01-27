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

let profileUpdateClicks = 0;

let h1Name = document.querySelector('.user-name')

let followersDiv = h1Name.parentNode.parentNode.querySelector('.user-followers')
let activityDiv = h1Name.parentNode.parentNode.querySelector('.user-activity')

let firstNameInput = document.createElement('input')
firstNameInput.type = 'text'
firstNameInput.name = 'firstName'
firstNameInput.value = h1Name.textContent.split(' ')[0];
firstNameInput.placeholder = 'First name...'
firstNameInput.classList.add('user-input', 'user-edit-name')

let lastNameInput = document.createElement('input')
lastNameInput.type = 'text'
lastNameInput.name = 'lastName'
lastNameInput.value = h1Name.textContent.split(' ')[1];
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

    firstNameInput.parentNode.replaceChild(h1Name, firstNameInput)
    h1Name.parentNode.removeChild(lastNameInput)

    followersDiv.style.display = 'flex';
    activityDiv.style.display = 'flex';

    if(profileUpdateClicks>0){
        button.innerHTML = '<ion-icon name="pencil-outline"></ion-icon> Edit profile';
        button.disabled = false;
        profileUpdateClicks--

    }

    h1Name.parentNode.parentNode.removeChild(cancel)

}

button.onclick = () => {
    

    if (profileUpdateClicks == 0){

        followersDiv.style.display = 'none';
        activityDiv.style.display = 'none';

        h1Name.parentNode.replaceChild(firstNameInput, h1Name)
        firstNameInput.parentNode.appendChild(lastNameInput)

        firstNameInput.focus()

        button.textContent = 'Save profile' 

        let isFirstNameInputValid = true;
        let isSecondNameInputValid = true;

        firstNameInput.oninput = () => {
            if(firstNameInput.value.length == 0               
                || !/^[a-zA-Z]+$/.test(firstNameInput.value)) {
                    firstNameInput.style.borderColor = 'red'; 
                    isFirstNameInputValid = false;
                    button.disabled = true;
                } else {
                    firstNameInput.style.borderColor = 'rgb(179, 177, 177)'; 
                    isFirstNameInputValid = true;
                    if(isSecondNameInputValid){
                        button.disabled = false;
                    }
            }
        }     

        lastNameInput.oninput = () => {
            if(lastNameInput.value.length == 0               
                || !/^[a-zA-Z]+$/.test(lastNameInput.value)) {
                    lastNameInput.style.borderColor = 'red'; 
                    isSecondNameInputValid = false;
                    button.disabled = true;
            } else {
                lastNameInput.style.borderColor = 'rgb(179, 177, 177)'; 
                isSecondNameInputValid = true;
                if(isFirstNameInputValid){
                    button.disabled = false;
                }
            }    
        }     
        
        button.after(cancel)
        
        profileUpdateClicks++;
        
    } else {
        document.querySelector('.user-update-profile-form').submit();

        firstNameInput.disabled = true
        lastNameInput.disabled = true

        profileUpdateClicks--;
        }    

    }

    
 



    
 
    
