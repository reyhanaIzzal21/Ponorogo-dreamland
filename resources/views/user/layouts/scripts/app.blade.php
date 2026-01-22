<script>
    // 1. NAVBAR SCROLL EFFECT
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('glass-nav');
            navbar.classList.remove('py-4', 'bg-transparent');
            navbar.classList.add('py-2');
        } else {
            navbar.classList.remove('glass-nav', 'py-2');
            navbar.classList.add('py-4', 'bg-transparent');
        }
    });

    // 2. MOBILE MENU TOGGLE
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
