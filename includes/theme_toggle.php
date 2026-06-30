<script>
(function() {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
    }
})();
function toggleTheme() {
    document.body.classList.add('theme-transitioning');

    if (document.body.getAttribute('data-theme') === 'dark') {
        document.body.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
    } else {
        document.body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }

    setTimeout(function() {
        document.body.classList.remove('theme-transitioning');
    }, 400);
}
</script>
