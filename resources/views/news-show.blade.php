
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $seoTitle = trim($news->meta_title ?: $news->title);

        $rawDescription = $news->meta_description
            ?: $news->excerpt
            ?: $news->content;

        $seoDescription = \Illuminate\Support\Str::limit(
            trim(strip_tags(html_entity_decode($rawDescription ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8'))),
            160,
            ''
        );

        $canonicalUrl = $news->canonical_url ?: route('news.show', [
            'news' => $news->slug
        ]);

        $seoImage = $news->featured_image
            ? asset('storage/' . $news->featured_image)
            : asset('images/samachar-bharti-logo.webp');

        $publisherLogo = asset('images/samachar-bharti-logo.webp');

        // News content: HTML tags ko plain text mein convert karein
        $contentText = html_entity_decode(
            $news->content ?? '',
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $contentText = preg_replace(
            '/<\/p\s*>|<br\s*\/?>|<\/div\s*>|<\/h[1-6]\s*>|<\/li\s*>/i',
            "\n",
            $contentText
        );

        $contentText = strip_tags($contentText);
    @endphp

    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Samachar Bharti">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:alt" content="{{ $news->image_alt ?: $news->title }}">
    <meta property="article:published_time"
          content="{{ $news->published_at?->toIso8601String() }}">
    <meta property="article:modified_time"
          content="{{ ($news->updated_at ?? $news->published_at)?->toIso8601String() }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f5f8;
            color: #202124;
            font-family: Arial, "Noto Sans Devanagari", sans-serif;
            line-height: 1.8;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .article-container {
            max-width: 1240px;
            margin: 25px auto;
            padding: 0 16px;
        }

        /* Article and sidebar */
        .article-layout {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(260px, 1fr);
            gap: 22px;
            align-items: stretch;
        }

        .article-main,
        .article-related,
        .latest-section {
            min-width: 0;
            padding: 22px;
            background: #fff;
            border: 1px solid #e0e3e8;
            border-radius: 9px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .035);
        }

        .article-category {
            color: #c90018;
            font-weight: 800;
            font-size: 13px;
        }

        .article-main h1 {
            margin: 10px 0;
            font-size: 32px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .article-meta {
            margin-bottom: 20px;
            color: #6b7280;
            font-size: 13px;
        }

        .article-image {
            display: block;
            width: 100%;
            max-height: 520px;
            object-fit: contain;
            margin: 18px 0;
            background: #eee;
        }

        .article-excerpt {
            color: #454b54;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.7;
        }

        .article-content {
            font-size: 17px;
            line-height: 1.9;
            overflow-wrap: anywhere;
            white-space: normal;
        }

        .article-content p {
            margin-bottom: 16px;
        }

        /* Breaking news sidebar */
        .article-related {
            position: sticky;
            top: 15px;
            align-self: start;
        }

        .article-related h2 {
            margin: 0 0 15px;
            font-size: 21px;
            font-weight: 800;
            border-bottom: 3px solid #c90018;
            padding-bottom: 12px;
        }

        .breaking-item {
            padding: 13px 0;
            border-bottom: 1px solid #eee;
        }

        .breaking-item:last-child {
            border-bottom: 0;
        }

        .breaking-time {
            color: #777;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .breaking-title {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.5;
        }

        .breaking-title a:hover {
            color: #c90018;
        }

        /* Latest news section below article */
        .latest-section {
            margin-top: 28px;
        }

        .latest-heading {
            margin: 0 0 20px;
            padding-bottom: 12px;
            border-bottom: 3px solid #c90018;
            font-size: 25px;
            font-weight: 800;
        }

        .latest-news-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
        }

        .latest-news-card {
            min-width: 0;
            overflow: hidden;
            background: #fff;
            border: 1px solid #dfe3e9;
            border-radius: 7px;
            transition: box-shadow .2s ease;
        }

        .latest-news-card:hover {
            box-shadow: 0 5px 16px rgba(0, 0, 0, .08);
        }

        .latest-image-link {
            display: block;
            background: #e5e9ef;
        }

        .latest-news-card img,
        .latest-image-placeholder {
            display: flex;
            width: 100%;
            height: 180px;
            object-fit: cover;
            align-items: center;
            justify-content: center;
            background: #e5e9ef;
            color: #777;
        }

        .latest-card-content {
            padding: 14px;
        }

        .latest-category {
            margin-bottom: 7px;
            color: #c90018;
            font-size: 12px;
            font-weight: 800;
        }

        .latest-news-card h3 {
            margin: 0 0 9px;
            font-size: 17px;
            line-height: 1.5;
            font-weight: 800;
        }

        .latest-news-card h3 a {
            color: #202124;
        }

        .latest-news-card h3 a:hover {
            color: #c90018;
        }

        .latest-news-card p {
            margin: 0 0 10px;
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .latest-news-card time {
            color: #777;
            font-size: 12px;
        }

        /* Tablet */
        @media (max-width: 950px) {
            .article-layout {
                grid-template-columns: minmax(0, 1fr) 260px;
                gap: 15px;
            }

            .article-main,
            .article-related,
            .latest-section {
                padding: 17px;
            }

            .latest-news-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .latest-news-card img,
            .latest-image-placeholder {
                height: 155px;
            }
        }

        /* Mobile */
        @media (max-width: 700px) {
            .article-container {
                margin: 15px auto;
                padding: 0 10px;
            }

            .article-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 0;
            }

            .article-main,
            .latest-section {
                padding: 14px;
                border-radius: 8px;
            }

            /* Sidebar hidden on mobile */
            .article-related {
                display: none !important;
            }

            .article-main h1 {
                font-size: 25px;
                line-height: 1.45;
            }

            .article-image {
                max-height: 360px;
            }

            .article-excerpt {
                font-size: 16px;
            }

            .article-content {
                font-size: 16px;
                line-height: 1.8;
            }

            .latest-section {
                margin-top: 18px;
            }

            .latest-heading {
                font-size: 21px;
            }

            .latest-news-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .latest-news-card img,
            .latest-image-placeholder {
                height: 125px;
            }

            .latest-card-content {
                padding: 10px;
            }

            .latest-news-card h3 {
                font-size: 14px;
                line-height: 1.5;
            }

            .latest-news-card p {
                font-size: 12px;
            }

            .latest-news-card time {
                font-size: 11px;
            }
        }

        @media (max-width: 380px) {
            .latest-news-grid {
                grid-template-columns: minmax(0, 1fr);
            }

            .latest-news-card img,
            .latest-image-placeholder {
                height: 190px;
            }
        }
    </style>

    {{-- NewsArticle schema --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'NewsArticle',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $canonicalUrl,
        ],
        'headline' => \Illuminate\Support\Str::limit($news->title, 110, ''),
        'description' => $seoDescription,
        'image' => [$seoImage],
        'datePublished' => $news->published_at?->toIso8601String(),
        'dateModified' => ($news->updated_at ?? $news->published_at)?->toIso8601String(),
        'author' => [
            '@type' => 'Organization',
            'name' => $news->author_name ?: 'Samachar Bharti News Desk',
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Samachar Bharti',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $publisherLogo,
            ],
        ],
        'inLanguage' => 'hi-IN',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
    </script>
</head>

<body>

@include('headfoot.header')

<main class="article-container">

    {{-- Article + Breaking News sidebar --}}
    <div class="article-layout">

        <article class="article-main">

            @if ($news->category)
                <a
                    class="article-category"
                    href="{{ route('category.show', ['category' => $news->category->slug]) }}"
                >
                    {{ $news->category->name }}
                </a>
            @endif

            <h1>{{ $news->title }}</h1>

            <div class="article-meta">
                {{ $news->author_name ?: 'समाचार भारती न्यूज़ डेस्क' }}
                ·
                <time datetime="{{ $news->published_at?->toIso8601String() }}">
                    {{ $news->published_at?->format('d M Y, h:i A') }}
                </time>
            </div>

            @if ($news->featured_image)
                <img
                    class="article-image"
                    src="{{ asset('storage/' . $news->featured_image) }}"
                    alt="{{ $news->image_alt ?: $news->title }}"
                    fetchpriority="high"
                >
            @endif

            @if ($news->excerpt)
                <p class="article-excerpt">{{ $news->excerpt }}</p>
            @endif

            <div class="article-content">
                {!! nl2br(e(trim($contentText))) !!}
            </div>

            @if ($news->subcategory && $news->category)
                <p>
                    संबंधित विषय:
                    <a href="{{ route('subcategory.show', [
                        'category' => $news->category->slug,
                        'subcategory' => $news->subcategory->slug
                    ]) }}">
                        {{ $news->subcategory->name }}
                    </a>
                </p>
            @endif

        </article>

        {{-- Breaking News sidebar: desktop only --}}
        <aside class="article-related">
            <h2>ब्रेकिंग न्यूज़</h2>

            @forelse ($breakingNews as $item)
                <article class="breaking-item">
                    <div class="breaking-time">
                        {{ $item->published_at?->diffForHumans() }}
                    </div>

                    <h3 class="breaking-title">
                        <a href="{{ route('news.show', ['news' => $item->slug]) }}">
                            {{ $item->title }}
                        </a>
                    </h3>
                </article>
            @empty
                <p>अभी कोई ब्रेकिंग न्यूज़ उपलब्ध नहीं है।</p>
            @endforelse
        </aside>

    </div>

    {{-- Latest news grid below the article --}}
    <section class="latest-section">
        <h2 class="latest-heading">ताज़ा खबरें</h2>

        <div class="latest-news-grid">
            @forelse ($latestNews as $item)
                <article class="latest-news-card">

                    <a
                        class="latest-image-link"
                        href="{{ route('news.show', ['news' => $item->slug]) }}"
                    >
                        @if ($item->featured_image)
                            <img
                                src="{{ asset('storage/' . $item->featured_image) }}"
                                alt="{{ $item->image_alt ?: $item->title }}"
                                loading="lazy"
                            >
                        @else
                            <div class="latest-image-placeholder">
                                समाचार भारती न्यूज़
                            </div>
                        @endif
                    </a>

                    <div class="latest-card-content">

                        <div class="latest-category">
                            {{ $item->category?->name ?? 'ताज़ा खबर' }}
                        </div>

                        <h3>
                            <a href="{{ route('news.show', ['news' => $item->slug]) }}">
                                {{ $item->title }}
                            </a>
                        </h3>

                        @if ($item->excerpt)
                            <p>
                                {{ \Illuminate\Support\Str::limit($item->excerpt, 110) }}
                            </p>
                        @endif

                        <time datetime="{{ $item->published_at?->toIso8601String() }}">
                            {{ $item->published_at?->format('d M Y, h:i A') }}
                        </time>

                    </div>
                </article>
            @empty
                <p>अभी दूसरी खबरें उपलब्ध नहीं हैं।</p>
            @endforelse
        </div>
    </section>

</main>

@include('headfoot.footer')

</body>
</html>
