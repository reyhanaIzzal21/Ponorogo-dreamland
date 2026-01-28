<script>
    (function() {
        function registerReservationManager(Alpine) {
            Alpine.data('reservationManager', () => ({
                filter: 'all',
                search: '',
                date: '',
                status: 'all',
                isLoading: false,
                _debounceTimer: null,

                init() {
                    const urlParams = new URLSearchParams(window.location.search);
                    this.search = urlParams.get('search') || '';
                    this.date = urlParams.get('date') || '';
                    this.filter = urlParams.get('type') || 'all';
                    this.status = urlParams.get('status') || 'all';

                    this.$watch('search', (val) => this.debouncedFetch());
                    this.$watch('date', () => this.fetchReservations());
                    this.$watch('filter', () => this.fetchReservations());
                    this.$watch('status', () => this.fetchReservations());
                },

                debouncedFetch() {
                    if (this._debounceTimer) clearTimeout(this._debounceTimer);
                    this._debounceTimer = setTimeout(() => {
                        this.fetchReservations();
                    }, 500);
                },

                // ---------- SAFER exportUrl: build from current path ----------
                get exportUrl() {
                    // base path e.g. "/admin/reservation" (no trailing slash)
                    const basePath = window.location.pathname.replace(/\/$/, '');
                    const params = new URLSearchParams({
                        search: this.search || '',
                        date: this.date || '',
                        type: this.filter || 'all',
                        status: this.status || 'all'
                    }).toString();

                    return `${basePath}/export${params ? ('?' + params) : ''}`;
                },

                async fetchReservations() {
                    this.isLoading = true;
                    const params = new URLSearchParams({
                        search: this.search || '',
                        date: this.date || '',
                        type: this.filter || 'all',
                        status: this.status || 'all'
                    });

                    const newUrl = `${window.location.pathname}?${params.toString()}`;
                    window.history.replaceState({}, '', newUrl);

                    try {
                        const response = await fetch(
                            `{{ route('admin.reservation.index') }}?${params.toString()}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                }
                            });

                        if (!response.ok) throw new Error('Network response was not ok');

                        const json = await response.json();

                        const tableBody = document.getElementById('reservations-table-body');
                        const pagination = document.getElementById('reservations-pagination');

                        if (tableBody && json.table) tableBody.innerHTML = json.table;
                        if (pagination && json.pagination) pagination.innerHTML = json.pagination;

                    } catch (error) {
                        console.error('Error fetching reservations:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            }));
        }

        if (window.Alpine) {
            registerReservationManager(window.Alpine);
        } else {
            document.addEventListener('alpine:init', () => {
                registerReservationManager(window.Alpine);
            });
        }
    })();
</script>
