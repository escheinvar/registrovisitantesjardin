<div>
    <div class="container">
        <span class="d-none d-xl-inline-block">xl ExtraGrande</span>
        <span class="d-none d-lg-inline-block d-xl-none">lg Grande</span>
        <span class="d-none d-md-inline-block d-lg-none">md Mediano</span>
        <span class="d-none d-sm-inline-block d-md-none ">sm Chico</span>
        <span class="d-xs-block d-sm-none">sm Extrachico</span>


        <br><br>
        <h1>Grupos del {{ $fecha['semana'][$fecha['sem']] }} {{ $fecha['dia'] }} de {{ $fecha['meses'][$fecha['mes']] }}</h1>

        <!-- Tabla de grupos del día -->
        @if($grupos->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Tipo</th>
                        <th>Guia</th>
                        <th>Horario</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupos as $g )
                        <tr>
                            <!-- núemero-->
                            <td>{{ $g->gpo_num }}) {{ $g->gpo_id }}</td>
                            <!--tipo -->
                            <td>{{ $g->gpo_cgponame }}</td>
                            <!-- guia-->
                            <td>{{ $g->gpo_guianame }}</td>
                            <!-- Visitante -->
                            {{-- {{ $NumGente->where('bol_gpoid',$g->gpo_id)->value('suma') }} --}}
                            <!-- Hora-->
                            <td>{{  date('H:m',strtotime($g->gpo_ini_reg))  }} </td>
                            <!-- Estatus-->
                            <td style="@if($g->gpo_cerrado=='0') background-color:green; color:white; @endif">
                                @if($g->gpo_cerrado=='0')
                                    <a href="/boletos" class="nolink">
                                        <div style="width:100%;height:100%;">Grupo abierto</div>
                                    </a>
                                @else
                                    Grupo cerrado
                                @endif
                            </td>
                        </li>
                    @endforeach
                </tbody>
            </table>
        @else
            -- Aún no hay grupos -->
        @endif

        <!-- Botón para generar nuevo grupo -->
        {{-- @if($gruposAbiertos->count() == '0' AND $verNvoGpo=='0')
            <button class="btn btn-primary" wire:click="verGrupo('1')">
                Iniciar nuevo grupo
            </button>
        @endif --}}



        <div id="sale_NuevoGpo" class="my-4">
            @if($gruposAbiertos->count() == '0' )
                <div class="row my-1">
                    <h3>Generar nuevo grupo de visitantes</h3>
                    <div class="col-2 form-group">
                        <label class="form-label">Crear grupo número:</label><br>
                        <center>
                        <span style="font-size: 150%;font-weight:bold;text-align:center;">{{ $numero }}</span>
                        </center>
                        {{-- <input wire:model="numero" class="form-control" type="text" readonly> --}}
                    </div>

                    <div class="col-4 form-group">
                        <label class="form-label">Tipo de grupo:</label>
                        <select wire:model="gpo" class="form-control">
                            {{-- <option value="">Indicar tipo de grupo</option> --}}
                            @foreach ($tiposGpo as $gpo)
                                <option value='{{ $gpo->cgpo_name }}'>{{ $gpo->cgpo_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4 form-group">
                        <label class="form-label">Guía del grupo:</label>
                        <select wire:model="guia" class="form-control">
                            {{-- <option value="">Indicar Guía</option> --}}
                            @foreach ($guias as $guia)
                                <option value={{ $guia->guia_name }}>{{ $guia->guia_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 form-group">
                    <label class="form-label">Notas (opcional):</label>
                    <textarea wire:model="notas" class="form-control"></textarea>
                </div>

                <div class="row my-2">
                    <div class="col-4">
                        <button wire:click="GeneraGrupo()" type="button" class="btn btn-primary">
                            Empezar a recibir visitantes
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
