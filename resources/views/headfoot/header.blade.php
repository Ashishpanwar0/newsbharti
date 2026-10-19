
@php
    $headerCategories = \App\Models\Category::with(['subcategories' => function ($query) {
        $query->orderBy('name');
    }])
        ->where('is_active', true)
        ->where('show_in_header', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();
@endphp

<header class="nb-header">

    {{-- TOP BAR --}}
    <div class="nb-top">
        <div class="nb-container nb-top-inner">

            <a href="{{ route('home') }}" class="nb-logo">
                News<span>Bharti</span>
            </a>

            <div class="nb-top-right">
                <!-- <span class="nb-tagline">Latest News &amp; Updates</span> -->

                <div class="nb-clock">
                    <span class="nb-clock-label">INDIA</span>
                    <time id="nbLiveTime">Loading time...</time>
                </div>

                <button
                    type="button"
                    class="nb-menu-toggle"
                    id="nbMenuToggle"
                    aria-label="Open navigation"
                    aria-expanded="false"
                    aria-controls="nbNavigation"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

        </div>
    </div>

    {{-- NAVIGATION --}}
    <nav class="nb-navigation" id="nbNavigation">
        <div class="nb-container">

            <ul class="nb-menu" id="nbMenu">

                <li class="nb-menu-item nb-home-item">
                    <a href="{{ route('home') }}" class="nb-link">Home</a>
                </li>

                @foreach ($headerCategories as $category)
                    <li class="nb-menu-item nb-category-item">
                        <div class="nb-category-row">
                            <a
                                href="{{ route('category.show', ['category' => $category->slug]) }}"
                                class="nb-link"
                            >
                                {{ $category->name }}
                            </a>

                            @if ($category->subcategories->isNotEmpty())
                                <button
                                    type="button"
                                    class="nb-sub-toggle"
                                    aria-label="Show {{ $category->name }} subcategories"
                                    aria-expanded="false"
                                >▾</button>
                            @endif
                        </div>

                        @if ($category->subcategories->isNotEmpty())
                            <ul class="nb-submenu">
                                @foreach ($category->subcategories as $subcategory)
                                    <li>
                                        <a href="{{ route('subcategory.show', [
                                            'category' => $category->slug,
                                            'subcategory' => $subcategory->slug
                                        ]) }}">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                {{-- MORE: extra categories are placed here automatically --}}
                <li class="nb-menu-item nb-more-item" id="nbMoreItem">
                    <button
                        type="button"
                        class="nb-link nb-more-button"
                        id="nbMoreToggle"
                        aria-expanded="false"
                    >
                        More <span aria-hidden="true">▾</span>
                    </button>

                    <ul class="nb-submenu nb-more-menu" id="nbMoreMenu"></ul>
                </li>

            </ul>
        </div>
    </nav>

</header>

