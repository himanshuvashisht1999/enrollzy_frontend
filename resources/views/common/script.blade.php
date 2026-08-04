<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Swiper Slider JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Image Swiper
            const heroSwiper = new Swiper('.hero-swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.carousel-dots',
                    bulletClass: 'dot',
                    bulletActiveClass: 'active',
                    clickable: true,
                }
            });

            // Student Insights & Feedback Swiper
            const feedbackSwiper = new Swiper('.feedback-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                navigation: {
                    nextEl: '.feedback-next-btn',
                    prevEl: '.feedback-prev-btn',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    }
                }
            });
        });
        (function () {
            const slider = document.getElementById('perfectUnivTabs');
            if (!slider) return;
            let isDown = false;
            let startX;
            let scrollLeft;
            let moved = false;

            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                moved = false;
                slider.classList.add('dragging');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('dragging');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('dragging');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = x - startX;
                if (Math.abs(walk) > 5) moved = true; // threshold so clicks still register as clicks
                slider.scrollLeft = scrollLeft - walk;
            });

            // Prevent tab click from firing right after a drag
            slider.addEventListener('click', (e) => {
                if (moved) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        })();
        function initMegaMenu() {
            const megaMenu = document.querySelector('.mega-menu-wrapper');
            if (!megaMenu) return;

            const triggerItems = document.querySelectorAll('.nav-card-top .nav-item');
            const navCardTop = document.querySelector('.nav-card-top');
            let hideTimeout;

            function showMenu(tabId) {
                clearTimeout(hideTimeout);
                megaMenu.classList.add('show-mega');

                let sidebarItem = null;
                if (tabId) {
                    sidebarItem = megaMenu.querySelector(`.mega-sidebar-item[data-mega-tab="${tabId}"]`);
                }
                if (!sidebarItem) {
                    sidebarItem = megaMenu.querySelector('.mega-sidebar-item');
                }

                if (sidebarItem) {
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    sidebarItem.classList.add('active');
                    const targetTabId = sidebarItem.getAttribute('data-mega-tab');
                    const targetPane = megaMenu.querySelector('#' + targetTabId) || megaMenu.querySelector('.mega-tab-content');
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                }
            }

            function hideMenu() {
                hideTimeout = setTimeout(() => {
                    megaMenu.classList.remove('show-mega');
                }, 300);
            }

            triggerItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    const tabId = this.getAttribute('data-tab-trigger');
                    showMenu(tabId);
                });

                item.addEventListener('mouseleave', function () {
                    hideMenu();
                });
            });

            if (navCardTop) {
                navCardTop.addEventListener('mouseenter', function () {
                    clearTimeout(hideTimeout);
                    megaMenu.classList.add('show-mega');
                });
                navCardTop.addEventListener('mouseleave', function () {
                    hideMenu();
                });
            }

            megaMenu.addEventListener('mouseenter', function () {
                clearTimeout(hideTimeout);
                megaMenu.classList.add('show-mega');
            });

            megaMenu.addEventListener('mouseleave', function () {
                hideMenu();
            });

            // Mega Menu inner sidebar tab switching on hover
            const sidebarItems = megaMenu.querySelectorAll('.mega-sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    this.classList.add('active');
                    const targetTabId = this.getAttribute('data-mega-tab');
                    const targetPane = megaMenu.querySelector('#' + targetTabId);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                });
            });
        }

        function setSearchType(val, label) {
            const typeEl = document.getElementById('searchType');
            const labelEl = document.getElementById('searchFilterLabel');
            if (typeEl) typeEl.value = val;
            if (labelEl) labelEl.innerText = label;
            // Re-trigger search with new type and keep results visible
            const input = document.getElementById('heroSearchInput') || document.querySelector('.search-bar-container .search-input');
            if (input && input.value.trim().length >= 1) {
                setTimeout(function() {
                    performHeroSearch();
                    // Ensure results stay visible after bootstrap dropdown closes
                    const rc = document.getElementById('liveSearchResults');
                    if (rc) setTimeout(function(){ rc.style.display = 'block'; }, 100);
                }, 50);
            }
        }

        function performHeroSearch() {
            const searchInput = document.getElementById('heroSearchInput') || document.querySelector('.search-bar-container .search-input');
            const searchTypeInput = document.getElementById('searchType');
            const resultsContainer = document.getElementById('liveSearchResults');
            if (!searchInput || !resultsContainer) return;

            const query = searchInput.value.trim();
            const type = searchTypeInput ? searchTypeInput.value : '';

            if (query.length < 1) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                return;
            }

            const searchUrl = "{{ route('live.search') }}";

            fetch(`${searchUrl}?q=${encodeURIComponent(query)}&type=${encodeURIComponent(type)}`)
                .then(res => res.json())
                .then(data => {
                    resultsContainer.innerHTML = buildSearchResultsHtml(data, query, type);
                    resultsContainer.style.display = 'block';
                })
                .catch(err => {
                    console.error('Live search error:', err);
                });
        }

        function buildSearchResultsHtml(data, query, type) {
            function escapeHtml(text) {
                return (text || '').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
            }

            // Type badge colors
            const typeColors = {
                'University': '#2d4fa1',
                'Institute': '#6f42c1',
                'School': '#e8960a',
                'Coaching': '#10b981',
                'Mentor': '#e83e8c',
            };

            function getIcon(typeName) {
                const icons = {
                    'University': 'university',
                    'Institute': 'building-columns',
                    'School': 'school',
                    'Coaching': 'chalkboard-teacher',
                    'Mentor': 'user-tie',
                };
                return icons[typeName] || 'circle';
            }

            if (!Array.isArray(data) || data.length === 0) {
                return `<div class="p-3 text-muted text-center" style="font-size:13px;">
                            <i class="fa-solid fa-magnifying-glass me-1"></i>
                            No results found for "<strong>${escapeHtml(query)}</strong>"
                        </div>`;
            }

            // Group by type
            const grouped = {};
            data.forEach(item => {
                if (!grouped[item.type]) grouped[item.type] = [];
                grouped[item.type].push(item);
            });

            let html = '';

            // Header
            html += `<div class="px-3 py-2 d-flex align-items-center justify-content-between" style="background:#f8f9fc;border-bottom:1px solid #e8ecf4;">
                        <span style="font-size:12px;font-weight:700;color:#888;letter-spacing:0.5px;">RESULTS FOR "${escapeHtml(query.toUpperCase())}"</span>
                        <span style="font-size:11px;color:#aaa;">${data.length} found</span>
                    </div>`;

            html += '<div class="list-group list-group-flush border-0">';

            if (type === '') {
                // All categories — show grouped with section headers
                Object.entries(grouped).forEach(([typeName, items]) => {
                    const color = typeColors[typeName] || '#555';
                    html += `<div class="px-3 pt-2 pb-1" style="font-size:11px;font-weight:700;color:${color};letter-spacing:0.8px;text-transform:uppercase;background:#fff;">${typeName}s</div>`;
                    items.forEach(item => {
                        html += `<a href="${item.url}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2 px-3 border-bottom border-light text-decoration-none" style="transition:background 0.15s;">
                                    <div style="width:34px;height:34px;border-radius:8px;background:${color}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:${color};font-size:14px;">
                                        <i class="fa-solid fa-${getIcon(typeName)}"></i>
                                    </div>
                                    <div class="pe-2 text-start flex-grow-1" style="min-width:0;">
                                        <div class="fw-bold text-dark" style="font-size:13.5px;line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escapeHtml(item.title)}</div>
                                        <small class="text-muted" style="font-size:11.5px;">${escapeHtml(item.subtitle)}</small>
                                    </div>
                                    <i class="fa-solid fa-arrow-right" style="color:#ccc;font-size:11px;flex-shrink:0;"></i>
                                </a>`;
                    });
                });
            } else {
                // Single category — flat list
                data.forEach(item => {
                    const color = typeColors[item.type] || '#555';
                    html += `<a href="${item.url}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2 px-3 border-bottom border-light text-decoration-none">
                                <div style="width:34px;height:34px;border-radius:8px;background:${color}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:${color};font-size:14px;">
                                    <i class="fa-solid fa-${getIcon(item.type)}"></i>
                                </div>
                                <div class="pe-2 text-start flex-grow-1" style="min-width:0;">
                                    <div class="fw-bold text-dark" style="font-size:13.5px;line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escapeHtml(item.title)}</div>
                                    <small class="text-muted" style="font-size:11.5px;">${escapeHtml(item.subtitle)}</small>
                                </div>
                                <span style="font-size:10px;font-weight:700;padding:2px 9px;border-radius:20px;background:${color}18;color:${color};flex-shrink:0;">${escapeHtml(item.type)}</span>
                            </a>`;
                });
            }

            html += '</div>';
            return html;
        }

        function initLiveSearch() {
            const searchInput = document.getElementById('heroSearchInput') || document.querySelector('.search-bar-container .search-input');
            const searchTypeInput = document.getElementById('searchType');
            const resultsContainer = document.getElementById('liveSearchResults');
            const searchBtn = document.getElementById('heroSearchBtn');
            let debounceTimer;

            if (!searchInput || !resultsContainer) return;

            function escapeHtml(text) {
                return (text || '').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
            }

            // On input — debounced live search
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(performHeroSearch, 150);
            });

            // On focus — show results if query exists
            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length >= 1) {
                    performHeroSearch();
                }
            });

            // On Search button / Form submit — navigate to global search if query exists
            const searchForm = document.getElementById('heroSearchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const q = searchInput.value.trim();
                    if (!q) {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });
            }

            // Hide liveSearchResults only when clicking truly outside
            // — NOT when clicking the category filter dropdown or its items
            document.addEventListener('click', function(e) {
                const insideSearchBar = e.target.closest('.search-bar-container');
                const insideDropdownMenu = e.target.closest('.dropdown-menu');
                if (!insideSearchBar && !insideDropdownMenu) {
                    resultsContainer.style.display = 'none';
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                initMegaMenu();
                initLiveSearch();
            });
        } else {
            initMegaMenu();
            initLiveSearch();
        }
    </script>
