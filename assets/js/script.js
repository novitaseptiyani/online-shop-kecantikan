document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.search-bar-container').forEach(form => {
        const searchInput = form.querySelector('.search-input[name="q"]');
        const searchButton = form.querySelector('button[type="submit"]');

        if (searchInput && searchButton) {
            const updateButtonState = () => {
                searchButton.disabled = searchInput.value.trim() === '';
            };
            updateButtonState(); 
            searchInput.addEventListener('input', updateButtonState); 
            searchInput.addEventListener('change', updateButtonState); 
        }
    });
});
