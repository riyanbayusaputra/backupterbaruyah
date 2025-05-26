<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\ProductOptionItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductOptionItemResource\Pages;
use App\Filament\Resources\ProductOptionItemResource\RelationManagers;
class ProductOptionItemResource extends Resource
{
    protected static ?string $model = ProductOptionItem::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Product Custom Option item';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Isi Menu'),
                Forms\Components\Select::make('product_option_id')
                    ->relationship('product_option', 'name')
                    ->required()
                    ->label('Kategori'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                 
                    ->disk('public') 
                    ->label('Gambar'),
             
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Isi Menu'),
                Tables\Columns\TextColumn::make('product_option.name')
                    ->sortable()
                    ->searchable()
                    ->label('Kategori Menu'),
            ])
            ->filters([
                //
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make()->label('Tambah Isi Menu'),
            // ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah Isi Menu'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Pilihan Terpilih'),
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
            'index' => Pages\ListProductOptionItems::route('/'),
            'create' => Pages\CreateProductOptionItem::route('/create'),
            'edit' => Pages\EditProductOptionItem::route('/{record}/edit'),
        ];
    }
}