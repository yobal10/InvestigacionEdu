(() => {
    const searchToggle = document.querySelector('[data-search-toggle]');
    const searchDrawer = document.querySelector('[data-search-drawer]');
    const searchInput = document.getElementById('m-article-search');
    const searchResults = document.querySelector('[data-search-results]');
    const searchItems = [...document.querySelectorAll('[data-search-item]')];
    const emptyResult = document.querySelector('[data-search-empty]');
    const mobileToggle = document.querySelector('[data-mobile-toggle]');
    const mobileNav = document.querySelector('[data-mobile-nav]');

    function closeMenus(except = null) {
        document.querySelectorAll('[data-menu-toggle]').forEach((button) => {
            if (button === except) return;
            button.setAttribute('aria-expanded', 'false');
            button.nextElementSibling.hidden = true;
        });
    }

    searchToggle?.addEventListener('click', () => {
        const opening = searchDrawer.hidden;
        searchDrawer.hidden = !opening;
        searchToggle.setAttribute('aria-expanded', String(opening));
        closeMenus();
        if (opening) searchInput.focus();
    });

    document.querySelector('[data-search-close]')?.addEventListener('click', () => {
        searchDrawer.hidden = true;
        searchToggle.setAttribute('aria-expanded', 'false');
        searchToggle.focus();
    });

    searchInput?.addEventListener('input', () => {
        const query = searchInput.value.trim().toLocaleLowerCase('es');
        let visibleCount = 0;
        searchItems.forEach((item) => {
            const matches = query.length > 0 && item.dataset.searchText.includes(query);
            item.hidden = !matches;
            if (matches) visibleCount += 1;
        });
        searchResults.hidden = query.length === 0;
        emptyResult.hidden = query.length === 0 || visibleCount > 0;
    });

    document.querySelectorAll('[data-menu-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const menu = button.nextElementSibling;
            const opening = menu.hidden;
            closeMenus(button);
            menu.hidden = !opening;
            button.setAttribute('aria-expanded', String(opening));
        });
    });

    mobileToggle?.addEventListener('click', () => {
        const opening = !mobileNav.classList.contains('m-nav-open');
        mobileNav.classList.toggle('m-nav-open', opening);
        mobileToggle.setAttribute('aria-expanded', String(opening));
        mobileToggle.setAttribute('aria-label', opening ? 'Cerrar menú' : 'Abrir menú');
        mobileToggle.textContent = opening ? '×' : '☰';
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.m-menu-wrap')) closeMenus();
        if (!event.target.closest('.m-utility, .m-search-drawer') && !searchDrawer.hidden) {
            searchDrawer.hidden = true;
            searchToggle.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        closeMenus();
        if (!searchDrawer.hidden) {
            searchDrawer.hidden = true;
            searchToggle.setAttribute('aria-expanded', 'false');
            searchToggle.focus();
        }
        mobileNav.classList.remove('m-nav-open');
        mobileToggle.setAttribute('aria-expanded', 'false');
        mobileToggle.setAttribute('aria-label', 'Abrir menú');
        mobileToggle.textContent = '☰';
    });
})();
