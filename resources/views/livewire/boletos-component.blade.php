<div class="m-2">
    {{-- <span class="d-none d-xl-inline-block">xl ExtraGrande</span>
    <span class="d-none d-lg-inline-block d-xl-none">lg Grande</span>
    <span class="d-none d-md-inline-block d-lg-none">md Mediano</span>
    <span class="d-none d-sm-inline-block d-md-none ">sm Chico</span>
    <span class="d-xs-block d-sm-none">sm Extrachico</span> --}}
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
        input[type=number] { -moz-appearance:textfield; }

        .colA{
            /* width:250px; */
            vertical-align:middle;
            font-weight: bold;
            /* display:inline-block; */
            font-size: 130%;
            padding: 0px;
            /* border:1px solid black; */
        }
        input.colB{
            width: 80px;
            height: 200%;
            display:inline-block;
            font-size:180%;
        }
        .botoncillo {
            font-size: 150%;
            color:#CDC6B9;
            margin:2px;
            cursor: pointer;
        }
        .gpo{
            margin:15px;
        }
    </style>
    {{-- <span class="d-none d-xl-inline-block">xl ExtraGrande</span>
    <span class="d-none d-lg-inline-block d-xl-none">lg Grande</span>
    <span class="d-none d-md-inline-block d-lg-none">md Mediano</span>
    <span class="d-none d-sm-inline-block d-md-none ">sm Chico</span>
    <span class="d-xs-block d-sm-none">xs Extrachico</span> --}}


    <div class="row">
        <div class="col-12">
            <h2>
                <!-- dia de la semana-->
                {{ $fecha['semana'][$fecha['sem']] }}
                <!-- dia del mes-->
                {{ $fecha['dia'] }}
                <!-- mes -->
                de {{ $fecha['meses'][$fecha['mes']] }}
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3 style="display: inline;">
                <!-- Número de recorrido -->
                ID {{ $GpoAbierto->gpo_id }}:

                <!-- Tipo de recorrido -->
                <span style="@if($GpoAbierto->gpo_cgponame=='Aún sin definir')text-decoration:underline; @endif cursor: pointer;">
                    <span onclick="VerNoVer('Ver','Recorrido')" class="PaClick">
                        {{ $GpoAbierto->gpo_cgponame  }}
                    </span>
                </span>

                <!-- Hora del recorrido -->
                {{ date('H:m',strtotime($GpoAbierto->gpo_ini_reg)) }}

                <!-- Guía -->
                <span onclick="VerNoVer('Ver','Guia')" class="PaClick" style="@if($GpoAbierto->gpo_guianame=='Aún sin definir') text-decoration:underline; @endif">
                    {{ $GpoAbierto->gpo_guianame }}
                </span>
            </h3>

        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <!-- Select de tipo de recorrido -->
            <div id="sale_VerRecorrido" style="display:none;">
                <label class="label-control">Recorrido:</label>
                <select wire:model="NvoRecorrido" wire:change="CambiaRecorrido('reco')" class="form-select" style="">
                    <option value="">Indicar</option>
                    @foreach ($recorridos as $rec)
                        <option value="{{ $rec->cgpo_name }}">{{ $rec->cgpo_name }}</option>
                    @endforeach
                </select>
                @error('NvoRecorrido')<error>{{ $message }}</error>@enderror
            </div>
        </div>
        <div class="col-5">
            <!-- Select de tipo de recorrido -->
            <div id="sale_VerGuia" style="display:none;">
                <label class="label-control">Guía:</label>
                <select wire:model="NvoGuia" wire:change="CambiaRecorrido('guia')" class="form-select" style="">
                    <option value="">Indicar</option>
                    @foreach ($guias as $gui)
                        <option value="{{ $gui->guia_name }}">{{ $gui->guia_name }}</option>
                    @endforeach
                </select>
                @error('NvoGuia')<error>{{ $message }}</error>@enderror
            </div>
        </div>
        <div class="col-6">
            <span style="background-color:#CD7B34; display:inline-block;border-radius:7px; padding:10px; text-align:center;">
                <!-- Tamaño del grupo -->
                {{ $GpoSize }} personas
            </span>
        </div>
        <div class="col-6">
            <!-- Botón de cerrar grupo -->
            @if($boletos == '0' AND ($GpoAbierto->gpo_guianame != 'Aún sin definir' OR $GpoAbierto->gpo_cgponame != 'Aún sin definir'  ))
                <span style="float: right; margin:15px;">
                    <i class="bi bi-door-open-fill" wire:click="CerrarGrupo()" wire:confirm="Ya no podrás ingresar a ninguna persona a este grupo. ¿Deseas continuar?" style="cursor: pointer;color:#64383E">
                        Cerrar Grupo
                    </i>
                </span>
            @endif
            @if( $GpoAbierto->gpo_guianame == 'Aún sin definir' OR $GpoAbierto->gpo_cgponame == 'Aún sin definir'   )
                <span style="background-color:#CD7B34;padding:3px;">
                    Falta definir guia / tipo.
                </span>
            @endif
        </div>
    </div>

    <div class="row">
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo">
                    <div class="colA">Internacional</div>
                    <input wire:model.live="Internacional" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" min="0" class="colB form-control">
                    <i wire:click="suma('Internacional')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Internacional > 0)
                        <i wire:click="resta('Internacional')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo">
                    <div class="colA">Nacional</div>
                    <input wire:model.live="Nacional" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" min="0" class="colB form-control">
                    <i wire:click="suma('Nacional')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Nacional > 0)
                        <i wire:click="resta('Nacional')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo form-group">
                    <div class="colA">Mayores 60</div>
                    <input wire:model.live="Mayor60" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" min="0" class="colB form-control">
                    <i wire:click="suma('Mayor60')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Mayor60 > 0)
                        <i wire:click="resta('Mayor60')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo form-group">
                    <div class="colA">Menores 13</div>
                    <input wire:model.live="Menor13" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" class="colB form-control">
                    <i wire:click="suma('Menor13')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Menor13 > 0)
                        <i wire:click="resta('Menor13')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo form-group">
                    <div class="colA">Profesores</div>
                    <input wire:model.live="Profesor" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" min="0" class="colB form-control">
                    <i wire:click="suma('Profesor')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Profesor > 0)
                        <i wire:click="resta('Profesor')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo form-group">
                    <div class="colA">Estudiantes</div>
                    <input wire:model.live="Estudiante" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" min="0" class="colB form-control">
                    <i wire:click="suma('Estudiante')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Estudiante > 0)
                        <i wire:click="resta('Estudiante')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo form-group">
                    <div class="colA">Discapacidad</div>
                    <input wire:model.live="Discapacidad" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" min="0" class="colB form-control">
                    <i wire:click="suma('Discapacidad')" class="botoncillo bi bi-plus-circle-fill"></i>
                    @if($Discapacidad > 0)
                        <i wire:click="resta('Discapacidad')" class="botoncillo bi bi-dash-circle-fill"></i>
                    @endif
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-4">
                <div class="gpo form-group">
                        <div style="font-size: 140%; background-color:#CD7B34; display:inline-block;border-radius:7px; padding:15px; text-align:center;">
                        <b>Boletos</b><br>
                        {{ $boletos }} cobrar {{ $boletoscobro }}<br>
                        <b> ${{ $cobro }}</b><br>
                    </div>
                </div>
            </div>

    </div>
    <div class="row">
        <div class="gpo col-10 ">
            <label onclick="VerNoVer('ver','notas')" class="PaClick form-label">Notas:</label>
            <div id="sale_vernotas" style="display:none;">
                <textarea wire:model="notas" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <div class="gpo col-5">
            <label class="form-label">Correo electrónico:</label>
            <div class="form-group">
                <input wire:model="mail" type="text" class="form-control" style="width:100%;" disabled>
            </div>
        </div> --}}
        <div class="gpo col-5">
            @if($boletos > 0)
                <button wire:click="borrar()" class="btn btn-secondary"> Borrar datos <i class="bi bi-x-circle"></i></button>
            @endif
        </div>

        <div class="gpo col-5">
            @if($boletos > 0)
                {{-- <br> --}}
                {{-- <button  wire:click="DarBoletos('eletronico')" class="btn btn-secondary" disabled>Enviar boletos <i class="bi bi-wifi"></i></button> --}}
                {{-- &nbsp; --}}
                <button wire:click="DarBoletos('fisico')" class="btn btn-primary">Entregar boletos <i class="bi bi-ticket-fill"></i></button>
            @endif
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-4">
            <button class="btn btn-secondary" disabled>Registrar salida</button>
        </div>
    </div> --}}
</div>
