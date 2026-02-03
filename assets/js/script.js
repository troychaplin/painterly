// :::SECTION:Scroll Animations:::
const animatedElements = document.querySelectorAll('.animate-on-scroll');

if (animatedElements.length > 0) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  animatedElements.forEach(el => observer.observe(el));
}

// :::SECTION:Header Scroll Effect:::
const header = document.querySelector('.hero-header');

if (header) {
  let ticking = false;

  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        if (window.pageYOffset > 100) {
          header.classList.add('is-scrolled');
        } else {
          header.classList.remove('is-scrolled');
        }
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
}

// :::SECTION:Smooth Scrolling:::
const anchorLinks = document.querySelectorAll('a[href^="#"]');

anchorLinks.forEach(link => {
  link.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    
    if (href === '#') return;
    
    const target = document.querySelector(href);
    
    if (target) {
      e.preventDefault();
      
      const headerHeight = header ? header.offsetHeight : 0;
      const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
      
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
    }
  });
});

// :::SECTION:Blog Category Filter:::
const categoryButtons = document.querySelectorAll('.writing-category');
const writingItems = document.querySelectorAll('.writing-item');

if (categoryButtons.length > 0 && writingItems.length > 0) {
  categoryButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Update active state
      categoryButtons.forEach(btn => btn.classList.remove('is-active'));
      button.classList.add('is-active');
      
      const category = button.dataset.category;
      
      // Filter items
      writingItems.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
          item.classList.remove('is-hidden');
          item.style.display = '';
        } else {
          item.classList.add('is-hidden');
          item.style.display = 'none';
        }
      });
    });
  });
}

// :::SECTION:Keyboard Navigation:::
// Improve keyboard accessibility for interactive elements
document.addEventListener('keydown', (e) => {
  // Allow Enter key to activate buttons styled as links
  if (e.key === 'Enter' && e.target.matches('.writing-category')) {
    e.target.click();
  }
});

// :::SECTION:Reduced Motion:::
// Respect user's reduced motion preference
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (prefersReducedMotion.matches) {
  // Disable scroll animations for users who prefer reduced motion
  document.documentElement.classList.remove('js');
}

// Listen for changes in motion preference
prefersReducedMotion.addEventListener('change', (e) => {
  if (e.matches) {
    document.documentElement.classList.remove('js');
  } else {
    document.documentElement.classList.add('js');
  }
});
