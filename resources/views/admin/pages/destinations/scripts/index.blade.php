<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('destinationMaster', () => ({
            isModalOpen: false,
            modalMode: 'add', // 'add' or 'edit'

            // FORM MODEL
            form: {
                id: null,
                name: '',
                type: 'Resto',
                status: 'open',
                desc: '',
                image: ''
            },

            // DUMMY DATA
            destinations: [{
                    id: 1,
                    name: 'Dam Cokro Resto',
                    type: 'F&B',
                    status: 'open',
                    desc: 'Restoran keluarga dengan cita rasa nusantara dan suasana alam yang asri.',
                    image: 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=600',
                    views: '12.5k',
                    updated: '2 Jam lalu',
                    cms_link: '/admin/cms/resto' // Link ke halaman yang kita buat sebelumnya
                },
                {
                    id: 2,
                    name: 'Pendopo Ageng',
                    type: 'Venue',
                    status: 'open',
                    desc: 'Ruang serbaguna elegan untuk pernikahan, meeting, dan gathering skala besar.',
                    image: 'https://images.unsplash.com/photo-1519225421980-715cb0202128?q=80&w=600',
                    views: '8.2k',
                    updated: '1 Hari lalu',
                    cms_link: '/admin/cms/pendopo'
                },
                {
                    id: 3,
                    name: 'Kolam Renang',
                    type: 'Recreation',
                    status: 'soon',
                    desc: 'Wahana rekreasi air modern untuk keluarga. (Sedang dalam pembangunan)',
                    image: 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=600',
                    views: '45.1k',
                    updated: 'Baru saja',
                    cms_link: '/admin/cms/pool'
                }
            ],

            // HELPER FUNCTIONS
            getStatusClass(status) {
                const classes = {
                    'open': 'status-open',
                    'closed': 'status-closed',
                    'soon': 'status-soon',
                    'maintenance': 'status-maintenance'
                };
                return classes[status] || 'bg-gray-100 text-gray-800';
            },

            getStatusLabel(status) {
                const labels = {
                    'open': '🟢 Open',
                    'closed': '🔴 Closed',
                    'soon': '🚧 Coming Soon',
                    'maintenance': '🔧 Maintenance'
                };
                return labels[status] || status;
            },

            openModal(mode, data = null) {
                this.modalMode = mode;
                if (mode === 'edit' && data) {
                    this.form = {
                        ...data
                    }; // Copy object
                } else {
                    this.form = {
                        id: null,
                        name: '',
                        type: 'Resto',
                        status: 'open',
                        desc: '',
                        image: ''
                    };
                }
                this.isModalOpen = true;
            },

            closeModal() {
                this.isModalOpen = false;
            }
        }))
    })
</script>
