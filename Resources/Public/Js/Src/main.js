/**
 * Main JavaScript file for LIEPS TYPO3 Defaults
 * 
 * This file contains all global JavaScript functionality for the website.
 */

// Import required modules
// Uncomment if you need to import additional modules
// import 'bootstrap';
// import './modules/some-module';

class LiepsDefault {
  constructor() {
    this.initComponents();
    this.bindEvents();
  }

  /**
   * Initialize all components
   */
  initComponents() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Bootstrap popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  }

  /**
   * Bind global event listeners
   */
  bindEvents() {
    // Back to top button
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
      window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
          backToTop.classList.add('show');
        } else {
          backToTop.classList.remove('show');
        }
      });

      backToTop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }

    // Add smooth scrolling to all links with hash
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const app = new LiepsDefault();
  
  // Global console signature
  console.log(
    '%c LIEPS TYPO3-Defaults - www.lieps.de',
    'background: #ff8172; color: #ffffff; padding: 5px; border-radius: 5px; font-weight: bold;'
  );
});

// Export for usage in other files
export default LiepsDefault;