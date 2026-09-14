document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form-wizard");
    const progress = form.querySelector(".progress");
    const stepsContainer = form.querySelector(".steps-container");
    const steps = form.querySelectorAll(".step");
    const stepIndicators = form.querySelectorAll(".progress-container li");
    const prevBtn = form.querySelector(".prev-btn");
    const nextBtn = form.querySelector(".next-btn");
    const submitBtn = form.querySelector(".submit-btn");

    //Getting all input fields by id 
    const firstName = document.getElementById('first-name');
    const lastName = document.getElementById('last-name');
    const email = document.getElementById('floatingEmailInput');
    const stateInput = document.getElementById('state');
    const universityInput = document.getElementById('university');
    const username = document.getElementById('floatingUsernameInput');
    const password = document.getElementById('floatingPasswordInput');
    const confirmPassword = document.getElementById('floatingPasswordConfirmInput');
    const phone = document.getElementById('phone');

    //Grabbing all the error containers for each field 
    const firstNameError = document.getElementById('firstNameError');
    const  lastNameError= document.getElementById('lastNameError');
    const emailError = document.getElementById('emailError');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');
    const ConfirmPasswordError = document.getElementById('ConfirmPasswordError');
    const phoneError = document.getElementById('phoneError');
    const stateError = document.getElementById('stateError');
    const universityError = document.getElementById('universityError');



    //adjust the amount of steps dynamically based on the number of steps in the form
    document.documentElement.style.setProperty("--steps", stepIndicators.length);

    // Initialize the current step to 0
    let currentStep = 0;

    // Function to update the progress bar and step indicators on the form based on the current step
    const updateProgress = () => {
        let width = currentStep / (steps.length - 1) ; // Calculate the width percentage based on the current step
        progress.style.transform = `scaleX(${width})`; // Update the progress bar width

        stepsContainer.style.height = steps[currentStep].offsetHeight + "px"; // Adjust the height of the steps container to match the current step's height

        stepIndicators.forEach((indicator, index) => {
            indicator.classList.toggle("current" , currentStep === index); // Add the "current" class to the current step indicator
            indicator.classList.toggle("done", currentStep > index); // Add the "completed" class to all previous step indicators
        });

        // Update the position of each step based on the current step
        steps.forEach((step, index) => {
            step.style.transform = `translateX(-${(currentStep) * 100}%)`; // Move the steps horizontally based on the current step
            step.classList.toggle("current" , currentStep === index);
        });

        UpdateButtons(); // Update the visibility of the "Prev", "Next", and "Submit" buttons based on the current step
    }

    const UpdateButtons = () => {
        prevBtn.hidden = currentStep === 0; // Hide the "Prev" button on the first step
        nextBtn.hidden = currentStep >= steps.length - 1; // Hide the "Next" button on the last step
        submitBtn.hidden = !nextBtn.hidden; // Show the "Submit" button only on the last step
    }


    const isValidStep = () => {
        const fields = steps[currentStep].querySelectorAll("input, textarea , select"); // Get all input fields in the current step

        return [...fields].every((field) => field.reportValidity()); // Check if all input fields in the current step are valid
    }

    //* event listeners 

    const inputs = form.querySelectorAll("input, textarea , select");
    inputs.forEach((input) =>
    input.addEventListener("focus", (e) => {
        const focusedElement = e.target;

        // get the step where the focused element belongs
        const focusedStep = [...steps].findIndex((step) =>
        step.contains(focusedElement)
        );

        // If the focused step is different from the current step, update the current step and progress
        if (focusedStep !== -1 && focusedStep !== currentStep) {
        
            // Check if the current step is valid before allowing the user to move to the focused step
        if (!isValidStep()) return;

        // Update the current step to the focused step and update the progress
        currentStep = focusedStep;
        updateProgress();
        }

        // Scroll the steps container to the top and left when an input field is focused
        stepsContainer.scrollTop = 0;
        stepsContainer.scrollLeft = 0;
    })
    );

    prevBtn.addEventListener("click", (e) => { 
        e.preventDefault();
        if (currentStep > 0) {
            currentStep--;
            updateProgress();
        }

    });


    nextBtn.addEventListener("click", (e) => { 
        e.preventDefault();

        if (hasErrorsInCurrentStep()) { // 
            const validationError = document.getElementById('validationError');
            validationError.classList.add('text-danger');
            validationError.textContent = 'Please fix the errors before proceeding';
            return;
        }else{
            validationError.classList.remove('text-danger');
            validationError.textContent = '';
        }

        //check if the current step is the School Information step
        if(currentStep === 1){
            //make sure the user selects a university and a state before moving to the next step 
            if(universityInput.value === '' || universityInput.value === null ){
                //add the error classes 
                universityError.classList.add('text-danger');
                universityError.classList.remove('success-text');
                universityError.textContent = 'Please Select university and State';

                return;
            }  
        }
        

        if (!isValidStep()) return; // Check if the current step is valid before proceeding to the next step
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateProgress();
        }

    });

    submitBtn.addEventListener("click", (e) => { 
        if (hasErrorsInCurrentStep()) { // 
            e.preventDefault();
            const validationError = document.getElementById('validationError');
            validationError.classList.add('text-danger');
            validationError.textContent = 'Please fix the errors before proceeding';

            return;
        }else{
            validationError.classList.remove('text-danger');
            validationError.textContent = '';
        }

    });
    updateProgress(); // Initial call to set the progress bar and step indicators on page load

    const state = document.getElementById('state');
    const university = document.getElementById('university');

    //get the state_id to send to our controller 
    state.addEventListener('change' , function () {
        const stateId = this.value;

        //Send a request to our controller to get the universities of that state 
        fetch(`register/universities/${stateId}`)
            .then(response => response.json())
            .then(data => {
 
                university.innerHTML = '<option value="" > Select university</option>';
                
                //populating the select with the data we got from our controller 
                data.forEach(uni => {

                    const option = document.createElement('option');

                    option.value = uni.id;
                    option.textContent = uni.name;

                    university.appendChild(option);
                });
            });
    });

    /*
        This function sends a request to our validation controller
        Gets the Errors of a particular input field if theres any 
        then sends a response back to us which we show to the user 
        and if theres no Error it just returns a Valid response 
    */

    //@array form errors  
    let formErrors = {};

    //Check if current step has ANY errors
    const hasErrorsInCurrentStep = () => {
        const fields = steps[currentStep].querySelectorAll("input, textarea, select");
        return [...fields].some(field => formErrors[field.name]); // true if any field in this step has error
    }
    
    function validateField(field , value , errorElement){

        //do not return Empty input 
         if (value === ''){

            //Removing the classes to return empty element 
            errorElement.classList.remove('text-danger');
            errorElement.classList.remove('success-text');
            errorElement.textContent = '';

            delete formErrors[field]; // clear error when empty
            return;
        }

        //skip ajax for avatar and validate locally...
        if(field === 'avatar')return;


        fetch('/register/validate-field' , {
            method: 'POST',

            headers: {
                     'Content-Type': 'application/x-www-form-urlencoded',
                     'X-Requested-With': 'XMLHttpRequest'
                 }, 

                 body: new URLSearchParams({
                     field: field,
                     value: value
                 })
            })
            .then( response => response.json())
            .then(data => {
            
                if( data.valid === true ){

                    delete formErrors[field]; //  clear error

                    errorElement.classList.remove('text-danger');
                    //adding the classes to return styles 
                    errorElement.classList.add('success-text');
                    //Returning a success message if the input was valid 
                    errorElement.textContent = data.success;

                    //Reseting the container height to match the current height 
                    stepsContainer.style.height = steps[currentStep].offsetHeight + "px";
                } else{

                    formErrors[field] = data.errors; // from this field save error
                    
                    //adding the classes to return styles 
                    errorElement.classList.add('text-danger');
                    errorElement.classList.remove('success-text');
                    //Returning an error message if the input was invalid 
                    errorElement.textContent = data.errors;
                    //Reseting the container height to match the current height 
                    stepsContainer.style.height = steps[currentStep].offsetHeight + "px";
                }

             
                
            })
            .catch( error => {
                console.error('Validation error:' , error);
            })
        
        
    }

    //This functions gets the Input field and name of the input then passes them both to validateField().......
    function InputEvent(inputField , name  , errorElement){
        if(inputField){
            inputField.addEventListener('blur' , function(){
                validateField(
                    name ,
                    inputField.value.trim(),
                    errorElement
                );
            });
        }
    }

    //Validate Avatar
    const avatar = document.getElementById('avatar');
    const avatarError = document.getElementById('avatarError');
    if(avatar){
        avatar.addEventListener('blur' , function(){
            validateAvatar(
                avatar , 
                avatarError
            )
        })
    }
    //avatar Validation 
    function validateAvatar(avatar, avatarError){
        const file = avatar.files[0];
        if(!file) {
            delete formErrors['avatar'];
            return;
        }

        const allowedExtensions = ['jpg', 'jpeg', 'png'];
        const extension = file.name.split('.').pop().toLowerCase();
        const allowedTypes = ['image/jpeg', 'image/png'];

        if(!allowedExtensions.includes(extension) || !allowedTypes.includes(file.type)){
            formErrors['avatar'] = 'Only JPG, JPEG and PNG images are allowed.'; // save error

            avatarError.classList.add('text-danger');
            avatarError.classList.remove('success-text');
            avatarError.textContent = formErrors['avatar'];
            return;
        } else if(file.size > 2 * 1024 * 1024){
            formErrors['avatar'] = 'Avatar cannot be larger than 2MB'; // save error

            avatarError.classList.add('text-danger');
            avatarError.classList.remove('success-text');
            avatarError.textContent = formErrors['avatar'];
            return;
        } else {

            delete formErrors['avatar']; // clear errors
            avatarError.classList.remove('text-danger');
            avatarError.classList.add('success-text');
            avatarError.textContent = 'Avatar Successfully added...';
        }
    }


    //Adding the event listener to all the fields 
    InputEvent(firstName , 'first_name' , firstNameError);
    InputEvent(lastName , 'last_name' , lastNameError);
    InputEvent(email , 'email' , emailError);
    InputEvent(username, 'username' , usernameError)
    InputEvent(password , 'password' , passwordError);
    InputEvent(phone , 'phone' , phoneError);
    
    // Special case for selects - validate on change
    if(stateInput){
        stateInput.addEventListener('change' , function(){
            validateField(
                stateInput.name,
                stateInput.value,
                stateError
            )
        })
    }

    if(universityInput){
        universityInput.addEventListener('change' , function(){
            validateField(
                universityInput.name,
                universityInput.value,
                universityError
            )
        })
    }

    

    //check if password and confirm passwords match 
     function checkPasswordMatch() {
        if(confirmPassword.value === '') {
            delete formErrors['password_confirm'];
            return;
        }

        if(password.value !== confirmPassword.value){
            formErrors['password_confirm'] = 'Passwords do not match'; // save error

            ConfirmPasswordError.textContent = formErrors['password_confirm'];
            ConfirmPasswordError.classList.add('text-danger');
            ConfirmPasswordError.classList.remove('success-text');


        } else {
            delete formErrors['password_confirm']; // clear errors

            ConfirmPasswordError.textContent = 'Valid*';
            ConfirmPasswordError.classList.remove('text-danger');
            ConfirmPasswordError.classList.add('success-text');

        }
    }

    password.addEventListener('keyup', checkPasswordMatch);
    confirmPassword.addEventListener('keyup', checkPasswordMatch);
       

    /* NOTE: 
            i would still have to rebuild this page in a more structured way 
            but for now as along as it works i aint touching shiiii.....
            might want to heavily comment though for future refrences 

            DONE WITH MULTISTEP FORM VALIDATION AND STEP HANDLING 
    */
});