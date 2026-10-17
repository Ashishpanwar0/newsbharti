<?php

namespace App\Filament\Resources\Locations\Schemas;

use App\Models\Location;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'state' => 'State',
                        'district' => 'District',
                        'local' => 'Local (city / town / area)',
                    ])
                    ->default('state')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('parent_id', null)),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state, string $operation) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state ?? ''));
                        }
                    }),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Used in the URL. For Hindi names, type an English slug (e.g. dehradun). If two places share a name, add the state, e.g. aurangabad-bihar.'),

                Select::make('parent_id')
                    ->label('Belongs to')
                    ->relationship(
                        name: 'parent',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query, Get $get, ?Location $record) {
                            $parentType = match ($get('type')) {
                                'district' => 'state',
                                'local' => 'district',
                                default => null,
                            };

                            $parentType
                                ? $query->where('type', $parentType)
                                : $query->whereRaw('1 = 0');

                            if ($record) {
                                $query->whereKeyNot($record->getKey());
                            }

                            return $query;
                        },
                    )
                    ->searchable()
                    ->preload()
                    ->visible(fn (Get $get) => $get('type') !== 'state')
                    ->required(fn (Get $get) => $get('type') !== 'state')
                    ->helperText('A district belongs to a state. A local area belongs to a district.'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}