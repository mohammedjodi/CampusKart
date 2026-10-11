const photoInput = document.getElementById('photoInput');
const photoGrid = document.getElementById('photoGrid');
const brand = document.getElementById('brand');
const condition = document.getElementById('condition');
const description = document.getElementById('description');
const price = document.getElementById('price');
const postBtn = document.getElementById('postBtn');

let uploadedPhotos = [];

function getExistingCount() {
    return document.querySelectorAll('.existing-photo').length;
}

// =========================
// PHOTO UPLOAD
// =========================
photoInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    const totalExisting = getExistingCount() + uploadedPhotos.length;
    const remainingSlots = 4 - totalExisting;

    if (remainingSlots <= 0) {
        toastr.error('Max 4 images allowed');
        e.target.value = '';
        return;
    }

    files.slice(0, remainingSlots).forEach(file => {
        uploadedPhotos.push(file);
    });

    e.target.value = '';
    syncPhotoInput();
    renderPhotos();
    checkForm();
});

// =========================
// SYNC TO INPUT
// =========================
function syncPhotoInput() {
    // Clear the input's files and add the uploadedPhotos to it
    const dt = new DataTransfer();
    uploadedPhotos.forEach(file => dt.items.add(file));
    photoInput.files = dt.files;
}

// =========================
// REMOVE NEW PHOTO ONLY
// =========================
photoGrid.addEventListener('click', (e) => {
    const btn = e.target.closest('.remove-photo-new');
    if (!btn) return;
    
    const index = parseInt(btn.dataset.index, 10);
    uploadedPhotos.splice(index, 1);
    syncPhotoInput();
    renderPhotos();
    checkForm();
});

// =========================
// RENDER - WORKS WITH OUR  HTML
// =========================
function renderPhotos() {
    // Remove only previews we added, don't touch existing-photo or addPhotoBox
    document.querySelectorAll('.preview-photo').forEach(el => el.remove());

    const addBox = document.getElementById('addPhotoBox');

    uploadedPhotos.forEach((file, index) => {
        const div = document.createElement('div');
        div.className = 'photo-item preview-photo';
        div.style.position = 'relative';

        const img = document.createElement('img');
        const url = URL.createObjectURL(file);
        img.src = url;
        img.onload = () => URL.revokeObjectURL(url);

        const removeBtn = document.createElement('div');
        // Use different class so we don't conflict with your existing delete link
        removeBtn.className = 'photo-remove remove-photo-new';
        removeBtn.dataset.index = index;
        removeBtn.innerHTML = '×';
        // removeBtn.style.cssText = 'position:absolute;top:4px;right:4px;background:rgba(0,0,0,0.6);color:#fff;width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;';

        div.appendChild(img);
        div.appendChild(removeBtn);

        // Insert before the plus box
        photoGrid.insertBefore(div, addBox);
    });

    // Hide/show plus box
    const totalCount = getExistingCount() + uploadedPhotos.length;
    if (totalCount >= 4) {
        addBox.style.display = 'none';
    } else {
        addBox.style.display = 'flex';
    }
}

// =========================
// VALIDATION
// =========================
function checkForm() {
    const hasBrand = brand && brand.value !== '';
    const hasCondition = condition && condition.value !== '';
    const hasDescription = description && description.value.trim().length > 0;
    const hasPhotos = (getExistingCount() + uploadedPhotos.length) > 0;
    const hasPrice = price && price.value.trim() !== '';

    const isValid = hasBrand && hasCondition && hasDescription && hasPhotos && hasPrice;

    if(postBtn){
        postBtn.classList.toggle('active', isValid);
        postBtn.disabled = !isValid;
    }
}

if(description){
    description.addEventListener('input', () => {
        const el = document.getElementById('descCount');
        if(el) el.textContent = `${description.value.length} / 500`;
        checkForm();
    });
}
if(brand) brand.addEventListener('change', checkForm);
if(condition) condition.addEventListener('change', checkForm);
if(price) price.addEventListener('input', checkForm);

// Run on load - important for edit mode
document.addEventListener('DOMContentLoaded', () => {
    checkForm();
});