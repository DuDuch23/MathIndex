document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const skillItems = document.querySelectorAll('.skill-item');

    searchInput.addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();

        skillItems.forEach(function(skillItem) {
            const name = skillItem.getAttribute('data-name');
            if (name.includes(searchValue)) {
                skillItem.style.display = '';
            } else {
                skillItem.style.display = 'none';
            }
        });
    });
});
