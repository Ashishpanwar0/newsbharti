
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=3">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Samachar Bharti | ताज़ा खबरें और ब्रेकिंग न्यूज़</title>
    <meta name="description" content="Samachar Bharti पर पढ़ें देश, उत्तराखंड, राजनीति, शिक्षा, खेल और अन्य विषयों की ताज़ा खबरें और पूरी रिपोर्ट।">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="canonical" href="{{ url('/') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Samachar Bharti">
    <meta property="og:title" content="Samachar Bharti | ताज़ा खबरें">
    <meta property="og:description" content="ताज़ा खबरें, ब्रेकिंग न्यूज़ और पूरी रिपोर्ट पढ़ें।">
    <meta property="og:url" content="{{ url('/') }}">

    <meta name="theme-color" content="#ed101b">

    <style>
        :root {
            --red: #ed101b;
            --blue: #1239c5;
            --dark: #172033;
            --muted: #6b7280;
            --page: #f4f6fb;
            --border: #e4e8f0;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            background: var(--page);
            color: var(--dark);
            font-family: Arial, "Noto Sans Devanagari", sans-serif;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
        }

        button { font: inherit; }

        .sb-container {
            max-width: 1200px;
            width: 100%;
            margin: auto;
            padding: 0 16px;
        }

        /* SAMACHAR BHARTI BRAND POLISH */
        ::selection { background: rgba(18, 57, 197, .16); color: var(--dark); }

        .sb-container { max-width: 1240px; }

        .sb-breaking {
            border-radius: 8px;
            box-shadow: 0 3px 14px rgba(23, 32, 51, .035);
        }

        .sb-breaking-label {
            min-height: 42px;
            display: flex;
            align-items: center;
            letter-spacing: .15px;
        }

        .sb-section-heading {
            border-bottom-width: 2px;
            border-image: linear-gradient(90deg, var(--red), rgba(18, 57, 197, .32)) 1;
        }

        .sb-slider {
            border: 1px solid rgba(23, 32, 51, .08);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(23, 32, 51, .08);
        }

        .sb-slide-image, .sb-slide-placeholder { transition: transform .45s ease; }
        .sb-slide-link:hover .sb-slide-image { transform: scale(1.015); }

        .sb-slide-placeholder {
            background: radial-gradient(circle at 85% 10%, rgba(255,255,255,.12), transparent 28%),
                        linear-gradient(135deg, #1239c5 0%, #172033 76%);
        }

        .sb-slide-caption h2 { text-wrap: balance; }

        .sb-slider-controls button {
            border: 1px solid rgba(255,255,255,.35);
            transition: background .2s ease, transform .2s ease;
        }
        .sb-slider-controls button:hover {
            background: var(--red);
            transform: scale(1.06);
        }

        .sb-card, .sb-category-card, .sb-side-card {
            border-radius: 10px;
            box-shadow: 0 3px 14px rgba(23, 32, 51, .035);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }
        .sb-card:hover, .sb-category-card:hover, .sb-side-card:hover {
            transform: translateY(-3px);
            border-color: rgba(18, 57, 197, .22);
            box-shadow: 0 10px 24px rgba(23, 32, 51, .09);
        }

        .sb-image, .sb-slide-image { background-color: #e9edf5; }
        .sb-category-card h3 a:hover { color: var(--blue); }

        .sb-ad-slot {
            border-radius: 8px;
            background: linear-gradient(135deg, #eef1f7, #f7f8fb);
        }

        .sb-empty { border-radius: 8px; }

        .sb-pagination a:hover, .sb-pagination span:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        @media (max-width: 768px) {
            .sb-breaking { gap: 9px; }
            .sb-slider { border-radius: 9px; }
            .sb-slide-caption { background: linear-gradient(transparent, rgba(12, 19, 37, .94)); }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; animation-duration: .01ms !important; }
        }

        /* BREAKING NEWS */

        .sb-breaking {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 16px 0;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 5px;
            overflow: hidden;
        }

        .sb-breaking-label {
            flex-shrink: 0;
            padding: 10px 12px;
            background: var(--red);
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        .sb-breaking-track {
            display: flex;
            gap: 25px;
            padding: 10px 0;
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: thin;
        }

        .sb-breaking-track a {
            font-size: 13px;
            font-weight: 700;
        }

        .sb-breaking-track a:hover { color: var(--red); }

        /* SECTION HEADINGS */

        .sb-section { margin: 28px 0; }

        .sb-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            padding-bottom: 9px;
            border-bottom: 3px solid var(--red);
        }

        .sb-section-heading h1,
        .sb-section-heading h2 {
            margin: 0;
            font-size: 22px;
            line-height: 1.4;
        }

        .sb-more {
            color: var(--red);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* SLIDER */

        .sb-slider {
            position: relative;
            overflow: hidden;
            background: #151515;
            border-radius: 8px;
        }

        .sb-slide { display: none; }

        .sb-slide.sb-active { display: block; }

        .sb-slide-link {
            position: relative;
            display: block;
            color: white;
        }

        .sb-slide-image {
            width: 100%;
            height: 440px;
            object-fit: cover;
            opacity: .83;
        }

        .sb-slide-placeholder {
            display: grid;
            place-items: center;
            height: 440px;
            background: linear-gradient(135deg, #1239c5 0%, #172033 72%);
            color: white;
            font-size: 22px;
            font-weight: 800;
        }

        .sb-slide-caption {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 55px 25px 25px;
            background: linear-gradient(transparent, rgba(0,0,0,.9));
        }

        .sb-slide-category {
            display: inline-block;
            margin-bottom: 8px;
            padding: 4px 8px;
            background: var(--red);
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .sb-slide-caption h2 {
            max-width: 850px;
            margin: 0 0 8px;
            font-size: 30px;
            line-height: 1.45;
        }

        .sb-slide-caption p {
            max-width: 750px;
            margin: 0;
            color: #eee;
            font-size: 14px;
        }

        .sb-slider-controls {
            position: absolute;
            top: 50%;
            right: 12px;
            left: 12px;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .sb-slider-controls button {
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 50%;
            background: rgba(0,0,0,.65);
            color: white;
            cursor: pointer;
            pointer-events: auto;
        }

        .sb-slider-dots {
            display: flex;
            justify-content: center;
            gap: 7px;
            padding: 12px;
            background: white;
        }

        .sb-slider-dot {
            width: 9px;
            height: 9px;
            padding: 0;
            border: 0;
            border-radius: 50%;
            background: #c7cbd1;
            cursor: pointer;
        }

        .sb-slider-dot.sb-active {
            width: 23px;
            border-radius: 8px;
            background: var(--red);
        }

        /* AD PLACEHOLDER */

        .sb-ad-slot {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90px;
            margin: 22px 0;
            padding: 12px;
            border: 1px dashed #c8cdd5;
            background: #eceff3;
            color: #737984;
            text-align: center;
            font-size: 12px;
        }

        .sb-ad-slot span { display: block; }

        /* NEWS CARDS */

        .sb-feature-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr);
            gap: 18px;
        }

        .sb-card {
            min-width: 0;
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 7px;
        }

        .sb-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,.07);
        }

        .sb-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
            background: #e5e9ef;
        }

        .sb-feature-image { height: 320px; }

        .sb-image-placeholder {
            display: grid;
            place-items: center;
            min-height: 180px;
            background: #e5e9ef;
            color: #6b7280;
        }

        .sb-content { padding: 15px; }

        .sb-category {
            display: inline-block;
            margin-bottom: 7px;
            color: var(--red);
            font-size: 12px;
            font-weight: 800;
        }

        .sb-title {
            margin: 0 0 9px;
            font-size: 18px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .sb-title a:hover { color: var(--red); }

        .sb-feature-title { font-size: 25px; }

        .sb-excerpt {
            margin: 0 0 10px;
            color: #59616d;
            font-size: 14px;
        }

        .sb-meta {
            color: var(--muted);
            font-size: 12px;
        }

        .sb-side-list {
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .sb-side-card {
            display: grid;
            grid-template-columns: 100px minmax(0,1fr);
            gap: 12px;
            padding: 10px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 6px;
        }

        .sb-side-card img,
        .sb-side-placeholder {
            width: 100px;
            height: 82px;
            object-fit: cover;
            background: #e5e9ef;
        }

        .sb-side-placeholder {
            display: grid;
            place-items: center;
            font-size: 11px;
        }

        .sb-side-card h3 {
            margin: 0 0 6px;
            font-size: 14px;
            line-height: 1.5;
        }

        .sb-news-grid {
            display: grid;
            grid-template-columns: repeat(3,minmax(0,1fr));
            gap: 17px;
        }

        .sb-category-grid {
            display: grid;
            grid-template-columns: repeat(4,minmax(0,1fr));
            gap: 13px;
        }

        .sb-category-card {
            padding: 14px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 7px;
        }

        .sb-category-card h3 {
            margin: 0 0 8px;
            font-size: 15px;
            line-height: 1.5;
        }

        .sb-empty {
            padding: 22px;
            background: white;
            border: 1px solid var(--border);
            color: var(--muted);
            text-align: center;
        }

        .sb-pagination {
            margin: 22px 0;
            overflow-x: auto;
        }

        .sb-pagination nav > div {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .sb-pagination a,
        .sb-pagination span {
            display: inline-block;
            padding: 7px 11px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 13px;
        }

        .sb-pagination [aria-current="page"] span {
            background: var(--blue);
            color: white;
        }

        /* MOBILE BOTTOM NAVIGATION */

        .sb-mobile-nav { display: none; }

        @media (max-width: 768px) {
            body { padding-bottom: 76px; }

            .sb-container { padding: 0 11px; }

            .sb-section { margin: 22px 0; }

            .sb-section-heading h1,
            .sb-section-heading h2 { font-size: 19px; }

            .sb-feature-layout { grid-template-columns: 1fr; }

            .sb-feature-image { height: 255px; }

            .sb-feature-title { font-size: 22px; }

            .sb-side-list {
                display: grid;
                grid-template-columns: 1fr;
            }

            .sb-news-grid {
                grid-template-columns: repeat(2,minmax(0,1fr));
                gap: 11px;
            }

            .sb-news-grid .sb-image { height: 145px; }

            .sb-news-grid .sb-content { padding: 11px; }

            .sb-news-grid .sb-title { font-size: 15px; }

            .sb-news-grid .sb-excerpt { font-size: 12px; }

            .sb-category-grid {
                grid-template-columns: repeat(2,minmax(0,1fr));
                gap: 10px;
            }

            .sb-category-card { padding: 11px; }

            .sb-slide-image,
            .sb-slide-placeholder { height: 300px; }

            .sb-slide-caption { padding: 48px 15px 17px; }

            .sb-slide-caption h2 { font-size: 21px; }

            .sb-slide-caption p { font-size: 12px; }

            .sb-mobile-nav {
                position: fixed;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 2000;
                display: grid;
                grid-template-columns: repeat(5,minmax(0,1fr));
                align-items: center;
                min-height: 68px;
                padding: 5px 4px max(5px, env(safe-area-inset-bottom));
                background: rgba(255,255,255,.98);
                border-top: 1px solid #e0e3e8;
                box-shadow: 0 -3px 15px rgba(0,0,0,.08);
            }

            .sb-mobile-link {
                display: flex;
                min-width: 0;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                color: #777d87;
                font-size: 10px;
                line-height: 1.2;
                text-align: center;
            }

            .sb-mobile-icon {
                display: grid;
                place-items: center;
                width: 31px;
                height: 31px;
                font-size: 21px;
            }

            .sb-mobile-link.sb-current { color: var(--red); }

            .sb-mobile-link.sb-center {
                margin-top: -24px;
            }

            .sb-mobile-link.sb-center .sb-mobile-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                background: #ed101b;
                color: #ffffff;
                box-shadow: 0 3px 10px rgba(0,0,0,.18);
                font-size: 25px;
            }

            .sb-ad-slot { min-height: 70px; }
        }

        @media (max-width: 380px) {
            .sb-container { padding: 0 8px; }

            .sb-breaking-label { padding: 8px; font-size: 10px; }

            .sb-breaking-track { gap: 16px; }

            .sb-news-grid { gap: 8px; }

            .sb-news-grid .sb-image { height: 125px; }

            .sb-news-grid .sb-content { padding: 9px; }

            .sb-news-grid .sb-title { font-size: 14px; }

            .sb-mobile-link { font-size: 9px; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
        }
    </style>
</head>

<body>

@include('headfoot.header')

<main class="sb-container">

    {{-- BREAKING NEWS --}}
    <section class="sb-breaking" aria-label="ब्रेकिंग न्यूज़">
        <span class="sb-breaking-label">ब्रेकिंग न्यूज़</span>

        <div class="sb-breaking-track">
            @forelse ($breakingNews as $item)
                <a href="{{ route('news.show', $item->slug) }}">
                    {{ $item->title }}
                </a>
            @empty
                <span>अभी कोई ब्रेकिंग न्यूज़ नहीं है।</span>
            @endforelse
        </div>
    </section>

    {{-- MAIN SLIDER --}}
    <section class="sb-section" aria-label="मुख्य खबरें">
        <div class="sb-section-heading">
            <h1>आज की बड़ी खबरें</h1>
            <a class="sb-more" href="#latest-news">सभी खबरें ↓</a>
        </div>

        @if ($sliderNews->isNotEmpty())
            <div class="sb-slider" id="sbSlider">

                @foreach ($sliderNews as $item)
                    <article class="sb-slide {{ $loop->first ? 'sb-active' : '' }}">

                        <a class="sb-slide-link"
                           href="{{ route('news.show', $item->slug) }}">

                            @if ($item->featured_image)
                                <img
                                    class="sb-slide-image"
                                    src="{{ asset('storage/' . $item->featured_image) }}"
                                    alt="{{ $item->image_alt ?: $item->title }}"
                                    @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif
                                >
                            @else
                                <div class="sb-slide-placeholder">
                                    Samachar Bharti
                                </div>
                            @endif

                            <div class="sb-slide-caption">
                                @if ($item->category)
                                    <span class="sb-slide-category">
                                        {{ $item->category->name }}
                                    </span>
                                @endif

                                <h2>{{ $item->title }}</h2>

                                @if ($item->excerpt)
                                    <p>{{ \Illuminate\Support\Str::limit($item->excerpt, 150) }}</p>
                                @endif

                                <p>
                                    {{ $item->published_at->format('d M Y, h:i A') }}
                                </p>
                            </div>
                        </a>
                    </article>
                @endforeach

                @if ($sliderNews->count() > 1)
                    <div class="sb-slider-controls">
                        <button type="button" id="sbPrevious" aria-label="पिछली खबर">‹</button>
                        <button type="button" id="sbNext" aria-label="अगली खबर">›</button>
                    </div>
                @endif
            </div>

            @if ($sliderNews->count() > 1)
                <div class="sb-slider-dots" id="sbSliderDots">
                    @foreach ($sliderNews as $item)
                        <button
                            type="button"
                            class="sb-slider-dot {{ $loop->first ? 'sb-active' : '' }}"
                            data-slide="{{ $loop->index }}"
                            aria-label="खबर {{ $loop->iteration }}"
                        ></button>
                    @endforeach
                </div>
            @endif
        @else
            <div class="sb-empty">
                Admin panel से news publish karne par slider automatically भर जाएगा।
            </div>
        @endif
    </section>

    <!-- {{-- FUTURE AD SLOT --}}
    <div class="sb-ad-slot" aria-label="Advertisement space">
        <span>Advertisement Space<br>भविष्य में यहाँ AdSense या अन्य ad code लगाया जा सकता है।</span>
    </div> -->

    {{-- LATEST NEWS --}}
    <section class="sb-section" id="latest-news">
        <div class="sb-section-heading">
            <h2>ताज़ा खबरें</h2>
            <span class="sb-meta">नई से पुरानी खबरें</span>
        </div>

        @if ($latestNews->count())
            <div class="sb-news-grid">
                @foreach ($latestNews as $item)
                    <article class="sb-card">
                        <a href="{{ route('news.show', $item->slug) }}">
                            @if ($item->featured_image)
                                <img
                                    class="sb-image"
                                    src="{{ asset('storage/' . $item->featured_image) }}"
                                    alt="{{ $item->image_alt ?: $item->title }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="sb-image-placeholder">
                                    Samachar Bharti
                                </div>
                            @endif
                        </a>

                        <div class="sb-content">
                            @if ($item->category)
                                <a class="sb-category"
                                   href="{{ route('category.show', $item->category->slug) }}">
                                    {{ $item->category->name }}
                                </a>
                            @endif

                            <h2 class="sb-title">
                                <a href="{{ route('news.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>

                            @if ($item->excerpt)
                                <p class="sb-excerpt">
                                    {{ \Illuminate\Support\Str::limit($item->excerpt, 110) }}
                                </p>
                            @endif

                            <div class="sb-meta">
                                {{ $item->published_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="sb-pagination">
                {{ $latestNews->links() }}
            </div>
        @else
            <div class="sb-empty">अभी कोई खबर प्रकाशित नहीं हुई है।</div>
        @endif
    </section>

    {{-- CATEGORY WISE NEWS --}}
    <section class="sb-section" id="categories">
        <div class="sb-section-heading">
            <h2>कैटेगरी के अनुसार खबरें</h2>
        </div>

        @forelse ($homeCategories as $category)
            <section class="sb-section">

                <div class="sb-section-heading">
                    <h2>
                        <a href="{{ route('category.show', $category->slug) }}">
                            {{ $category->name }}
                        </a>
                    </h2>

                    <a class="sb-more"
                       href="{{ route('category.show', $category->slug) }}">
                        सभी खबरें →
                    </a>
                </div>

                @if ($category->news->isNotEmpty())
                    <div class="sb-category-grid">
                        @foreach ($category->news as $item)
                            <article class="sb-category-card">
                                <h3>
                                    <a href="{{ route('news.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h3>

                                @if ($item->excerpt)
                                    <p class="sb-excerpt">
                                        {{ \Illuminate\Support\Str::limit($item->excerpt, 95) }}
                                    </p>
                                @endif

                                <div class="sb-meta">
                                    {{ $item->published_at->format('d M Y') }}
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="sb-empty">
                        इस कैटेगरी में अभी कोई खबर नहीं है।
                    </div>
                @endif

            </section>
        @empty
            <div class="sb-empty">
                Admin panel में बनाई गई categories यहाँ दिखाई देंगी।
            </div>
        @endforelse
    </section>

    <!-- {{-- SECOND AD SLOT --}}
    <div class="sb-ad-slot" aria-label="Advertisement space">
        <span>Advertisement Space<br>यहाँ future में responsive ad unit लगाया जा सकता है।</span>
    </div> -->

</main>

@include('headfoot.footer')

{{-- MOBILE FIXED BOTTOM MENU --}}
<nav class="sb-mobile-nav" aria-label="मोबाइल नेविगेशन">

    <a href="#categories" class="sb-mobile-link">
        <span class="sb-mobile-icon" aria-hidden="true">▦</span>
        <span>कैटेगरी</span>
    </a>

    <a href="#latest-news" class="sb-mobile-link">
        <span class="sb-mobile-icon" aria-hidden="true">▤</span>
        <span>लेटेस्ट</span>
    </a>

    <a href="{{ route('home') }}" class="sb-mobile-link sb-center sb-current">
        <span class="sb-mobile-icon" aria-hidden="true">⌂</span>
        <span>होम</span>
    </a>

    <a href="#categories" class="sb-mobile-link">
        <span class="sb-mobile-icon" aria-hidden="true">☰</span>
        <span>सभी खबरें</span>
    </a>

    <a href="#top" class="sb-mobile-link">
        <span class="sb-mobile-icon" aria-hidden="true">↑</span>
        <span>ऊपर जाएँ</span>
    </a>

</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('sbSlider');

    if (!slider) return;

    const slides = Array.from(slider.querySelectorAll('.sb-slide'));
    const dots = Array.from(document.querySelectorAll('.sb-slider-dot'));
    const previous = document.getElementById('sbPrevious');
    const next = document.getElementById('sbNext');

    if (slides.length < 2) return;

    let current = 0;
    let timer = null;

    function showSlide(index) {
        current = (index + slides.length) % slides.length;

        slides.forEach(function (slide, i) {
            slide.classList.toggle('sb-active', i === current);
        });

        dots.forEach(function (dot, i) {
            dot.classList.toggle('sb-active', i === current);
        });
    }

    function startSlider() {
        stopSlider();

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            timer = setInterval(function () {
                showSlide(current + 1);
            }, 5000);
        }
    }

    function stopSlider() {
        if (timer) {
            clearInterval(timer);
            timer = null;
        }
    }

    if (previous) {
        previous.addEventListener('click', function () {
            showSlide(current - 1);
            startSlider();
        });
    }

    if (next) {
        next.addEventListener('click', function () {
            showSlide(current + 1);
            startSlider();
        });
    }

    dots.forEach(function (dot, index) {
        dot.addEventListener('click', function () {
            showSlide(index);
            startSlider();
        });
    });

    slider.addEventListener('mouseenter', stopSlider);
    slider.addEventListener('mouseleave', startSlider);

    slider.addEventListener('focusin', stopSlider);
    slider.addEventListener('focusout', startSlider);

    startSlider();
});
</script>

</body>
</html>
