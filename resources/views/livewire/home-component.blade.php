<div>
    <div class="container">
        <h1>Mi home</h1>
        <div style="width:100%; background-color:#efebe8;padding:3px;">
            {{ Auth()->user()->name }} | {{ Auth()->user()->email }} | Rol: {{ implode(',',session('rol')) }}
        </div>
        <div class="py-4">
            <ul>
                <li><a href="/usuarios">Usuarios</a></li>
                <li><a href="/grupos">Vender boletos</a></li>
            </ul>
        </div>
    </div>
</div>
