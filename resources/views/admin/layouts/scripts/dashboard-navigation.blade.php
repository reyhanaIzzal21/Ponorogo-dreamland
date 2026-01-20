<script>
    // Mobile Sidebar Toggle
    function openSidebarAdminDashboard() {
        const sidebar = document.getElementById('application-sidebar-brand');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.remove('-translate-x-full', 'hidden');
        sidebar.classList.add('translate-x-0');
        backdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebarAdminDashboard() {
        const sidebar = document.getElementById('application-sidebar-brand');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        backdrop.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Dropdown Toggle
    function toggleDropdownAdminDashboard(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const allDropdowns = document.querySelectorAll('[data-dropdown-menu]');

        // Close all other dropdowns
        allDropdowns.forEach(d => {
            if (d.id !== dropdownId) {
                d.classList.add('hidden', 'opacity-0');
            }
        });

        // Toggle current dropdown
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            setTimeout(() => dropdown.classList.remove('opacity-0'), 10);
        } else {
            dropdown.classList.add('opacity-0');
            setTimeout(() => dropdown.classList.add('hidden'), 200);
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        const dropdowns = document.querySelectorAll('[data-dropdown-menu]');
        const triggers = document.querySelectorAll('[data-dropdown-toggle]');

        let clickedOnDropdown = false;
        triggers.forEach(trigger => {
            if (trigger.contains(e.target)) clickedOnDropdown = true;
        });
        dropdowns.forEach(dropdown => {
            if (dropdown.contains(e.target)) clickedOnDropdown = true;
        });

        if (!clickedOnDropdown) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.add('opacity-0');
                setTimeout(() => dropdown.classList.add('hidden'), 200);
            });
        }
    });

    // Accordion Toggle for Sidebar
    document.querySelectorAll('[data-accordion-toggle]').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-accordion-toggle');
            const content = document.getElementById(targetId);
            const icon = this.querySelector('.accordion-icon');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                if (icon) icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                if (icon) icon.classList.remove('rotate-180');
            }
        });
    });
</script>
