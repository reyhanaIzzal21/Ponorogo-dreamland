<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contactCMS', (initialUrl = '') => ({
            embedUrl: initialUrl,
        }))
    })
</script>
