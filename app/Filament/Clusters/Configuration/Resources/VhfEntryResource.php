<?php

namespace App\Filament\Clusters\Configuration\Resources;

use App\Filament\Clusters\Configuration;
use App\Filament\Clusters\Configuration\Resources\VhfEntryResource\Pages;
use App\Filament\Clusters\Configuration\Resources\VhfEntryResource\RelationManagers;
use App\Models\VhfEntry;
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
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Tapp\FilamentCountryCodeField\Forms\Components\CountryCodeSelect;

class VhfEntryResource extends Resource
{
    protected static ?string $model = VhfEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Configuration::class;

    protected static ?string $navigationLabel = 'VHF Form';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 1;


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema(self::getVhfEntriesFormSchema());
    }


    public static function getVhfEntriesFormSchema(): array {

    return 
    [
        Section::make()
        ->schema([
            Grid::make()
                ->columns(12)
                ->schema([
                    Group::make([
                        Section::make()
                            ->schema([
                                Grid::make(12)->schema([
                                    TextInput::make('search_mmsi_number')
                                        ->label('MMSI Number')
                                        ////->required()
                                        ->maxLength(50)
                                        ->columnSpan(5)
                                        ->dehydrated(false),

                                    DatePicker::make('search_date_arrival')
                                        ->label('Date of Arrival')
                                        ////->required()
                                        ->native(false)
                                        ->displayFormat('Y-m-d')
                                        ->columnSpan(5)
                                        ->dehydrated(false),

                                    \Filament\Forms\Components\Actions::make([
                                        \Filament\Forms\Components\Actions\Action::make('search')
                                            ->label('Search')
                                            ->icon('heroicon-o-magnifying-glass')
                                            ->button()
                                            ->action(function (Get $get, Set $set) {
                                                $mmsiInput = trim((string) $get('search_mmsi_number'));

                                                if ($mmsiInput === '') {
                                                    Notification::make()
                                                        ->title('Please enter an MMSI number')
                                                        ->danger()
                                                        ->send();
                                                    return;
                                                }

                                                $row = DB::connection('pnav')->selectOne(
                                                    'SELECT mmsi, shipname, s.callsign, 
                                                    imoshipno, flagname, yardnumber, officialnumber,
                                                    portofregistry, l.length, deadweight, grosstonnage, nettonnage, breadthextreme,
                                                    l.depth, draught
                                                    FROM public.ais_static AS s
                                                    JOIN public.ais_lloyds AS l
                                                      ON s.mmsi = l.maritimemobileserviceidentitymmsinumber
                                                    WHERE mmsi = ? LIMIT 1',
                                                    [ $mmsiInput ]
                                                );

                                                if (!$row) {
                                                    Notification::make()
                                                        ->title('No vessel found for the provided MMSI')
                                                        ->danger()
                                                        ->send();
                                                    return;
                                                }

                                                // show result $row
                                                $summary = "MMSI: " . ($row->mmsi ?? '-') . "\n"
                                                    . "Ship: " . ($row->shipname ?? '-') . "\n"
                                                    . "Callsign: " . ($row->callsign ?? '-') . "\n"
                                                    . "IMO: " . ($row->imoshipno ?? '-') . "\n"
                                                    . "Flag: " . ($row->flagname ?? '-') . "\n"
                                                    . "Length: " . ($row->length ?? '-') . "\n"
                                                    . "Draught: " . ($row->draught ?? '-');

                                                // Log full row for deeper inspection
                                                logger()->info('PNAV ais_static row', (array) $row);

                                                // Notification::make()
                                                //     ->title('Search Result')
                                                //     ->body($summary)
                                                //     ->info()
                                                //     ->send();

                                                // Map PNAV fields to form fields
                                                $set('vessel_name', $row->shipname ?? null);
                                                $set('mmsi_number', isset($row->mmsi) ? (string) $row->mmsi : null);
                                                $set('call_sign', $row->callsign ?? null);
                                                $set('imo_number', isset($row->imoshipno) ? (string) $row->imoshipno : null);
                                                $set('flag', $row->flagname ?? null);
                                                $set('draught', isset($row->draught) ? number_format((float) $row->draught, 3) : null);

                                                Notification::make()
                                                    ->title('Vessel data loaded from PNAV')
                                                    ->success()
                                                    ->send();
                                            }),
                                    ])->columnSpan(2)
                                    ->verticalAlignment(VerticalAlignment::End),
                                ])
                            ])
                            ->persistCollapsed(),

                        Section::make('Ship Details')
                            ->schema([
                                Grid::make(12)
                                ->schema([
                                TextInput::make('vessel_name')->label('Vessel Name')
                                ->required()
                                ->maxLength(50)
                                ->columnSpan(6),
                                TextInput::make('mmsi_number')
                                        ->label('MMSI Number')
                                        ->required()
                                        ->maxLength(50)
                                        ->columnSpan(6),
                                TextInput::make('call_sign')->label('Call Sign')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('imo_number')->label('IMO Number')
                                //->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('draught')->label('Draught')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('air_draught')->label('Air Draught')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('total_person_onboard')->label('Total Person Onboard')//->required()
                                ->maxLength(50)->columnSpan(6),
                                CountryCodeSelect::make('flag')->label('Flag')//->required()
                                ->columnSpan(6),
                            ])
                ]),

                        
                        Section::make('Route Information')
                            ->schema([
                                Grid::make(12)
                                ->schema([
                                DatePicker::make('date_arrival')
                                    ->label('Date Arrival')
                                    //->required()
                                    ->native(false)
                                    ->displayFormat('Y-m-d')
                                    ->columnSpan(6),
                                TimePicker::make('time_arrival')
                                    ->label('Time Arrival')
                                    //->required()
                                    ->columnSpan(6),
                                Select::make('entry_sector')
                                ->label('Entry Sector')
                                ->options([
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ])
                                //->required()
                                //->maxLength(50)
                                ->columnSpan(6),
                                Radio::make('direction')
                                    ->label('Direction')
                                    ->required()
                                    ->options([
                                        1 => 'Eastbound',
                                        0 => 'Westbound',
                                    ])
                                ->default(0)
                                ->inline()
                                ->inlineLabel(false)
                                ->columnSpan(6),
                                TextInput::make('position')->label('Position')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('port_destination')->label('Port of Destination')
                                //->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('speed')->label('Speed')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('course')->label('Course')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('vessel_type')->label('Vessel Type')//->required()
                                ->maxLength(50)->columnSpan(6),
                            ])
                                ]),

                        
                        Section::make('Cargo Information')
                            ->schema([
                                Grid::make(12)
                                ->schema([
                                TextInput::make('imo_classes')->label('IMO Classes')//->required()
                                ->maxLength(50)->columnSpan(6),
                                Radio::make('hazardous_cargo')
                                ->label('Hazardous Cargo')
                                ->options([
                                        1 => 'Yes',
                                        0 => 'No',
                                ])
                                ->default(0)
                                ->inline()
                                ->inlineLabel(false)
                                ->columnSpan(6),
                                TextInput::make('quantity')->label('Quantity')//->required()
                                ->maxLength(50)->columnSpan(6),
                                TextInput::make('description')->label('Description')->maxLength(50)->columnSpan(6),
                                TextInput::make('comments')->label('Defects, Deficiencies & Other Comments')->maxLength(50)->columnSpan(6),
                                TextInput::make('rule_10')->label('Rule 10 TSS and Rule 10 COLREG')->maxLength(50)->columnSpan(6),
                                TextInput::make('vessel_email')->label('Vessel e-mail')->maxLength(50)->columnSpan(6),
                                TextInput::make('internal_remark')->label('Internal Remark')->maxLength(50)->columnSpan(6),
                                // TextInput::make('status_id')
                                // ->default('Pending')
                                // ->hidden()
                                // ->dehydrated(true),
                            ])
                ]),

                        
                    ])->columnSpan(8),
                    
                    Group::make([
                        Section::make('Status')
                            ->schema([
                                Placeholder::make('status_id')->label('Status')
                                // ->badge()
                                // ->color(fn(string $state): string => match ($state) {
                                //     'Pending' => 'warning',
                                //     'Unverified' => 'danger',
                                //     'Verified' => 'success',
                                //     default => 'warning',
                                // })
                                     ->content(function ($record) {
                                    if (!$record || !$record->status_id) {
                                        return 'Pending';
                                    }
                                    return $record->status?->name ?? 'Pending';
                                }),

                                Toggle::make('verify')
                                    ->label('Verify')
                                    ->inline(),

                                Placeholder::make('verify')->label('The status is still pending verification'),
                            ])
                    ])->columnSpan(4),
                ]),
            ]),
        ];
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             //
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CreateVhfEntry::route('/'),
            'create' => Pages\CreateVhfEntry::route('/create'),
            'edit' => Pages\EditVhfEntry::route('/{record}/edit'),
        ];
    }
}
