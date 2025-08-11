<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageResource\Pages;
use App\Filament\Resources\LandingPageResource\RelationManagers;
use App\Models\VhfEntry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\{Grid, Select, TextInput, Repeater, Section, Group, Placeholder, DatePicker, Toggle, TimePicker, Radio};
use Filament\Forms\Components\Wizard;

class LandingPageResource extends Resource
{
    protected static ?string $model = VhfEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                Wizard\Step::make('Ship Details')
                ->schema(
                    static::getShipDetailsFormSchema()
                ),
                Wizard\Step::make('Route Information')
                ->schema(
                    static::getRouteInformationFormSchema()
                ),
                Wizard\step::make('Cargo Information')
                ->schema(
                    static::getCargoInformationFormSchema()
                ),
                Wizard\Step::make('Confirmation & Submission')
                ->schema(static::getConfirmationSubmissionFormSchema()),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListLandingPages::route('/'),
            'create' => Pages\CreateLandingPage::route('/create'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }

    public static function getShipDetailsFormSchema(): array {
        return [
            Section::make('Ship Details')
                            ->schema([
                                TextInput::make('vessel_name')->label('Vessel Name')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('mmsi_number')
                                        ->label('MMSI Number')
                                        ->required()
                                        ->maxLength(50)
                                        ->columnSpan(6),
                                TextInput::make('call_sign')->label('Call Sign')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('imo_number')->label('IMO Number')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('draught')->label('Draught')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('air_draught')->label('Air Draught')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('total_person_onboard')->label('Total Person Onboard')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('flag')->label('Flag')->required()->maxLength(50)->columnSpan(6),
                            ]),
        ];

    }

    public static function getRouteInformationFormSchema(): array{ 

        return [
            Section::make('Route Information')
                            ->schema([
                                DatePicker::make('date_arrival')
                                ->label('Date Arrival')
                                ->native(false) 
                                ->displayFormat('Y-m-d')->columnSpan(6),
                                TimePicker::make('time_arrival')
                                ->label('Time Arrival')->columnSpan(6),
                                TextInput::make('entry_sector')->label('Entry Sector')->required()->maxLength(50)->columnSpan(6),
                                Radio::make('direction')->label('Direction')->required()
                                ->options([
                                    'eastbound' => 'Eastbound',
                                    'westbound' => 'Westbound',
                                ])
                                ->inline()
                                ->inlineLabel(false)
                                ->columnSpan(6),
                                TextInput::make('position')->label('Position')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('port_destination')->label('Port of Destination')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('speed')->label('Speed')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('course')->label('Course')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('vessel_type')->label('Vessel Type')->required()->maxLength(50)->columnSpan(6),
                            ]),
        ];
    }

    public static function getCargoInformationFormSchema(): array {
        return [
            Section::make('Cargo Information')
                            ->schema([
                                TextInput::make('imo_classes')->label('IMO Classes')->required()->maxLength(50)->columnSpan(6),
                                Radio::make('hazardous_cargo')->label('Hazardous Cargo')->required()->boolean()->inline()
                                ->inlineLabel(false)->columnSpan(6),
                                TextInput::make('quantity')->label('Quantity')->required()->maxLength(50)->columnSpan(6),
                                TextInput::make('description')->label('Description')->maxLength(50)->columnSpan(6),
                                TextInput::make('comments')->label('Defects, Deficiencies & Other Comments')->maxLength(50)->columnSpan(6),
                                TextInput::make('rule_10')->label('Rule 10 TSS and Rule 10 COLREG')->maxLength(50)->columnSpan(6),
                                TextInput::make('vessel_email')->label('Vessel e-mail')->maxLength(50)->columnSpan(6),
                                TextInput::make('internal_remark')->label('Internal Remark')->maxLength(50)->columnSpan(6),
                            ]),
        ];
    }

    public static function getConfirmationSubmissionFormSchema(): array {
        return [
            Section::make()
            ->schema([
                Section::make('Ship Details')
                ->schema([
                Placeholder::make('vessel_name_preview')
                ->label('Veesel Name')
                ->content(fn ($get) => $get('vessel_name')),
                Placeholder::make('mmsi_number_preview')
                ->label('MMSI Number')
                ->content(fn ($get) => $get('mmsi_number')),
                Placeholder::make('call_sign_preview')
                ->label('Call Sign')
                ->content(fn ($get) => $get('call_sign')),
                Placeholder::make('imo_number_preview')
                ->label('Imo Number')
                ->content(fn ($get) => $get('imo_number')),
                Placeholder::make('draught_preview')
                ->label('Draught')
                ->content(fn ($get) => $get('draught')),
                Placeholder::make('air_draught_preview')
                ->label('Air Draught')
                ->content(fn ($get) => $get('air_draught')),
                Placeholder::make('total_person_onboard_preview')
                ->label('Total Person Onboard')
                ->content(fn ($get) => $get('total_person_onboard')),
                Placeholder::make('flag_preview')
                ->label('Flag')
                ->content(fn ($get) => $get('flag')),
                ]),

                Section::make('Route Information')
                ->schema([
                Placeholder::make('date_arrival_preview')
                ->label('Date Arrival')
                ->content(fn ($get) => $get('date_arrival')),
                Placeholder::make('time_arrival_preview')
                ->label('Time Arrival')
                ->content(fn ($get) => $get('time_arrival')),
                Placeholder::make('entry_sector_preview')
                ->label('Entry Sector')
                ->content(fn ($get) => $get('entry_sector')),
                Placeholder::make('direction_preview')
                ->label('Direction')
                ->content(fn ($get) => $get('direction')),
                Placeholder::make('position_preview')
                ->label('Position')
                ->content(fn ($get) => $get('position')),
                Placeholder::make('port_destination_preview')
                ->label('Port of Destination')
                ->content(fn ($get) => $get('port_destination')),
                Placeholder::make('speed_preview')
                ->label('Speed')
                ->content(fn ($get) => $get('speed')),
                Placeholder::make('course_preview')
                ->label('Course')
                ->content(fn ($get) => $get('course')),
                Placeholder::make('vessel_type_preview')
                ->label('Vessel Type')
                ->content(fn ($get) => $get('vessel_type')),
                ]),

                Section::make('Cargo Information')
                ->schema([
                Placeholder::make('imo_classes_preview')
                ->label('IMO Classes')
                ->content(fn ($get) => $get('imo_classes')),
                Placeholder::make('hazardous_cargo_preview')
                ->label('Hazardous Cargo')
                ->content(fn ($get) => $get('hazardous_cargo')),
                Placeholder::make('cquantity_preview')
                ->label('Quantity')
                ->content(fn ($get) => $get('quantity')),
                Placeholder::make('description_preview')
                ->label('Description')
                ->content(fn ($get) => $get('description')),
                Placeholder::make('comments_preview')
                ->label('Defects, Deficiencies & Other Comments')
                ->content(fn ($get) => $get('comments')),
                Placeholder::make('rule_10_preview')
                ->label('Rule 10 TSS and Rule 10 COLREG')
                ->content(fn ($get) => $get('rule_10')),
                Placeholder::make('cvessel_email_preview')
                ->label('Vessel e-mail')
                ->content(fn ($get) => $get('vessel_email')),
                Placeholder::make('internal_remark_preview')
                ->label('Internal Remark')
                ->content(fn ($get) => $get('internal_remark')),
                ]),

                Section::make([
                    //upload file here
                ]),

            ]),
        ];
    }
}
