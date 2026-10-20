<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO variables: meta tags se pehle define hone chahiye --}}
    @php
        $pageName = isset($subcategory) && $subcategory
            ? $subcategory->name
            : $category->name;

        $pageTitle = $pageName . ' News | Samachar Bharti';

        $pageDescription = \Illuminate\Support\Str::limit(
            $pageName . ' ki latest news, breaking news aur taaza khabrein padhein Samachar Bharti par.',
            160,
            ''
        );

        $canonicalUrl = isset($subcategory) && $subcategory
            ? route('subcategory.show', [
                'category' => $category->slug,
                'subcategory' => $subcategory->slug,
            ])
            : route('category.show', [
                'category' => $category->slug,
            ]);

        $categoryImage = asset('images/samachar-bharti-logo.webp');
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Samachar Bharti">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $categoryImage }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $categoryImage }}">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --news-red: #c90024;
            --news-text: #171717;
            --news-muted: #777;
            --news-border: #e7e7e7;
            --news-bg: #f5f6f8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--news-bg);
            color: var(--news-text);
            font-family: Arial, "Noto Sans Devanagari", sans-serif;
        }

        a { text-decoration: none; }

        .page-layout { max-width: 1200px; }

        .news-panel,
        .breaking-panel {
            background: #fff;
            border: 1px solid var(--news-border);
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .045);
        }

        .news-panel { padding: 24px 30px; }

        .section-heading {
            font-size: 25px;
            font-weight: 800;
            border-left: 5px solid var(--news-red);
            padding-left: 13px;
            margin-bottom: 7px;
            color: var(--news-text);
        }

        .section-description {
            color: var(--news-muted);
            font-size: 14px;
            margin-bottom: 23px;
        }

        .news-item {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 24px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .news-item:first-child { padding-top: 5px; }
        .news-item:last-child { border-bottom: 0; }

        .news-image-link {
            display: block;
            overflow: hidden;
            border-radius: 13px;
            background: #eee;
            aspect-ratio: 1.48 / 1;
        }

        .news-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .25s ease;
        }

        .news-image-link:hover .news-image {
            transform: scale(1.035);
        }

        .news-image-placeholder {
            width: 100%;
            height: 100%;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            color: #777;
            font-size: 14px;
        }

        .news-category {
            font-size: 12px;
            font-weight: 700;
            color: var(--news-red);
            margin-bottom: 8px;
        }

        .news-title {
            font-size: 22px;
            font-weight: 800;
            line-height: 1.4;
            margin-bottom: 10px;
            overflow-wrap: anywhere;
        }

        .news-title a { color: var(--news-text); }
        .news-title a:hover { color: var(--news-red); }

        .news-excerpt {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin-bottom: 12px;
        }

        .news-meta {
            font-size: 12px;
            color: var(--news-muted);
        }

        .breaking-label {
            display: inline-block;
            color: #fff;
            background: var(--news-red);
            border-radius: 4px;
            padding: 4px 7px;
            font-size: 10px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        /* Breaking News sidebar */
        .breaking-panel {
            padding: 22px 22px 25px;
            position: sticky;
            top: 15px;
        }

        .breaking-heading {
            font-size: 21px;
            font-weight: 800;
            border-bottom: 2px solid var(--news-red);
            padding-bottom: 14px;
            margin-bottom: 17px;
            color: var(--news-text);
        }

        .breaking-list {
            position: relative;
            padding-left: 19px;
        }

        .breaking-list::before {
            content: "";
            position: absolute;
            left: 5px;
            top: 7px;
            bottom: 9px;
            width: 2px;
            background: #e7e7e7;
        }

        .breaking-item {
            position: relative;
            padding: 0 0 20px 4px;
        }

        .breaking-item:last-child { padding-bottom: 0; }

        .breaking-item::before {
            content: "";
            position: absolute;
            left: -19px;
            top: 5px;
            width: 10px;
            height: 10px;
            background: #e1e1e1;
            border: 2px solid #fff;
            border-radius: 50%;
            box-shadow: 0 0 0 1px #eee;
        }

        .breaking-time {
            font-size: 11px;
            color: #777;
            margin-bottom: 5px;
        }

        .breaking-title {
            font-size: 16px;
            font-weight: 800;
            line-height: 1.45;
            margin: 0;
            overflow-wrap: anywhere;
        }

        .breaking-title a { color: #171717; }
        .breaking-title a:hover { color: var(--news-red); }

        .empty-state {
            text-align: center;
            padding: 45px 15px;
            color: #666;
        }

        /* Pagination */
        .pagination {
            gap: 7px;
            flex-wrap: wrap;
            justify-content: center;
            margin: 28px 0 5px;
        }

        .pagination .page-link {
            border: 1px solid #e2e2e2;
            border-radius: 50% !important;
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #222;
            background: #fff;
            font-size: 13px;
            padding: 0 11px;
            box-shadow: none;
        }

        .pagination .page-item.active .page-link {
            background: #f6ae00;
            border-color: #f6ae00;
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            color: #aaa;
            background: #fff;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .news-panel { padding: 22px; }
            .breaking-panel { position: static; }
            .news-title { font-size: 19px; }
            .news-item { gap: 17px; }
        }

        /* Mobile */
        @media (max-width: 767.98px) {
            .page-layout {
                padding-left: 12px;
                padding-right: 12px;
            }

            .news-panel {
                padding: 17px 14px;
                border-radius: 12px;
            }

            .section-heading { font-size: 22px; }
            .section-description { margin-bottom: 17px; }

            .news-item {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
                padding: 17px 0;
            }

            .news-image-link { aspect-ratio: 1.65 / 1; }

            .news-title {
                font-size: 19px;
                line-height: 1.45;
                margin-bottom: 8px;
            }

            .news-excerpt {
                font-size: 14px;
                line-height: 1.6;
            }

            .breaking-sidebar { display: none !important; }

            .pagination { gap: 5px; }

            .pagination .page-link {
                min-width: 35px;
                height: 35px;
                font-size: 12px;
                padding: 0 9px;
            }
        }
    </style>

    {{-- Breadcrumb structured data --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_values(array_filter([
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $category->name,
                'item' => route('category.show', [
                    'category' => $category->slug,
                ]),
            ],
            isset($subcategory) && $subcategory ? [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $subcategory->name,
                'item' => $canonicalUrl,
            ] : null,
        ])),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
    </script>
</head>

<body id="top">

@include('headfoot.header')

<main class="container page-layout py-4">
    <div class="row g-4">

        {{-- Main category/subcategory news --}}
        <div class="col-12 col-lg-8">
            <section class="news-panel">

                <h1 class="section-heading">
                    {{ $pageName }} News
                </h1>

                <p class="section-description">
                    {{ $pageName }} ki latest khabrein aur updates
                </p>

                @forelse ($news as $item)
                    <article class="news-item">

                        {{-- News image --}}
                        <div>
                            <a
                                class="news-image-link"
                                href="{{ route('news.show', ['news' => $item->slug]) }}"
                                aria-label="{{ $item->title }}"
                            >
                                @if ($item->featured_image)
                                    <img
                                        src="{{ asset('storage/' . $item->featured_image) }}"
                                        alt="{{ $item->image_alt ?: $item->title }}"
                                        class="news-image"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="news-image-placeholder">
                                        Samachar Bharti
                                    </div>
                                @endif
                            </a>
                        </div>

                        {{-- News content --}}
                        <div>
                            @if ($item->is_pinned)
                                <span class="breaking-label">
                                    BREAKING NEWS
                                </span>
                            @endif

                            <div class="news-category">
                                {{ $item->category?->name }}

                                @if ($item->subcategory)
                                    / {{ $item->subcategory->name }}
                                @endif
                            </div>

                            <h2 class="news-title">
                                <a href="{{ route('news.show', ['news' => $item->slug]) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>

                            @if ($item->excerpt)
                                <p class="news-excerpt">
                                    {{ \Illuminate\Support\Str::limit($item->excerpt, 180) }}
                                </p>
                            @endif

                            <div class="news-meta">
                                @if ($item->author_name)
                                    <span>By {{ $item->author_name }}</span>
                                    <span> · </span>
                                @endif

                                <time datetime="{{ $item->published_at?->toIso8601String() }}">
                                    {{ $item->published_at?->diffForHumans() }}
                                </time>
                            </div>
                        </div>

                    </article>
                @empty
                    <div class="empty-state">
                        <h2 class="h5">Abhi koi news available nahi hai</h2>
                        <p class="mb-0">
                            Is category mein news publish hone par yahan dikhai degi.
                        </p>
                    </div>
                @endforelse

                {{-- Numbered pagination --}}
                @if ($news->hasPages())
                    <nav aria-label="Category news pages">
                        {{ $news->onEachSide(2)->links('pagination::bootstrap-5') }}
                    </nav>
                @endif

            </section>
        </div>

        {{-- Desktop-only Breaking News sidebar --}}
        <aside class="col-lg-4 breaking-sidebar">
            <section class="breaking-panel">

                <h2 class="breaking-heading">
                    <span style="color:#c90024;">●</span>
                    Breaking News
                </h2>

                <div class="breaking-list">
                    @forelse ($breakingNews as $breaking)
                        <article class="breaking-item">

                            <div class="breaking-time">
                                {{ $breaking->published_at?->diffForHumans() }}
                            </div>

                            <h3 class="breaking-title">
                                <a href="{{ route('news.show', ['news' => $breaking->slug]) }}">
                                    {{ $breaking->title }}
                                </a>
                            </h3>

                        </article>
                    @empty
                        <p class="text-muted small">
                            Abhi koi breaking news nahi hai.
                        </p>
                    @endforelse
                </div>

            </section>
        </aside>

    </div>
</main>

@include('headfoot.footer')

</body>
</html>