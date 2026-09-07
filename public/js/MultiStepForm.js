document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form-wizard");
    const progress = form.querySelector(".progress");
    const stepsContainer = form.querySelector(".steps-container");
    const steps = form.querySelectorAll(".step");
    const stepIndicators = form.querySelectorAll(".progress-container li");
    const prevBtn = form.querySelector(".prev-btn");
    const nextBtn = form.querySelector(".next-btn");
    const submitBtn = form.querySelector(".submit-btn");

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
        const feilds = steps[currentStep].querySelectorAll("input, textarea"); // Get all input fields in the current step

        return [...feilds].every((field) => field.reportValidity()); // Check if all input fields in the current step are valid
    }

    //* event listeners 

    const inputs = form.querySelectorAll("input, textarea");
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

        if (!isValidStep()) return; // Check if the current step is valid before proceeding to the next step
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateProgress();
        }

    });

    form.addEventListener("submit", (e) => {
        e.preventDefault(); // Prevent the default form submission 

        if(!form.checkValidity()) return; // Check if the form is valid before proceeding with the submission

        const formData = new FormData(form); // Create a FormData object to collect the form data

        console.log(Object.fromEntries(formData)); // Log the form data to the console for demonstration purposes

        submitBtn.disabled = true; // Disable the submit button to prevent multiple submissions
        submitBtn.textContent = "Submitting..."; // Change the submit button text to indicate that the form is being submitted

        //mimic a server request with a timeout
        setTimeout(() => {
            form.querySelector(".completed").hidden = false; // Show the "completed" message after the simulated server request
        }, 3000); // Simulate a 2-second delay for the server request

    })

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

                university.innerHTML = '<option value=""> Select university</option>';
                
//populating the select with the data we got from our controller 
                data.forEach(uni => {

                    const option = document.createElement('option');

                    option.value = uni.id;
                    option.textContent = uni.name;

                    university.appendChild(option);
                });
            });
    });


});