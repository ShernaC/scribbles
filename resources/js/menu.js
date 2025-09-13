document.addEventListener('DOMContentLoaded', function() {
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const closeBtn = document.getElementById('close-btn');

    if (!hamburgerBtn || !sidebar || !sidebarOverlay || !closeBtn) {
        console.warn('Sidebar elements not found');
        return;
    }

    hamburgerBtn.addEventListener('click', function() {
        openSidebar();
    })

    closeBtn.addEventListener('click', function() {
        closeSidebar();
    });

    sidebarOverlay.addEventListener('click', function() {
        closeSidebar();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('left-0')) {
            closeSidebar();
        }
    });

    function openSidebar() {
        sidebar.classList.remove('-left-80');
        sidebar.classList.add('left-0');
        sidebarOverlay.classList.remove('opacity-0', 'invisible');
        sidebarOverlay.classList.add('opacity-100', 'visible');

        hamburgerBtn.classList.remove('opacity-100', 'visible');
        hamburgerBtn.classList.add('opacity-0', 'invisible');
    }

    function closeSidebar() {
        sidebar.classList.remove('left-0');
        sidebar.classList.add('-left-80');
        sidebarOverlay.classList.remove('opacity-100', 'visible');
        sidebarOverlay.classList.add('opacity-0', 'invisible');
        
        hamburgerBtn.classList.remove('opacity-0', 'invisible');
        hamburgerBtn.classList.add('opacity-100', 'visible');
    }
});