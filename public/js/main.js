const title = document.getElementById('title');
const category = document.getElementById('category');
const nextBtn = document.getElementById('nextBtn');
const charCount = document.getElementById('charCount');
const clearBtn = document.getElementById('clearBtn');
const form = document.getElementById('postForm');


title.addEventListener('input', () => {
  charCount.textContent = title.value.length;
  checkForm();
});

category.addEventListener('change', () => {
  const hasCategory = !!category.value;
  checkForm();
});



function checkForm() {
  const isValid = 
    title.value.trim().length > 9 && 
    category.value 
  
  nextBtn.classList.toggle('active', isValid);
  nextBtn.disabled = !isValid;
}

clearBtn.addEventListener('click', (e) => {
  e.preventDefault();
  form.reset();
  charCount.textContent = 0;
  checkForm();
});



