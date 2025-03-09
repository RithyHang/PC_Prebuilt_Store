
document.addEventListener("DOMContentLoaded", () => {
     const sectionElements = document.querySelectorAll("section");
     const navigationLinks = document.querySelectorAll(".category ul li");

     const sectionObserver = new IntersectionObserver(
     (entries) => {
          entries.forEach((entry) => {
               if (entry.isIntersecting) {
                    navigationLinks.forEach((link) => link.classList.remove("active"));

                    const sectionId = entry.target.id;
                    const activeNavLink = document.querySelector(`.category ul li a[href="#${sectionId}"]`).parentElement;
                    activeNavLink.classList.add("active");
               }
          });
     },
     {
          threshold: 0.1,
          rootMargin: "0px 0px -50% 0px",
     }
     );
     sectionElements.forEach((section) => sectionObserver.observe(section));

     console.log("Intersection observer initialized."); 
});
// -----------------------------------------
document.addEventListener("DOMContentLoaded", () => {
     const footerImages = document.querySelectorAll('.news1');
     const footerTitle = document.getElementById('members-title'); 

     footerImages.forEach((image) => {
     image.addEventListener('mouseover', () => {
          const imageName = image.getAttribute('data-name'); 

          footerTitle.textContent = imageName; 
     });

     image.addEventListener('mouseout', () => {
          footerTitle.textContent = 'Members'; 
     });
     });

     console.log("Hover effect initialized.");
});
