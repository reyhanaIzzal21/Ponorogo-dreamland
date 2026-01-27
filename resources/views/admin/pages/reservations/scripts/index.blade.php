    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationManager', () => ({
                filter: 'all',
                modalOpen: false,
                selectedItem: {}, // Placeholder for modal data

                // DUMMY DATA LENGKAP
                reservations: [{
                        id: 1,
                        name: 'Budi Santoso',
                        wa: '081234567890',
                        venue: 'Resto',
                        date: '28 Jan 2026',
                        time: '19:00',
                        pax: 4,
                        occasion: 'Makan Malam',
                        notes: 'Minta meja dekat kolam ikan ya',
                        wa_status: 'sent', // WA Terkirim
                        status: 'confirmed'
                    },
                    {
                        id: 2,
                        name: 'Siti Aminah',
                        wa: '085678901234',
                        venue: 'Pendopo',
                        date: '10 Feb 2026',
                        time: '09:00',
                        pax: 200,
                        occasion: 'Wedding',
                        notes: 'Butuh test food minggu depan',
                        wa_status: 'failed', // WA Gagal (Perlu Alert)
                        status: 'pending'
                    },
                    {
                        id: 3,
                        name: 'Andi Pratama',
                        wa: '081122334455',
                        venue: 'Resto',
                        date: '28 Jan 2026',
                        time: '12:00',
                        pax: 2,
                        occasion: 'Meeting Casual',
                        notes: '',
                        wa_status: 'sent',
                        status: 'pending'
                    },
                    {
                        id: 4,
                        name: 'CV Maju Jaya',
                        wa: '089988776655',
                        venue: 'Pendopo',
                        date: '15 Feb 2026',
                        time: '08:00',
                        pax: 50,
                        occasion: 'Gathering',
                        notes: 'Butuh sound system tambahan',
                        wa_status: 'sent',
                        status: 'done'
                    }
                ],

                // Computed Property Logic (Simulated in Alpine)
                get filteredItems() {
                    if (this.filter === 'all') return this.reservations;
                    // Simple filter logic (case insensitive)
                    return this.reservations.filter(item => item.venue.toLowerCase() === this
                        .filter);
                },

                // Status Styling Logic
                getStatusClass(status) {
                    const classes = {
                        'pending': 'badge-pending',
                        'confirmed': 'badge-confirmed',
                        'cancelled': 'badge-cancelled',
                        'done': 'badge-done'
                    };
                    return classes[status] || 'bg-gray-100';
                },

                // Action: View Detail Modal
                viewDetail(item) {
                    this.selectedItem = item;
                    this.modalOpen = true;
                },

                // Action: Resend WA
                resendWA(id) {
                    alert('Mengirim ulang notifikasi WA ke ID: ' + id + '...');
                    // Di sini nanti logic AJAX ke backend
                    // Setelah sukses, update this.reservations[index].wa_status = 'sent'
                }
            }))
        })
    </script>
