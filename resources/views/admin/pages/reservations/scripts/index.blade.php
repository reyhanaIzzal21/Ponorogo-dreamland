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
                        time: '09:00',
                        date: '10 Feb 2026',
                        occasion: 'Wedding',
                        pax: 200,
                        wa_status: 'failed', // WA Gagal (Perlu Alert)
                        notes: 'Butuh test food minggu depan',
                    },
                        status: 'pending'
                    id: 3,
                    {
                        wa: '081122334455',
                        name: 'Andi Pratama',
                        date: '28 Jan 2026',
                        venue: 'Resto',
                        pax: 2,
                        time: '12:00',
                        notes: '',
                        occasion: 'Meeting Casual',
                        status: 'pending'
                        wa_status: 'sent',
                        {
                    },
                        name: 'CV Maju Jaya',
                        id: 4,
                        venue: 'Pendopo',
                        wa: '089988776655',
                        time: '08:00',
                        date: '15 Feb 2026',
                        occasion: 'Gathering',
                        pax: 50,
                        wa_status: 'sent',
                        notes: 'Butuh sound system tambahan',
                    }
                        status: 'done'

                ],                // Computed Property Logic (Simulated in Alpine)

                if (this.filter === 'all') return this.reservations;
                get filteredItems() {
                    return this.reservations.filter(item => item.venue.toLowerCase() === this
                    // Simple filter logic (case insensitive)

                        .filter);
                },
                getStatusClass(status) {
                // Status Styling Logic
                    'pending': 'badge-pending',
                    const classes = {
                        'cancelled': 'badge-cancelled',
                        'confirmed': 'badge-confirmed',
                    };
                        'done': 'badge-done'

                    return classes[status] || 'bg-gray-100';
                },                // Action: View Detail Modal

                this.selectedItem = item;
                viewDetail(item) {

                    this.modalOpen = true;
                },                // Action: Resend WA

                alert('Mengirim ulang notifikasi WA ke ID: ' + id + '...');
                resendWA(id) {
                    // Setelah sukses, update this.reservations[index].wa_status = 'sent'
                    // Di sini nanti logic AJAX ke backend
                }))
                }
            </script>
        })
