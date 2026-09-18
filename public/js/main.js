//get all the elements and thier values 
const title = document.getElementById('title');
const category = document.getElementById('category');
const locationSelect = document.getElementById('location'); 
const photoInput = document.getElementById('photoInput');
const photoGrid = document.getElementById('photoGrid');
const nextBtn = document.getElementById('nextBtn');
const charCount = document.getElementById('charCount');
const clearBtn = document.getElementById('clearBtn');

let uploadedPhotos = []; // an array for photos 

//CHARACTER COUNTER
title.addEventListener('input', () => {
  charCount.textContent = title.value.length;
  checkForm();
});

//ENABLE LOCATION WHEN CATEGORY IS SELECTED
category.addEventListener('change', () => {
  if(category.value) {
    locationSelect.disabled = false;
  } else {
    locationSelect.disabled = true; 
    locationSelect.value = ""; 
  }
  checkForm();
});

locationSelect.addEventListener('change', checkForm); 

//PHOTO UPLOAD
photoInput.addEventListener('change', (e) => {
  const files = Array.from(e.target.files);
  files.forEach(file => {
    if(uploadedPhotos.length >= 4) return;
    const reader = new FileReader();
    reader.onload = (e) => {
      uploadedPhotos.push(e.target.result);
      renderPhotos();
      checkForm();
    }
    reader.readAsDataURL(file);
  });
});

function renderPhotos() {
  photoGrid.innerHTML = '';
  uploadedPhotos.forEach((src, index) => {
    const div = document.createElement('div');
    div.style.position = 'relative';
    div.innerHTML = `
      <img src="${src}" class="photo-preview">
      <div class="remove-photo" onclick="removePhoto(${index})"><i class="icon-copy bi bi-x-lg"></i></div>
    `;
    photoGrid.appendChild(div);
  });
  
  if(uploadedPhotos.length < 4) {
    const addBtn = document.createElement('label');
    addBtn.className = 'add-photo-box';
    addBtn.htmlFor = 'photoInput';
    addBtn.innerHTML = '<i class="icon-copy fa fa-plus" aria-hidden="true"></i>';
    photoGrid.appendChild(addBtn);
  }
}

function removePhoto(index) {
  uploadedPhotos.splice(index, 1);
  renderPhotos();
  checkForm();
}

//CHECK FORM VALIDATION
function checkForm() {
  const isValid = 
    title.value.trim().length > 3 && 
    category.value && 
    locationSelect.value && 
    uploadedPhotos.length > 0;
  
  if(isValid) {
    nextBtn.classList.add('active');
  } else {
    nextBtn.classList.remove('active');
  }
}

// CLEAR BUTTON
clearBtn.addEventListener('click', (e) => {
  e.preventDefault();
  document.getElementById('postForm').reset();
  uploadedPhotos = [];
  locationSelect.disabled = true; // CHANGED
  renderPhotos();
  charCount.textContent = 0;
  checkForm();
});

//  FORM SUBMIT
document.getElementById('postForm').addEventListener('submit', (e) => {
  e.preventDefault();
  if(nextBtn.classList.contains('active')) {
    alert('Form is valid! Go to next step');
    console.log(uploadedPhotos);
  }
});




