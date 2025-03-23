
document.querySelectorAll('.category-option').forEach(option => {
     option.addEventListener('click', () => {
     document.querySelectorAll('.category-option').forEach(opt => opt.classList.remove('selected'));
     option.classList.add('selected');
     document.getElementById('selectedCategory').value = option.getAttribute('data-value');
     });
});