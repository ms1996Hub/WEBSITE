// Add any custom JavaScript here
document.addEventListener('DOMContentLoaded', function() {
    // Example: Add active class to current nav item
    const currentPage = window.location.href.split('page=')[1] || 'home';
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.includes(currentPage)) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
        }
    });
    
    // Auto-hide flash messages after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
