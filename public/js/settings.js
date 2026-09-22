// Settings Toggle 
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const panels = document.querySelectorAll('.panel');
    const toggles = document.querySelectorAll('.toggle');

    // Switch panels
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            // remove active from all
            sidebarItems.forEach(i => i.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));

            // add active to clicked
            item.classList.add('active');
            const panelId = item.getAttribute('data-panel');
            document.getElementById(panelId).classList.add('active');
        })
    })

    // Toggle switches
    toggles.forEach(t => {
        t.addEventListener('click', () => t.classList.toggle('active'))
    });

// User Profile Avatar 
const avatarInput = document.getElementById('user_profile_file');
const avatarPhoto = document.getElementById('avatarPhoto');

avatarInput.addEventListener('change' , function(){
    const file = this.files[0];

    //No file selected 
    if(!file) return;

    //Allowed image types
    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    //Maximum size: 2mb
    const maxSize = 2 * 1024 *1024;

    //Validate FIle Type 
    if(!allowedTypes.includes(file.type)){
        toastr.error('Please Select a JPG, PNG or Webp image...');
        this.value = '';
        return ;
    }

    //Validate FIle size 
    if(file.size > maxSize){
        toastr.error('Profile picture must not be larger than 2MB');
         this.value = '';
        return ;
    }

    //Preview the selected image
    const imageUrl = URL.createObjectURL(file);

    avatarPhoto.src = imageUrl;

    //Clean up the temporary URL after the image loads 
    avatarPhoto.onload = function(){
        URL.revokeObjectURL(imageUrl);
    }
})

/*
    This function gets User Input  from our Form 
    Send a request to our Controller 
    Return either Success or Error messages to User 
    Finally Send data to Controller to save in the DB
*/

async function submitSettingsForm(e , form) {
        e.preventDefault();

        //Clear Previous Errors 
        form.querySelectorAll('.settings-error').forEach(error => {
            error.textContent = '';
        });

        const formData = new FormData(form);

        try{
            const response = await fetch(form.action , {
                method: 'POST' , 
                    headers: {
                        'x-Requested-With' :  'XMLHttpRequest'
                    },
                    body: formData
            });

            const data = await response.json();
            
            if(data.status === false){
                //Show Error For Each Field...........
                Object.entries(data.errors).forEach(([field , message] )=> {
                    const errorElement = document.getElementById(
                        `${field}_error`
                    );

                    if(errorElement){
                        errorElement.textContent = message;
                    }
                });

                return;
            }

            if(data.status === true){
                toastr.success(data.message);
            }
        }catch{
            console.error('Seetings Update Failed: ' , error);
            toastr.error(error);

        }
}

const personalInformationForm = document.getElementById('UserData');

if(personalInformationForm){
    personalInformationForm.addEventListener('submit' , function(e){
        submitSettingsForm(e , personalInformationForm);
    });
       
}

const accountInformationForm = document.getElementById('AccountInformationForm');

if(accountInformationForm){
    accountInformationForm.addEventListener('submit' , function(e){
        submitSettingsForm(e , accountInformationForm);
    });
       
}
// School Information 
const stateSelect = document.getElementById('state_id');
const universitySelect = document.getElementById('university_id');

function filterUniversities(){
    //state_id
    const selectedState = stateSelect.value ;

    Array.from(universitySelect.options).forEach( option => {

        //Always Keep PlaceHolder -------Select Your University 
        if(option.value === ''){
            option.hidden = false;
            return;
        }
        
        //Hide Universities that dont belong to the selected state 
        option.hidden = option.dataset.state !== selectedState;

    });

    //Reset University when state changes ------Select Your University
    universitySelect.value = '';
}

const SchoolInformationForm = document.getElementById('SchoolInformationForm');

if(SchoolInformationForm){
    SchoolInformationForm.addEventListener('submit' , function(e){
        submitSettingsForm(e , SchoolInformationForm);
    });
       
}

stateSelect.addEventListener('change' , filterUniversities);

const changePasswordForm = document.getElementById('changePassword');

if(changePasswordForm){
    changePasswordForm.addEventListener('submit' , function(e){
        submitSettingsForm(e , changePasswordForm);
    });
       
}

