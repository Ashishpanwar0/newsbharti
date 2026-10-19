
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $news->meta_title ?: $news->title }} | समाचार भारती न्यूज़</title>

    <meta name="description" content="{{ $news->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($news->excerpt ?: $news->content), 155, '') }}">
    <meta name="robots" content="index,follow,max-image-preview:large">

    <link rel="canonical" href="{{ $news->canonical_url ?: route('news.show', $news->slug) }}">

    <meta property="og:type" content="article">
    <meta property="og:site_name" content="समाचार भारती न्यूज़">
    <meta property="og:title" content="{{ $news->og_title ?: $news->title }}">
    <meta property="og:description" content="{{ $news->og_description ?: ($news->meta_description ?: $news->excerpt) }}">
    <meta property="og:url" content="{{ route('news.show', $news->slug) }}">

    @if ($news->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $news->featured_image) }}">
    @endif

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f3f5f8;
            color: #202124;
            font-family: Arial, sans-serif;
            line-height: 1.8;
        }

        a { color: inherit; text-decoration: none; }

        .article-container {
            max-width: 1050px;
            margin: 25px auto;
            padding: 0 16px;
        }

        .article-layout {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(220px, 1fr);
            gap: 20px;
            align-items: start;
        }

        .article-main,
        .article-related {
            padding: 22px;
            background: #fff;
            border: 1px solid #e0e3e8;
            border-radius: 7px;
        }

        .article-category {
            color: #c90018;
            font-weight: bold;
            font-size: 13px;
        }

        h1 {
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
        }

        .article-content {
            font-size: 17px;
            overflow-wrap: anywhere;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
        }

        .article-related h2 {
            margin-top: 0;
            font-size: 20px;
            border-bottom: 3px solid #c90018;
            padding-bottom: 8px;
        }

        .related-item {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            font-weight: 600;
        }

        .related-item a:hover { color: #c90018; }

        @media (max-width: 750px) {
            .article-layout { grid-template-columns: 1fr; }
            .article-main, .article-related { padding: 15px; }
            h1 { font-size: 25px; }
            .article-content { font-size: 16px; }
        }
    </style>
</head>
<body>

@include('headfoot.header')

<main class="article-container">
    <div class="article-layout">

        <article class="article-main">

            @if ($news->category)
                <a class="article-category"
                   href="{{ route('category.show', $news->category->slug) }}">
                    {{ $news->category->name }}
                </a>
            @endif

            <h1>{{ $news->title }}</h1>

            <div class="article-meta">
                {{ $news->author_name ?: 'समाचार भारती न्यूज़ डेस्क' }}
                ·
                <time datetime="{{ $news->published_at->toIso8601String() }}">
                    {{ $news->published_at->format('d M Y, h:i A') }}
                </time>
            </div>

            @if ($news->featured_image)
                <img
                    class="article-image"
                    src="{{ asset('storage/' . $news->featured_image) }}"
                    alt="{{ $news->image_alt ?: $news->title }}"
                >
            @endif

            @if ($news->excerpt)
                <p class="article-excerpt">{{ $news->excerpt }}</p>
            @endif

            <div class="article-content">
                {!! nl2br(e($news->content)) !!}
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

        <aside class="article-related">
            <h2>संबंधित खबरें</h2>

            @forelse ($relatedNews as $item)
                <div class="related-item">
                    <a href="{{ route('news.show', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                </div>
            @empty
                <p>अभी संबंधित खबरें उपलब्ध नहीं हैं।</p>
            @endforelse
        </aside>

    </div>
</main>

@include('headfoot.footer')

</body>
</html>
    