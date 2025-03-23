document.addEventListener('DOMContentLoaded', () => {
     const toggleButton = document.querySelector('.menu-toggle');
     const fadeMenu = document.querySelector('.fade-menu');
     const backButton = document.querySelector('.back-btn');
     const buttonContainer = document.querySelector('.button-container');

     toggleButton.addEventListener('click', () => {
     fadeMenu.classList.add('active');
     buttonContainer.style.transform = 'translateY(-100px)';
     });

     backButton.addEventListener('click', () => {
     fadeMenu.classList.remove('active');
     buttonContainer.style.transform = 'translateY(0)';
     });
});

