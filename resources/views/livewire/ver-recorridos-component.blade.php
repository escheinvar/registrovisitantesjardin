<div>
    <div class="container">
        <h1>Ver recorridos</h1>

        <div class="my-4">
            <div class="row">
                <div class="col-2">
                    <label class="form-label">Desde el día</label>
                    <input wire:model.live="fechaIni" value='{{ $fechaIni }}' type="date" class="form-control">
                </div>

                <div class="col-2">
                    <label class="form-label">Hasta el día</label>
                    <input wire:model.live="fechaFin" value='{{ $fechaFin }}' min='{{ $fechaIni }}' type="date" class="form-control">
                </div>

                <div class="col-6">
                </div>

                <div class="col-2">
                    <div style="width:100%; float:right;">
                        <br>
                        <button wire:click="Exportar()" class="btn btn-primary">Eportar a csv</button>
                    </div>
                </div>

            </div>


        </div>

        <div>
            <b>{{ $grupos->count() }} recorrido(s)</b>
        </div>
        <table class="table table-striped">
            <thead>
                <th><span class="PaClick" wire:click="ordenar('gpo_id')">ID</span></th>
                <th><span class="PaClick" wire:click="ordenar('gpo_fin_reg')">Día y hora</th>
                <th><span class="PaClick" wire:click="ordenar('gpo_cgponame')">Tipo de recorrido</th>
                <th><span class="PaClick" wire:click="ordenar('gpo_guianame')">Guía</th>
                <th>Cantidad por tipo</th>
                <th>Total de boletos</th>
            </thead>
            <tbody>
                @foreach ($grupos as $gpo)
                    <tr>
                        <!-- gpo id -->
                        <td>
                            {{$gpo->gpo_id}}
                        </td>
                        <!-- Gpo fecha -->
                        <td>
                            {{ $gpo->gpo_fin_reg }}
                            @if($gpo->gpo_cerrado=='0')
                                <div style="background-color:green; color:white; padding:5px;">
                                    Grupo abierto
                                </div>
                            @endif
                        </td>
                        <!-- tipo de reorrido -->
                        <td>
                            {{ $gpo->gpo_cgponame }}
                        </td>
                        <!-- guia -->
                        <td>
                            {{ $gpo->gpo_guianame }}
                        </td>
                        <!-- boletos -->
                        <td>
                            <?php $paga='0'; $total='0'; ?>
                            @foreach ($boletos->where('bol_gpoid',$gpo->gpo_id) as $bol)
                                <div>
                                    {{ $bol->boletos }}
                                    {{ $bol->bol_bolname }}
                                </div>
                                <?php
                                    $total += $bol->boletos;
                                    if( ($gpo->gpo_cgponame != 'Escolar' AND $gpo->gpo_cgponame != 'Paseo_gratuito') AND ($bol->bol_bolname == 'Nacional' OR $bol->bol_bolname == 'Internacional') ){
                                     $paga += $bol->boletos;
                                    }
                                ?>
                            @endforeach
                        </td>

                        <td>
                            <div>
                                Total: {{ $total }}
                            </div>
                            <div>
                                Total paga: {{ $paga }}
                            </div>
                            <div>
                                $ {{ $paga * 50 }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($grupos->count() < '1')
            -- no hay recorridos para el día seleccionado --
        @endif
    </div>
</div>
