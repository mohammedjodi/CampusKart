const photoInput = document.getElementById('photoInput');
const photoGrid = document.getElementById('photoGrid');
const brand = document.getElementById('brand');
const condition = document.getElementById('condition');
const description = document.getElementById('description');
const price = document.getElementById('price');
const postBtn = document.getElementById('postBtn');

let uploadedPhotos = [];

// =========================
// PHOTO UPLOAD
// =========================

photoInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);

    const remainingSlots = 4 - uploadedPhotos.length;

    files.slice(0, remainingSlots).forEach(file => {
        uploadedPhotos.push(file);
    });

    // Allow selecting the same file again
    e.target.value = '';

    // Sync selected files with the actual input
    syncPhotoInput();

    renderPhotos();
    checkForm();
});


// =========================
// SYNC FILE INPUT
// =========================

function syncPhotoInput() {
    const dataTransfer = new DataTransfer();
    uploadedPhotos.forEach(file => {
        dataTransfer.items.add(file);

    });
        photoInput.files = dataTransfer.files; 

}
// =========================
// REMOVE PHOTO
// =========================

photoGrid.addEventListener('click', (e) => {
    const btn = e.target.closest('.remove-photo');

    if (!btn) return;

    const index = parseInt(btn.dataset.index, 10);
    uploadedPhotos.splice(index, 1);

    // Update the real file input
    syncPhotoInput();

    renderPhotos();
    checkForm();
});


// =========================
// RENDER PHOTOS
// =========================

function renderPhotos() {
    photoGrid.innerHTML = '';

    uploadedPhotos.forEach((file, index) => {
        const div = document.createElement('div');

        div.style.position = 'relative';

        const img = document.createElement('img');

        const objectUrl = URL.createObjectURL(file);

        img.src = objectUrl;
        img.className = 'photo-preview';

        img.onload = () => {
            URL.revokeObjectURL(objectUrl);
        };

        const removeBtn = document.createElement('div');

        removeBtn.className = 'remove-photo';
        removeBtn.dataset.index = index;

        removeBtn.innerHTML =
            '<i class="icon-copy bi bi-x-lg"></i>';

        div.appendChild(img);
        div.appendChild(removeBtn);

        photoGrid.appendChild(div);
    });

    // Add photo button
    if (uploadedPhotos.length < 4) {
        const addBtn = document.createElement('label');

        addBtn.className = 'add-photo-box';
        addBtn.htmlFor = 'photoInput';

        addBtn.innerHTML =
            '<i class="icon-copy fa fa-plus" aria-hidden="true"></i>';

        photoGrid.appendChild(addBtn);
    }
}

//===============================
//  VALIDATE FORM 
//===============================
function checkForm() {

    const hasBrand = brand.value !== '';
    const hasCondition = condition.value !== '';
    const hasDescription = description.value.trim().length > 0;
    const hasPhotos = uploadedPhotos.length > 0;
    const hasPrice = price.value.trim() !== '';

    const isValid =
        hasBrand &&
        hasCondition &&
        hasDescription &&
        hasPhotos &&
        hasPrice;

    postBtn.classList.toggle('active', isValid);
    postBtn.disabled = !isValid;
}


description.addEventListener('input', () => {
    const descriptionCount = document.getElementById('descCount');
    const count = description.value.length;

    // whatever element you're using for 0 / 500
    descriptionCount.textContent = `${count} / 500`;

    checkForm();
});

brand.addEventListener('change', checkForm);
condition.addEventListener('change', checkForm);
price.addEventListener('input', checkForm);


// DEBUG :(

const form = document.querySelector('form');

// form.addEventListener('submit' , function(e){
//     e.preventDefault()
//         console.log(photoInput?.files);

// })
