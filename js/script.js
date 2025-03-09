document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const toggleSidebarBtn = document.getElementById('toggle-sidebar');
    const mobileToggleBtn = document.getElementById('mobile-toggle');
    const menuIcon = document.querySelector('.menu-icon');
    const xIcon = document.querySelector('.x-icon');
    const navItems = document.querySelectorAll('.nav-item');
    const pageTitle = document.getElementById('page-title');
    const contentSections = document.querySelectorAll('.content-section');
    const logo = document.getElementById('logo');
    const logoSmall = document.getElementById('logo-small');
  
    // Toggle sidebar on desktop
    toggleSidebarBtn.addEventListener('click', function() {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
    });
  
    // Toggle sidebar on mobile
    mobileToggleBtn.addEventListener('click', function() {
      sidebar.classList.toggle('mobile-open');
      
      // Toggle between menu and X icons
      if (sidebar.classList.contains('mobile-open')) {
        menuIcon.style.display = 'none';
        xIcon.style.display = 'block';
      } else {
        menuIcon.style.display = 'block';
        xIcon.style.display = 'none';
      }
    });
  
    // Handle navigation menu clicks
    navItems.forEach(item => {
      item.addEventListener('click', function() {
        // Get the menu identifier
        const menuId = this.getAttribute('data-menu');
        
        // Update active menu item
        navItems.forEach(navItem => {
          navItem.classList.remove('active');
        });
        this.classList.add('active');
        
        // Update page title
        switch(menuId) {
          case 'dashboard':
            pageTitle.textContent = 'Document Verification';
            break;
          case 'user-management':
            pageTitle.textContent = 'User Management';
            break;
          case 'member-management':
            pageTitle.textContent = 'Member Management';
            break;
          case 'site-settings':
            pageTitle.textContent = 'Site Settings';
            break;
        }
        
        // Show corresponding content section
        contentSections.forEach(section => {
          section.classList.remove('active');
        });
        document.getElementById(`${menuId}-content`).classList.add('active');
        
        // Close sidebar on mobile after navigation
        if (window.innerWidth < 1024) {
          sidebar.classList.remove('mobile-open');
          menuIcon.style.display = 'block';
          xIcon.style.display = 'none';
        }
      });
    });
  
    // Handle window resize
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1024) {
        menuIcon.style.display = 'block';
        xIcon.style.display = 'none';
        sidebar.classList.remove('mobile-open');
      }
    });
  
    // Initialize UI based on screen size
    function initializeUI() {
      if (window.innerWidth < 1024) {
        sidebar.classList.remove('mobile-open');
        mainContent.classList.remove('expanded');
      }
    }
  
    // Call initialize on page load
    initializeUI();
  });