<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    @foreach ($categories as $category)
        <url>
            <loc>{{ route('category.show', ['category' => $category->slug]) }}</loc>
            <lastmod>{{ $category->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
        </url>
    @endforeach

    @foreach ($subcategories as $subcategory)
        @if ($subcategory->category && $subcategory->category->is_active)
            <url>
                <loc>{{ route('subcategory.show', [
                    'category' => $subcategory->category->slug,
                    'subcategory' => $subcategory->slug
                ]) }}</loc>
                <lastmod>{{ $subcategory->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
            </url>
        @endif
    @endforeach

    @foreach ($news as $item)
        <url>
            <loc>{{ route('news.show', ['news' => $item->slug]) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() ?? $item->published_at->toAtomString() }}</lastmod>
        </url>
    @endforeach

</urlset>