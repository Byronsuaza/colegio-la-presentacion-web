<?php

namespace App\Filament\Resources\AjusteGenerals\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class AjusteGeneralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Fila 1: Contacto y Redes Sociales (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Contacto')
                            ->description('Información de contacto principal.')
                            ->compact()
                            ->schema([
                                TextInput::make('telefono')
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('direccion')
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Correo Electrónico General')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('email_pqrs')
                                    ->label('Correo para Notificaciones de PQRS')
                                    ->helperText('A este correo llegarán las solicitudes enviadas desde el formulario PQRS.')
                                    ->placeholder('calidad@colpresentacioneiva.edu.co')
                                    ->email()
                                    ->maxLength(255),
                            ])->columns(1),

                        Section::make('Redes Sociales')
                            ->description('Enlaces a las redes sociales del colegio.')
                            ->compact()
                            ->schema([
                                TextInput::make('facebook')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('instagram')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('whatsapp')
                                    ->url()
                                    ->maxLength(255),
                            ])->columns(1),
                    ])
                    ->columnSpanFull(),

                // ── Fila 2: Admisiones (ancho completo) ──
                Section::make('Admisiones (Página Principal)')
                    ->description('Textos globales de la campaña de admisiones, llamadas a la acción y pasos del proceso.')
                    ->compact()
                    ->schema([
                        TextInput::make('admisiones_anio')
                            ->required()
                            ->maxLength(10)
                            ->label('Año de admisiones'),
                        TextInput::make('admisiones_titulo')
                            ->maxLength(255)
                            ->label('Título'),
                        Textarea::make('admisiones_descripcion')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Descripción'),
                        TextInput::make('admisiones_boton_texto')
                            ->required()
                            ->maxLength(255)
                            ->label('Texto del botón principal'),
                        TextInput::make('admisiones_boton_url')
                            ->required()
                            ->maxLength(255)
                            ->label('URL del botón principal'),
                        TextInput::make('admisiones_llamada_texto')
                            ->maxLength(255)
                            ->label('Texto del botón de llamada'),
                        TagsInput::make('admisiones_tags')
                            ->label('Etiquetas del Proceso (Badges)')
                            ->placeholder('Escribe una etiqueta y presiona Enter')
                            ->helperText('Etiquetas verdes con icono de verificación bajo los botones.')
                            ->columnSpanFull(),
                        Repeater::make('admisiones_pasos')
                            ->label('Pasos del Proceso de Admisión (Columna Derecha)')
                            ->schema([
                                TextInput::make('num')
                                    ->label('Número')
                                    ->placeholder('01')
                                    ->required(),
                                TextInput::make('titulo')
                                    ->label('Título del Paso')
                                    ->required(),
                                Textarea::make('desc')
                                    ->label('Descripción del Paso')
                                    ->rows(2)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->columnSpanFull(),
                    ])->columns(2)
                    ->columnSpanFull(),

                Section::make('Popup de Admisiones')
                    ->description('Configura el aviso emergente que aparece en la página de inicio.')
                    ->compact()
                    ->schema([
                        Toggle::make('popup_habilitado')
                            ->label('Popup habilitado')
                            ->helperText('Activa o desactiva el aviso emergente desde el panel de administración.')
                            ->columnSpanFull(),
                        TextInput::make('popup_button_text')
                            ->maxLength(255)
                            ->label('Texto del botón del popup')
                            ->columnSpanFull(),
                        TextInput::make('popup_button_url')
                            ->maxLength(255)
                            ->label('URL del botón del popup')
                            ->columnSpanFull(),
                        FileUpload::make('popup_imagen')
                            ->image()
                            ->directory('popups')
                            ->label('Imagen del popup')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ── Fila 3: Propuesta de Valor / Identidad ──
                Section::make('Propuesta de Valor / Identidad (Página Principal)')
                    ->description('Configura los textos, pilares y cita de "Una Educación que Transforma Vidas".')
                    ->compact()
                    ->schema([
                        TextInput::make('valor_titulo')
                            ->label('Título de la Sección')
                            ->placeholder('Una Educación que Transforma Vidas')
                            ->columnSpanFull(),
                        Textarea::make('valor_subtitulo')
                            ->label('Subtítulo / Introducción')
                            ->rows(2)
                            ->columnSpanFull(),
                        Repeater::make('valor_pilares')
                            ->label('Pilares o Valores Institucionales (Tarjetas)')
                            ->schema([
                                TextInput::make('titulo')
                                    ->label('Título del Pilar')
                                    ->required(),
                                Textarea::make('descripcion')
                                    ->label('Descripción')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->collapsible()
                            ->columnSpanFull(),
                        TextInput::make('valor_frase_autor')
                            ->label('Autor o Atribución de la Cita')
                            ->placeholder('— Inspirados en el Carisma de Marie Poussepin')
                            ->columnSpanFull(),
                        Textarea::make('valor_frase')
                            ->label('Frase o Lema Destacado (Cita inferior)')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ── Fila 4: Oferta Educativa ──
                Section::make('Oferta Educativa (Página Principal)')
                    ->description('Configura los títulos y las tarjetas de los niveles educativos (Preescolar, Primaria, Bachillerato).')
                    ->compact()
                    ->schema([
                        TextInput::make('oferta_titulo')
                            ->label('Título de la Sección')
                            ->placeholder('Nuestra Oferta Educativa')
                            ->columnSpanFull(),
                        Textarea::make('oferta_subtitulo')
                            ->label('Subtítulo / Introducción')
                            ->rows(2)
                            ->columnSpanFull(),
                        Repeater::make('oferta_niveles')
                            ->label('Tarjetas de Niveles Educativos')
                            ->schema([
                                TextInput::make('nivel')
                                    ->label('Nombre del Nivel')
                                    ->placeholder('Preescolar, Básica Primaria, etc.')
                                    ->required(),
                                TextInput::make('grados')
                                    ->label('Grados que comprende')
                                    ->placeholder('Jardín · Transición')
                                    ->required(),
                                Textarea::make('descripcion')
                                    ->label('Descripción')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                                TagsInput::make('features')
                                    ->label('Puntos clave / Viñetas con check')
                                    ->placeholder('Escribe y presiona Enter')
                                    ->helperText('Características destacadas del nivel.')
                                    ->columnSpanFull(),
                                TextInput::make('enlace')
                                    ->label('Ruta del enlace "Conocer más"')
                                    ->placeholder('/nuestra-institucion/seccion-preescolar')
                                    ->columnSpanFull(),
                                \App\Support\ImageOptimizer::configure(FileUpload::make('imagen'), 'oferta-educativa')
                                    ->label('Foto / Imagen de Portada')
                                    ->image()
                                    ->disk('public')
                                    ->imagePreviewHeight('180')
                                    ->columnSpanFull()
                                    ->helperText('Sube una foto representativa para este nivel educativo (se optimizará automáticamente).'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ── Fila 5: Pastoral y Pagos (lado a lado) ──
                Grid::make(2)
                    ->schema([
                        Section::make('Pastoral / Evangelio')
                            ->description('Configuración del Evangelio semanal de la institución.')
                            ->compact()
                            ->schema([
                                TextInput::make('evangelio_embed_url')
                                    ->url()
                                    ->columnSpanFull()
                                    ->label('Enlace de Canva o video de YouTube')
                                    ->placeholder('https://www.youtube.com/watch?v=... o https://www.canva.com/design/...')
                                    ->helperText('Pega un enlace de Canva (presentación) o un enlace de YouTube (video, short o compartido). El sistema lo adaptará automáticamente.'),
                            ]),

                        Section::make('Pagos y Plataformas')
                            ->description('URLs de acceso rápido en la página principal.')
                            ->compact()
                            ->schema([
                                TextInput::make('pago_en_linea_url')
                                    ->url()
                                    ->columnSpanFull()
                                    ->placeholder('https://...')
                                    ->label('URL de Pago en Línea (PSE)')
                                    ->helperText('Enlace directo al portal PSE o botón de pago.'),
                                TextInput::make('syscolegios_url')
                                    ->url()
                                    ->columnSpanFull()
                                    ->placeholder('https://syscolegios.org/...')
                                    ->label('URL Portal Syscolegios')
                                    ->helperText('Enlace directo al portal de Syscolegios.'),
                            ]),
                    ])
                    ->columnSpanFull(),

                // ── Fila 6: Pie de Página (Footer) ──
                Section::make('Pie de Página (Footer)')
                    ->description('Textos institucionales y sellos de calidad en el pie de página.')
                    ->compact()
                    ->schema([
                        TextInput::make('footer_anio_fundacion')
                            ->label('Año de Fundación')
                            ->placeholder('1882'),
                        TextInput::make('footer_lema')
                            ->label('Lema o Frase Institucional')
                            ->placeholder('inspiradas en el carisma de Marie Poussepin.'),
                        Repeater::make('footer_certificaciones')
                            ->label('Sellos de Certificación (Icontec / IQNet)')
                            ->schema([
                                \App\Support\ImageOptimizer::configure(FileUpload::make('imagen'), 'certificaciones')
                                    ->label('Logo o Sello')
                                    ->disk('public')
                                    ->image()
                                    ->imagePreviewHeight('90')
                                    ->required()
                                    ->columnSpan(1),
                                Grid::make(1)
                                    ->schema([
                                        TextInput::make('titulo')
                                            ->label('Título / Tooltip')
                                            ->placeholder('Ej: Certificación Icontec ISO 21001 e IQNet'),
                                        TextInput::make('alt')
                                            ->label('Texto alternativo (Alt)')
                                            ->placeholder('Ej: Icontec ISO 21001'),
                                        TextInput::make('url')
                                            ->label('Enlace al certificado oficial (Opcional)')
                                            ->url()
                                            ->placeholder('https://...'),
                                    ])
                                    ->columnSpan(1),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['titulo'] ?? $state['alt'] ?? 'Sello de Certificación')
                            ->addActionLabel('Agregar sello de certificación')
                            ->columnSpanFull()
                            ->helperText('Puedes cambiar las fotos de Icontec, subir nuevos sellos o enlazar cada uno a su certificado en PDF o web.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Fila 7: Pruebas Diagnósticas (acceso con contraseña) ──
                Section::make('Pruebas Diagnósticas')
                    ->description('Protege la página de Pruebas Diagnósticas con una contraseña. Déjalo vacío para que la página sea pública.')
                    ->compact()
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        TextInput::make('pruebas_diagnosticas_password')
                            ->label('Contraseña de acceso')
                            ->password()
                            ->revealable()
                            ->nullable()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->helperText('Si está vacío, cualquier visitante puede acceder. Si tiene una contraseña, se mostrará una pantalla de bloqueo.'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