<style>
    .nb-header {
        position: relative;
        z-index: 1000;
        background: #fff;
        font-family: Arial, sans-serif;
    }

    .nb-header *,
    .nb-header *::before,
    .nb-header *::after {
        box-sizing: border-box;
    }

    .nb-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* TOP BAR */

    .nb-top {
        border-bottom: 1px solid #eee;
    }

    .nb-top-inner {
        min-height: 78px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .nb-logo {
        color: #c4161c;
        font-size: 31px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
    }

    .nb-logo span {
        color: #202124;
    }

    .nb-top-right {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 22px;
    }

    .nb-tagline {
        color: #666;
        font-size: 13px;
    }

    .nb-clock {
        display: flex;
        flex-direction: column;
        gap: 4px;
        text-align: right;
        white-space: nowrap;
    }

    .nb-clock-label {
        color: #c4161c;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    #nbLiveTime {
        color: #202124;
        font-size: 13px;
        font-weight: 600;
    }

    /* DESKTOP NAVIGATION */

    .nb-navigation {
        background: #202124;
    }

    .nb-menu,
    .nb-submenu {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .nb-menu {
        display: flex;
        flex-wrap: nowrap;
        align-items: stretch;
        width: 100%;
    }

    .nb-menu-item {
        position: relative;
        flex: 0 0 auto;
    }

    .nb-category-row {
        display: flex;
        align-items: stretch;
    }

    .nb-link,
    .nb-sub-toggle {
        display: block;
        border: 0;
        background: transparent;
        color: #fff;
        padding: 14px 12px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.3;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .nb-link:hover,
    .nb-link:focus-visible,
    .nb-sub-toggle:hover,
    .nb-sub-toggle:focus-visible {
        color: #fff;
        background: #c4161c;
    }

    .nb-sub-toggle {
        padding-left: 5px;
        padding-right: 12px;
    }

    /* DROPDOWNS */

    .nb-submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 210px;
        max-width: 280px;
        background: #fff;
        border: 1px solid #e7e7e7;
        box-shadow: 0 8px 18px rgba(0, 0, 0, .14);
        z-index: 1001;
    }

    .nb-submenu a {
        display: block;
        padding: 11px 14px;
        color: #202124;
        font-size: 13px;
        line-height: 1.5;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .nb-submenu a:hover,
    .nb-submenu a:focus-visible {
        background: #f3f3f3;
        color: #c4161c;
    }

    .nb-menu-item:hover > .nb-submenu,
    .nb-menu-item:focus-within > .nb-submenu,
    .nb-menu-item.nb-expanded > .nb-submenu {
        display: block;
    }

    /* MORE DROPDOWN */

    .nb-more-item {
        display: none;
        margin-left: auto;
    }

    .nb-more-button {
        height: 100%;
    }

    .nb-more-menu {
        left: auto;
        right: 0;
        max-height: 70vh;
        overflow-y: auto;
    }

    .nb-more-category {
        border-bottom: 1px solid #eee;
    }

    .nb-more-category-title {
        font-weight: 700;
    }

    .nb-more-subcategory {
        padding-left: 26px !important;
        color: #555 !important;
    }

    /* MOBILE MENU BUTTON */

    .nb-menu-toggle {
        display: none;
        flex: 0 0 auto;
        border: 0;
        background: #202124;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .nb-menu-toggle span {
        display: block;
        width: 23px;
        height: 3px;
        margin: 4px 0;
        background: #fff;
    }

    /* TABLET AND MOBILE */

    @media (max-width: 768px) {
        .nb-top-inner {
            min-height: 70px;
        }

        .nb-logo {
            font-size: 26px;
        }

        .nb-top-right {
            gap: 12px;
        }

        .nb-tagline {
            display: none;
        }

        .nb-clock {
            gap: 3px;
        }

        #nbLiveTime {
            font-size: 11px;
        }

        .nb-menu-toggle {
            display: block;
        }

        .nb-navigation {
            display: none;
        }

        .nb-navigation.nb-nav-open {
            display: block;
        }

        .nb-menu {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .nb-menu-item {
            width: 100%;
            border-bottom: 1px solid #3c3c3c;
        }

        .nb-category-row {
            width: 100%;
        }

        .nb-category-row .nb-link {
            flex: 1;
            white-space: normal;
        }

        .nb-link,
        .nb-sub-toggle {
            padding-top: 13px;
            padding-bottom: 13px;
        }

        .nb-submenu,
        .nb-more-menu {
            position: static;
            width: 100%;
            max-width: none;
            max-height: none;
            overflow: visible;
            border: 0;
            box-shadow: none;
            background: #f5f5f5;
        }

        .nb-menu-item > .nb-submenu {
            display: none;
        }

        .nb-menu-item.nb-expanded > .nb-submenu {
            display: block;
        }

        .nb-submenu a {
            padding: 11px 15px;
            white-space: normal;
        }

        /* On mobile, show all categories in the hamburger menu */
        .nb-more-item {
            display: none !important;
        }

        .nb-category-item.nb-overflow-hidden {
            display: block !important;
        }
    }

    @media (max-width: 380px) {
        .nb-container {
            padding-left: 10px;
            padding-right: 10px;
        }

        .nb-logo {
            font-size: 23px;
        }

        .nb-top-right {
            gap: 8px;
        }

        #nbLiveTime {
            font-size: 10px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('nbMenuToggle');
    const navigation = document.getElementById('nbNavigation');
    const menu = document.getElementById('nbMenu');
    const moreItem = document.getElementById('nbMoreItem');
    const moreToggle = document.getElementById('nbMoreToggle');
    const moreMenu = document.getElementById('nbMoreMenu');

    /*
     * LIVE INDIA TIME
     */
    const clock = document.getElementById('nbLiveTime');

    function updateClock() {
        if (!clock) return;

        clock.textContent = new Intl.DateTimeFormat('en-IN', {
            timeZone: 'Asia/Kolkata',
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        }).format(new Date());

        clock.dateTime = new Date().toISOString();
    }

    updateClock();
    setInterval(updateClock, 1000);


    /*
     * MOBILE HAMBURGER
     */
    if (menuToggle && navigation) {
        menuToggle.addEventListener('click', function () {
            const isOpen = navigation.classList.toggle('nb-nav-open');

            menuToggle.setAttribute('aria-expanded', String(isOpen));
            menuToggle.setAttribute(
                'aria-label',
                isOpen ? 'Close navigation' : 'Open navigation'
            );
        });
    }


    /*
     * SUBCATEGORY TOGGLES
     */
    document.addEventListener('click', function (event) {
        const button = event.target.closest('.nb-sub-toggle');

        if (!button) return;

        const item = button.closest('.nb-menu-item');
        if (!item) return;

        const isOpen = item.classList.toggle('nb-expanded');

        button.setAttribute('aria-expanded', String(isOpen));
    });


    /*
     * MORE DROPDOWN TOGGLE
     */
    if (moreToggle && moreItem) {
        moreToggle.addEventListener('click', function () {
            const isOpen = moreItem.classList.toggle('nb-expanded');

            moreToggle.setAttribute('aria-expanded', String(isOpen));
        });
    }


    /*
     * DESKTOP: MOVE EXTRA CATEGORIES INTO MORE
     * MOBILE: SHOW ALL CATEGORIES IN THE HAMBURGER MENU
     */
    if (!menu || !moreItem || !moreMenu) return;

    const categoryItems = Array.from(
        menu.querySelectorAll(':scope > .nb-category-item')
    );

    const homeItem = menu.querySelector('.nb-home-item');

    function makeMoreLinks(item) {
        const rowLink = item.querySelector('.nb-category-row > .nb-link');
        if (!rowLink) return;

        const categoryEntry = document.createElement('li');
        categoryEntry.className = 'nb-more-category';

        const categoryLink = document.createElement('a');
        categoryLink.href = rowLink.href;
        categoryLink.textContent = rowLink.textContent.trim();
        categoryLink.className = 'nb-more-category-title';

        categoryEntry.appendChild(categoryLink);

        item.querySelectorAll('.nb-submenu a').forEach(function (subLink) {
            const link = document.createElement('a');

            link.href = subLink.href;
            link.textContent = subLink.textContent.trim();
            link.className = 'nb-more-subcategory';

            categoryEntry.appendChild(link);
        });

        moreMenu.appendChild(categoryEntry);
    }

    function arrangeCategories() {
        const isMobile = window.matchMedia('(max-width: 768px)').matches;

        // Reset menu before recalculating layout
        categoryItems.forEach(function (item) {
            item.classList.remove('nb-overflow-hidden');
        });

        moreMenu.innerHTML = '';
        moreItem.classList.remove('nb-expanded');
        moreToggle.setAttribute('aria-expanded', 'false');

        if (isMobile) {
            moreItem.style.display = 'none';
            return;
        }

        moreItem.style.display = 'block';

        // Temporarily hide category items to measure available space
        categoryItems.forEach(function (item) {
            item.style.display = 'none';
        });

        const availableWidth = menu.clientWidth;
        let usedWidth = homeItem ? homeItem.getBoundingClientRect().width : 0;

        const moreWidth = moreItem.getBoundingClientRect().width;

        categoryItems.forEach(function (item) {
            item.style.display = '';
            const itemWidth = item.getBoundingClientRect().width;

            if (usedWidth + itemWidth + moreWidth <= availableWidth) {
                usedWidth += itemWidth;
            } else {
                item.classList.add('nb-overflow-hidden');
                makeMoreLinks(item);
            }
        });

        // Hide More if every category fits
        if (moreMenu.children.length === 0) {
            moreItem.style.display = 'none';
        }
    }

    let resizeTimer;

    function scheduleArrange() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(arrangeCategories, 100);
    }

    arrangeCategories();
    window.addEventListener('resize', scheduleArrange);

});
</script>
