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
            if (!megaMenu || megaMenu.dataset.initialized) return;
            megaMenu.dataset.initialized = "true";

            const triggerItems = document.querySelectorAll('.nav-item[data-tab-trigger]');
            const navCardTop = document.querySelector('.nav-card-top');
            let hideTimeout;

            function showMenu(tabId) {
                clearTimeout(hideTimeout);
                megaMenu.classList.add('show-mega');

                // Switch tab sidebar and content panel
                const sidebarItem = megaMenu.querySelector(`.mega-sidebar-item[data-mega-tab="${tabId}"]`);
                if (sidebarItem) {
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    sidebarItem.classList.add('active');
                    const targetPane = megaMenu.querySelector('#' + tabId);
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
                    if (tabId) showMenu(tabId);
                });

                item.addEventListener('mouseleave', function () {
                    hideMenu();
                });
            });

            if (navCardTop) {
                navCardTop.addEventListener('mouseenter', function () {
                    clearTimeout(hideTimeout);
                });
                navCardTop.addEventListener('mouseleave', function () {
                    hideMenu();
                });
            }

            megaMenu.addEventListener('mouseenter', function () {
                clearTimeout(hideTimeout);
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

        function initLiveSearch() {
            const searchInput = document.querySelector('.search-bar-container .search-input');
            const searchTypeInput = document.getElementById('searchType');
            const resultsContainer = document.getElementById('liveSearchResults');
            let debounceTimer;

            if (!searchInput || !resultsContainer) return;

            function performLiveSearch() {
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
                        if (!Array.isArray(data) || data.length === 0) {
                            resultsContainer.innerHTML = `
                                <div class="p-3 text-muted text-center" style="font-size:13px;">
                                    No matching records found for "<strong>${escapeHtml(query)}</strong>"
                                </div>`;
                            resultsContainer.style.display = 'block';
                            return;
                        }

                        let html = '<div class="list-group list-group-flush border-0">';
                        data.forEach(item => {
                            html += `
                                <a href="${item.url}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3 border-bottom border-light text-decoration-none">
                                    <div class="pe-2 text-start">
                                        <div class="fw-bold text-dark" style="font-size:14px; line-height:1.2;">${escapeHtml(item.title)}</div>
                                        <small class="text-muted" style="font-size:12px;">${escapeHtml(item.subtitle)}</small>
                                    </div>
                                    <span class="badge bg-light text-primary border" style="font-size:11px; font-weight:600;">${escapeHtml(item.type)}</span>
                                </a>`;
                        });
                        html += '</div>';

                        resultsContainer.innerHTML = html;
                        resultsContainer.style.display = 'block';
                    })
                    .catch(err => {
                        console.error('Live search error:', err);
                    });
            }

            function escapeHtml(text) {
                return (text || '').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
            }

            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(performLiveSearch, 150);
            });

            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length >= 1) {
                    performLiveSearch();
                }
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-bar-container')) {
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
