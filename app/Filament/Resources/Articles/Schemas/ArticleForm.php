<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('A. Basic news details')->columns(2)->schema([
                TextInput::make('headline')
                    ->label('News heading (H1)')
                    ->required()->maxLength(255)->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state, string $operation) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state ?? '', '-', 'hi'));
                        }
                    }),

                TextInput::make('slug')
                    ->label('URL slug')
                    ->required()->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique and used in the URL. Check it after typing a Hindi heading; edit it by hand if needed.')
                    ->columnSpanFull(),

                Textarea::make('summary')
                    ->label('Short description / excerpt')
                    ->rows(3)->columnSpanFull(),

                RichEditor::make('body')
                    ->label('Full news content')
                    ->required()->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('articles/attachments'),

                Select::make('author_id')
                    ->label('Author (admin user)')
                    ->relationship('author', 'name')
                    ->default(fn () => auth()->id())
                    ->required(),

                TextInput::make('reporter_name')
                    ->label('Reporter name')
                    ->helperText('Optional. Use if the reporter is not an admin user.')
                    ->maxLength(255),
            ]),

            Section::make('B. Category & location')->columns(3)->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name', fn ($query) => $query->whereNull('parent_id')->where('is_active', true))
                    ->required()->searchable()->preload()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('subcategory_id', null)),

                Select::make('subcategory_id')
                    ->label('Subcategory')
                    ->relationship('subcategory', 'name', fn ($query, Get $get) => $query
                        ->where('parent_id', $get('category_id') ?: 0)
                        ->where('is_active', true))
                    ->searchable()->preload()
                    ->disabled(fn (Get $get) => ! $get('category_id'))
                    ->helperText('Shows only the subcategories of the selected category.'),

                Select::make('location_id')
                    ->label('Location')
                    ->relationship('location', 'name', fn ($query) => $query->where('is_active', true))
                    ->searchable()->preload(),
            ]),

            Section::make('C. SEO details')->columns(2)->collapsible()->schema([
                TextInput::make('meta_title')
                    ->maxLength(70)->live(debounce: 500)
                    ->helperText(fn (?string $state) => mb_strlen($state ?? '') . '/60 characters recommended')
                    ->columnSpanFull(),

                Textarea::make('meta_description')
                    ->rows(3)->maxLength(320)->live(debounce: 500)
                    ->helperText(fn (?string $state) => mb_strlen($state ?? '') . '/160 characters recommended')
                    ->columnSpanFull(),

                TextInput::make('focus_keyword')
                    ->helperText('Optional editorial guidance. It does not change search rankings by itself.'),

                TextInput::make('canonical_url')
                    ->url()->maxLength(255)
                    ->helperText('Optional. If left empty, the article URL is used automatically.'),

                TextInput::make('og_title')->label('Social share title')->maxLength(255),
                Textarea::make('og_description')->label('Social share description')->rows(2)->maxLength(320),

                FileUpload::make('og_image')
                    ->label('Social share image')
                    ->image()->disk('public')->visibility('public')
                    ->directory('articles/og')
                    ->columnSpanFull(),
            ]),

            Section::make('D. Media')->columns(2)->schema([
                FileUpload::make('thumbnail')
                    ->label('Featured image')
                    ->image()->imageEditor()
                    ->disk('public')->visibility('public')
                    ->directory('articles/featured'),

                TextInput::make('image_alt')
                    ->label('Image alt text')
                    ->maxLength(255)
                    ->helperText('Describe the image. This helps SEO and accessibility.'),

                FileUpload::make('gallery')
                    ->label('Additional article images')
                    ->image()->multiple()->reorderable()
                    ->disk('public')->visibility('public')
                    ->directory('articles/gallery')
                    ->columnSpanFull(),

                TextInput::make('youtube_url')->label('YouTube video URL')->url()->maxLength(255),
                TextInput::make('facebook_url')->label('Facebook post / video URL')->url()->maxLength(255),
            ]),

            Section::make('E. Publishing & priority')->columns(2)->schema([
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                    ])
                    ->default('draft')->required()->live(),

                DateTimePicker::make('published_at')
                    ->label('Publish date & time')
                    ->seconds(false)
                    ->default(fn () => now())
                    ->required(fn (Get $get) => $get('status') !== 'draft')
                    ->helperText('For "Scheduled", set a future time. The article goes live automatically.'),

                Toggle::make('is_pinned')->label('Pin to top'),

                TextInput::make('pin_priority')
                    ->label('Pin priority / display order')
                    ->numeric()->default(0)
                    ->helperText('Lower number shows first among pinned articles.'),

                Select::make('homepage_section')
                    ->label('Homepage section')
                    ->options(Article::HOMEPAGE_SECTIONS)
                    ->placeholder('Not on homepage sections'),
            ]),
        ]);
    }
}