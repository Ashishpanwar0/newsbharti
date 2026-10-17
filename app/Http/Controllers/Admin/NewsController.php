<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['category', 'subcategory'])
            ->orderByDesc('is_pinned')
            ->orderBy('pin_order')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $item = new News();

        $categories = Category::with('subcategories')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.news.form', compact('item', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateNews($request);

        $data['slug'] = $this->uniqueSlug(
            $data['slug'] ?: $data['title']
        );

        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['pin_order'] = $data['is_pinned']
            ? (int) ($data['pin_order'] ?? 0)
            : 0;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('news', 'public');
        }

        News::create($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News successfully added.');
    }

    public function edit(News $news)
    {
        $item = $news;

        $categories = Category::with('subcategories')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.news.form', compact('item', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $data = $this->validateNews($request, $news);

        $data['slug'] = $this->uniqueSlug(
            $data['slug'] ?: $data['title'],
            $news->id
        );

        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['pin_order'] = $data['is_pinned']
            ? (int) ($data['pin_order'] ?? 0)
            : 0;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = $news->published_at ?? now();
        }

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')
                ->store('news', 'public');
        }

        $news->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News successfully updated.');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News successfully deleted.');
    }

    private function validateNews(Request $request, ?News $news = null): array
    {
        return $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],

            'subcategory_id' => [
                'nullable',
                'integer',
                Rule::exists('subcategories', 'id')
                    ->where('category_id', $request->input('category_id')),
            ],

            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('news', 'slug')->ignore($news?->id),
            ],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],

            'featured_image' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120',
            ],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url' => ['nullable', 'url', 'max:2048'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'focus_keyword' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:2048'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'url', 'max:2048'],

            'status' => ['required', Rule::in(['draft', 'published', 'scheduled'])],
            'published_at' => ['nullable', 'date'],
            'is_pinned' => ['nullable', 'boolean'],
            'pin_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'news';
        $slug = $base;
        $counter = 2;

        while (
            News::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
