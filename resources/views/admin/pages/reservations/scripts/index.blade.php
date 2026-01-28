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

                    this.$watch('search', () => this.debouncedFetch());
                    this.$watch('date', () => this.fetchReservations());
                    this.$watch('filter', () => this.fetchReservations());
                    this.$watch('status', () => this.fetchReservations());

                    // Delegated click handler untuk pagination links (AJAX)
                    document.addEventListener('click', (e) => {
                        const a = e.target.closest('#reservations-pagination a');
                        if (a) {
                            e.preventDefault();
                            const href = a.href;
                            // sinkronkan input berdasarkan href query params
                            try {
                                const u = new URL(href, window.location.origin);
                                const p = u.searchParams;
                                this.search = p.get('search') || '';
                                this.date = p.get('date') || '';
                                this.filter = p.get('type') || 'all';
                                this.status = p.get('status') || 'all';
                            } catch (err) {
                                // ignore invalid URL parse
                            }
                            this.fetchByUrl(href);
                        }
                    });
                },

                debouncedFetch() {
                    if (this._debounceTimer) clearTimeout(this._debounceTimer);
                    this._debounceTimer = setTimeout(() => {
                        this.fetchReservations();
                    }, 500);
                },

                // build the export url relative to current path
                get exportUrl() {
                    const basePath = window.location.pathname.replace(/\/$/, '');
                    const params = new URLSearchParams({
                        search: this.search || '',
                        date: this.date || '',
                        type: this.filter || 'all',
                        status: this.status || 'all'
                    }).toString();

                    return `${basePath}/export${params ? ('?' + params) : ''}`;
                },

                // generic fetch with current filters (page reset to 1)
                async fetchReservations() {
                    const params = new URLSearchParams({
                        search: this.search || '',
                        date: this.date || '',
                        type: this.filter || 'all',
                        status: this.status || 'all'
                    });

                    const url = `{{ route('admin.reservation.index') }}?${params.toString()}`;

                    // update browser URL (ke page 1)
                    window.history.replaceState({}, '',
                        `${window.location.pathname}?${params.toString()}`);

                    await this.fetchByUrl(url);
                },

                // fetch by any URL (used by pagination click as well)
                async fetchByUrl(url) {
                    this.isLoading = true;

                    try {
                        const response = await fetch(url, {
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

                        // update total counter card if provided
                        if (json.total !== undefined) {
                            const totalNode = document.querySelector('[data-reservations-total]');
                            if (totalNode) totalNode.textContent = json.total;
                        }

                        // update browser URL to the requested URL
                        try {
                            const u = new URL(url, window.location.origin);
                            window.history.replaceState({}, '', u.pathname + u.search);
                        } catch (err) {
                            // ignore
                        }

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
