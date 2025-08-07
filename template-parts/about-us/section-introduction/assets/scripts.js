document.addEventListener('DOMContentLoaded', function() {
  function animateThreeImages() {
    const imageMain = document.querySelector('.image-main');
    const imageSecondary = document.querySelector('.image-secondary');
    const imageTertiary = document.querySelector('.image-tertiary');    
    const images = [imageMain, imageSecondary, imageTertiary];
    
    images.forEach((image, index) => {
      if (image) {
        image.style.opacity = '0';
        image.style.transform = 'translateX(-150px) scale(0.8)';
        image.style.transition = 'all 600ms cubic-bezier(0.6, 0.02, 0.2, 1.01)';
      }
    });
    
    images.forEach((image, index) => {
      if (image) {
        setTimeout(() => {
          image.style.opacity = '1';
          image.style.transform = 'translateX(0) scale(1)';
        }, 200 + (index * 300));
      }
    });
  }
  
  function setupScrollAnimation() {
    const section = document.querySelector('.introduction-section');
    
    if (!section) {
      console.error('Introduction section not found!');
      return;
    }
    
    console.log('Setting up scroll animation for:', section);
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        console.log('Intersection observed:', entry.isIntersecting);
        if (entry.isIntersecting) {
          console.log('Starting animation...');
          animateThreeImages();
          observer.unobserve(entry.target); 
        }
      });
    }, {
      threshold: 0.1, 
      rootMargin: '0px 0px -20px 0px'
    });
    
    observer.observe(section);
  }
  
  setupScrollAnimation();
  
  setTimeout(() => {
    if (document.querySelector('.image-main') && 
        window.getComputedStyle(document.querySelector('.image-main')).opacity === '1') {
      return; 
    }
    console.log('Fallback animation triggered');
    animateThreeImages();
  }, 2000);
});