<div>
    <div class="container">
        <h1>Mi home</h1>
        <div style="width:100%; background-color:#efebe8;padding:3px;">
            {{ Auth()->user()->name }} | {{ Auth()->user()->email }} | Rol: {{ implode(',',session('rol')) }}
        </div>
        <div class="py-4">
            <ul>
                @if(preg_match('/admin/', implode(session('rol') ))==true)
                    <li><a href="/usuarios">Usuarios</a></li>
                    <li><a href="/verRecorridos">Ver Recorridos</a></li>
                @endif

                @if(preg_match('/recorridos/', implode(session('rol') ))==true)
                    <li><a href="/grupos">Vender boletos</a></li>
                @endif

                <li><a href="/verRecorridos">Reporte de boletos</a></li>
                <li>Catálogo de guias</li>
                <li>Catálogo de tipos de recorrido</li>
                <li>Catálogo de tipos de boleto</li>
            </ul>
        </div>
    </div>
</div>
