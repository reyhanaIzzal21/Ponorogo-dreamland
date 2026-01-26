<script>
    // Restaurant Page Scripts

    // SCROLL ANIMATION (Intersection Observer)
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-up').forEach(el => {
        observer.observe(el);
    });

    // TAB LOGIC (Simple JS)
    function switchTab(category) {
        // Update Button Styles
        document.querySelectorAll('.tab-btn').forEach(btn => {
            if (btn.dataset.target === category) {
                btn.classList.add('bg-[#1B5E20]', 'text-white');
                btn.classList.remove('text-[#1B5E20]');
            } else {
                btn.classList.remove('bg-[#1B5E20]', 'text-white');
                btn.classList.add('text-[#1B5E20]');
            }
        });

        const contentDiv = document.getElementById('menuContent');
        contentDiv.style.opacity = '0';

        setTimeout(() => {
            let htmlContent = '';

            if (category === 'berat') {
                htmlContent = `
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${createCard('Ayam Lodho', '28.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Rawon Setan', '30.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Soto Lamongan', '22.000', 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=150')}
                    ${createCard('Bebek Goreng', '32.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
               </div>`;
            } else if (category === 'camilan') {
                htmlContent = `
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${createCard('Tempe Mendoan', '10.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Tahu Walik', '12.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Pisang Goreng', '15.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Singkong Keju', '12.000', 'https://images.unsplash.com/photo-1517244683847-7456b63c5969?w=150')}
               </div>`;
            } else {
                htmlContent = `
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${createCard('Wedang Uwuh', '10.000', 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=150')}
                    ${createCard('Jahe Geprek', '8.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Teh Poci', '15.000', 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=150')}
                    ${createCard('Kopi Tubruk', '10.000', 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=150')}
               </div>`;
            }

            contentDiv.innerHTML = htmlContent;
            contentDiv.style.opacity = '1';
        }, 300);
    }

    function createCard(name, price, img) {
        return `
        <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-[#FFF8E1]">
            <img src="${img}" class="w-20 h-20 rounded-lg object-cover">
            <div>
                <h4 class="font-bold text-[#1B5E20] font-heritage">${name}</h4>
                <span class="text-[#B71C1C] font-bold text-sm">Rp ${price}</span>
            </div>
        </div>
        `;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('.tab-btn[data-target="berat"]').click();
    });
</script>
