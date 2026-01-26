<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pendopoCMS', () => ({
            activeTab: 'hero',

            // 2. DUMMY DATA: Venue Specs (Max 4)
            specs: [{
                    title: 'Kapasitas Tamu',
                    desc: '500 - 800 (Standing)'
                },
                {
                    title: 'Dimensi Ruang',
                    desc: '20 x 30 Meter'
                },
                {
                    title: 'Material Lantai',
                    desc: 'Granit HQ'
                },
                {
                    title: 'Kenyamanan',
                    desc: 'Semi-Outdoor'
                }
            ],

            // 3. DUMMY DATA: Fasilitas (Unlimited)
            facilities: [{
                    icon: '🔊',
                    title: 'Sound System Standard',
                    desc: '4 Speaker Aktif, Mixer, 2 Wireless Mic.'
                },
                {
                    icon: '💡',
                    title: 'Lighting Estetik',
                    desc: 'Lampu gantung Jawa & sorot area.'
                },
                {
                    icon: '🚪',
                    title: 'Ruang Transit',
                    desc: 'Privat room untuk VIP/Pengantin.'
                }
            ],

            // 4. DUMMY DATA: Flexibility (Unlimited)
            flexibility: [{
                    title: 'Wedding Setup',
                    image: 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=300'
                },
                {
                    title: 'Seminar Layout',
                    image: 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=300'
                },
            ],

            // Actions
            addSpec() {
                if (this.specs.length < 4) {
                    this.specs.push({
                        title: 'Baru',
                        desc: '...'
                    });
                }
            },
            removeSpec(index) {
                this.specs.splice(index, 1);
            },

            addFacility() {
                this.facilities.push({
                    icon: '✨',
                    title: '',
                    desc: ''
                });
            },
            removeFacility(index) {
                this.facilities.splice(index, 1);
            },

            addFlexibility() {
                // In real app, this triggers file upload dialog
                this.flexibility.push({
                    title: 'Layout Baru',
                    image: 'https://via.placeholder.com/300?text=New+Image'
                });
            },
            removeFlexibility(index) {
                this.flexibility.splice(index, 1);
            }
        }))
    })
</script>
