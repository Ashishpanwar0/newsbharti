<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->disk('public')->square(),
                TextColumn::make('headline')->searchable()->limit(50)->wrap(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('location.name')->label('Location')->placeholder('—'),
                TextColumn::make('status')->badge()
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->color(fn (string $state) => match ($state) {
                        'published' => 'success',
                        'scheduled' => 'warning',
                        default => 'gray',
                    }),
                IconColumn::make('is_pinned')->label('Pinned')->boolean(),
                TextColumn::make('published_at')->dateTime('d M Y, h:i A')->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                    'scheduled' => 'Scheduled',
                ]),
                SelectFilter::make('category_id')->label('Category')->relationship('category', 'name'),
            ])
            ->defaultSort('published_at', 'desc')
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}