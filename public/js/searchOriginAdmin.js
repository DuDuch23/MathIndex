document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');  
    const originItems = document.querySelectorAll('.origin-item');

    searchInput.addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();

        originItems.forEach(function(item) {
            const name = item.getAttribute('data-name'); 
            if (name.includes(searchValue)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
