<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id()),

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Artikel')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->readOnly(),

                                RichEditor::make('content')
                                    ->label('Isi Artikel')
                                    ->toolbarButtons([
                                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                        ['h1','h2', 'h3', 'alignJustify','alignStart', 'alignCenter', 'alignEnd'],
                                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                        ['table', 'attachFiles'], 
                                        ['undo', 'redo'],
                                    ])
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Publikasi')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->image()
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('articles')
                                    ->required(),

                                Select::make('article_category_id')
                                    ->relationship('category', 'name')
                                    ->label('Kategori')
                                    ->required()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')->required(),
                                        Hidden::make('slug'),
                                    ]),

                                DatePicker::make('published_at')
                                    ->label('Tanggal Tayang')
                                    ->default(now()),

                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft (Disimpan)',
                                        'published' => 'Published (Tayang)',
                                    ])
                                    ->default('draft')
                                    ->required(),
                            ]),
                    ])->columnSpan(1),
            ])
            ->columns(3);
    }
}
