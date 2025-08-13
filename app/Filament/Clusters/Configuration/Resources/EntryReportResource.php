<?php

namespace App\Filament\Clusters\Configuration\Resources;

use App\Filament\Clusters\Configuration;
use App\Filament\Clusters\Configuration\Resources\EntryReportResource\Pages;
use App\Filament\Clusters\Configuration\Resources\EntryReportResource\RelationManagers;
use App\Models\Historical;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\{Grid, Select, TextInput, Repeater, Section, Group, Placeholder, DatePicker, Toggle, TimePicker, Radio};
use Filament\Tables\Columns\ActionsColumn;
use Filament\Tables\Actions\Action;

class EntryReportResource extends Resource
{
    protected static ?string $model = Historical::class;
    protected static ?string $navigationLabel = 'Submission';
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $cluster = Configuration::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
             ->columns([
                TextColumn::make('created_at')
                ->label('Date of Submission')
                ->date()
                ->sortable()
                ->toggleable(),
                TextColumn::make('vessel_name')
                ->label('Vessel Name')
                ->searchable()
                ->toggleable(),
                TextColumn::make('mmsi')
                ->label('MMSI')
                ->searchable()
                ->toggleable(),
                TextColumn::make('date_arrival')
                ->label('Date of Arrival')
                ->date('d/m/Y')
                ->sortable()
                ->toggleable(),
                TextColumn::make('entry_sector')
                ->label('Entry Sector')
                ->toggleable(),
                Textcolumn::make('reportingMethod.name')
                ->label('Reporting Method')
                ->toggleable(),
                TextColumn::make('status')->label('Status')->badge()
                ->color(fn (string $state) => match ($state) {
                    'Verified' => 'success',
                    'Rejected' => 'danger',
                    'Pending' => 'warning',
                    default => 'gray',
                }),
             ])
             ->headerActions([
                Action::make('exportCsv')
                ->label('Download')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary'),
             ])
             ->actions([
            Action::make('verify')
                ->label('Verify')
                //->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn ($record) => $record->status !== 'Verified')
                ->action(fn ($record) => $record->update(['status' => 'Verified'])),

            Action::make('update')
                ->label('Update')
                //->icon('heroicon-o-pencil')
                ->form([
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'Pending' => 'Pending',
                            'Verified' => 'Verified',
                            'Rejected' => 'Rejected',
                        ])
                        ->required(),
                    TextInput::make('comments')->label('Comments'),
                ])
                ->action(fn (array $data, $record) => $record->update($data)),

            Action::make('report')
                ->label('Report')
                //->icon('heroicon-o-document-text'),
                //->url(fn ($record) => route('report.show', $record), true),
        ])
             ->filters([
            Tables\Filters\Filter::make('date_arrival')
                ->form([
                    DatePicker::make('date_arrival'),
                ])
                ->query(function ($query, array $data) {
                    return $query
                        ->when($data['date_arrival'], fn($q, $date) => $q->whereDate('date_arrival', '>=', $date));
                }),

            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'Pending' => 'Pending',
                    'Verified' => 'Verified',
                    'Rejected' => 'Rejected',
                ]),

            Tables\Filters\SelectFilter::make('entry_sector')
                ->options(Historical::query()->pluck('entry_sector', 'entry_sector')->unique()),

            ])
            ->heading('Table')
            ->searchPlaceholder('Search')
            ->defaultSort('created_at', 'desc')
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->filtersTriggerAction(function () {
            return Tables\Actions\Action::make('filter')
            //->label('Filter')
            ->icon('heroicon-m-funnel');
            });
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
            'index' => Pages\ListEntryReports::route('/'),
            'create' => Pages\CreateEntryReport::route('/create'),
            'edit' => Pages\EditEntryReport::route('/{record}/edit'),
        ];
    }
}
