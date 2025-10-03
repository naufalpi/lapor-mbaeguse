<?php

namespace App\Filament\Resources\AduanResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RiwayatAduan;
use App\Mail\AduanTanggapanMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AduanTanggapanAdminMail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;


class TanggapansRelationManager extends RelationManager
{
    protected static string $relationship = 'tanggapans';



    public static function getModelLabel(): string
    {
        return 'Tanggapan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tanggapan-Tanggapan';
    }

    public static function getCreateButtonLabel(): string
    {
        return 'Tambah Tanggapan';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('isi_tanggapan')
                    ->label('Isi Tanggapan')
                    ->placeholder('Tulis tanggapan Anda di sini...')
                    ->rows(5)
                    ->autosize()
                    ->maxLength(1000)
                    ->helperText('Maksimal 1000 karakter.')
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'text-sm']),

                Forms\Components\FileUpload::make('lampiran')
                    ->label('Lampiran (Opsional)')
                    ->multiple()
                    ->maxFiles(3)
                    ->directory('lampiran-tanggapan')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/*',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->helperText('Maksimal 3 file. Format: PDF, Word, atau Gambar.')
       
                    ->panelLayout('grid')
                    ->imageEditor()
                    ->openable(),


                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => Auth::id())
                    ->dehydrated(),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('isi_tanggapan')
            ->emptyStateHeading('Belum ada tanggapan yang diberikan')
            ->emptyStateDescription('')
            ->columns([
                Tables\Columns\TextColumn::make('isi_tanggapan')
                    ->label('Isi Tanggapan')
                    ->limit(50),

                Tables\Columns\ViewColumn::make('lampiran')
                    ->label('Lampiran')
                    ->view('filament.components.lampiran-tanggapan'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function ($record, $livewire) {
                        $user = Auth::user();
                        $opdNama = $user->opd->nama ?? 'Pemerintah Kabupaten Banjarnegara';

                        // Buat riwayat aduan
                        \App\Models\RiwayatAduan::create([
                            'aduan_id'   => $livewire->getOwnerRecord()->id,
                            'user_id'    => $user->id,
                            'status'     => 'Ditanggapi',
                            'keterangan' => 'Aduan ditanggapi oleh ' . $opdNama,
                        ]);

                        // Kirim email ke masyarakat
                        $aduan = $livewire->getOwnerRecord();
                        if (!empty($aduan->email)) {
                            Mail::to($aduan->email)->send(
                                new \App\Mail\AduanTanggapanMail($aduan, $record)
                            );
                        }

                        // Kirim email ke semua superadmin kecuali yang menanggapi
                        $superadmins = \App\Models\User::where('role', 'superadmin')
                            ->where('id', '!=', $record->user_id) // exclude superadmin yang menanggapi
                            ->pluck('email');

                        if ($superadmins->isNotEmpty()) {
                            Mail::to($superadmins)->send(
                                new \App\Mail\AduanTanggapanAdminMail($aduan, $record)
                            );
                        }

                    }),
            ])


            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

   
}
