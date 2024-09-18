<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use Directory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationLabel = 'Посты';

    protected static ?string $modelLabel = 'Пост';

    protected static ?string $pluralModelLabel = 'Посты';

    protected static ?string $navigationGroup = 'Блог';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('URI')
                    ->required()
                    ->maxLength(255),
                Forms\Components\CheckboxList::make('categories')
                    ->relationship('categories', 'name'),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->required(),
                Forms\Components\Textarea::make('short_text')
                    ->required()
                    ->columnSpanFull(),
                TinyEditor::make('detail_text')
                    ->fileAttachmentsDirectory('blog' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('short_image')
                    ->directory('blog' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m'))
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('detail_image')
                    ->directory('blog' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m'))
                    ->image()
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('short_image')->label(''),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Статус')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
