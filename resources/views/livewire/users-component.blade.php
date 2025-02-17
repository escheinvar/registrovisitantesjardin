<div>
    <div class="container">
        <h1>Usuarios</h1>
        <div>
            <button wire:click="MandarDato('nuevo')" onclick="VerNoVer('Nuevo','Usuario')"class="btn btn-secondary" style="float: right;">Nuevo Usuario</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $u)
                    <tr>
                        <td>
                            @if($u->act=='1')
                                <i class="bi bi-eye"></i>

                            @else
                                <i class="bi bi-eye-slash-fill"></i>
                            @endif
                            <i class="bi bi-pencil-square PaClick" wire:click="MandarDato('{{ $u->id }}')"></i>
                        </td>
                        <td>
                            <div class="PaClick" wire:click="MandarDato('{{ $u->id }}')">
                                {{ $u->name }}
                            </div>
                        </td>
                        <td>
                            <div class="PaClick" wire:click="MandarDato('{{ $u->id }}')">
                                {{ $u->email }}
                            </div>
                        </td>
                        <td>
                            @foreach ($roles->where('rol_email',$u->email) as $r)
                                <div>
                                    {{ $r->rol_rol }}
                                </div>
                            @endforeach

                            @if($roles->where('rol_email',$u->email)->where('rol_act','1')->count() < '1' )
                                <error>Falta indicar un rol</error>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <!-- Formulario de edición de datos -->
            @if($verCampo != '')
                <div id="sale_NuevoUsuario" class="py-4">
                    <h3>Nuevo usuario</h3>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 form-group">
                            <label class="form-label">Nombre:</label>
                            <input wire:model="NvoNombre" class="form-control" type="text">
                            @error('NvoNombre')<error>{{ $message }}</error>@enderror

                            <label class="form-label">Correo:</label>
                            <input wire:model="NvoMail" class="form-control" @if($verCampo=='editar') disabled @endif type="mail">
                            @error('NvoMail')<error>{{ $message }}</error>@enderror
                        </div>

                        <div class="col-sm-12 col-md-4 form-group">
                            @if($verCampo!='nuevo')
                                <input wire:model.live='CambiaPass' class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Cambiar
                                </label>
                            @endif

                            <label class="form-label">Password:</label>
                            <input type="password" wire:model="Password" class="form-control" @if($verCampo!='nuevo' and $CambiaPass==FALSE) disabled @endif>
                            @error('Password')<error>{{ $message }}</error>@enderror
                            <label class="form-label">Confirmar password:</label>
                            <input type="password" wire:model="Password2" class="form-control"  @if($verCampo!='nuevo' and $CambiaPass==FALSE) disabled @endif>
                            @error('Password2')<error>{{ $message }}</error>@enderror

                        </div>

                        <div class="col-sm-12 col-md-4 form-group">
                            <label class="form-label">Rol(es):</label>
                            <select wire:model="NvoRoles" class="form-select" multiple>
                                @foreach ($catrol as $rol)
                                    <option value="{{ $rol->crol_rol }}">{{ $rol->crol_rol }}</option>
                                @endforeach
                            </select>
                            @error('NvoRoles')<error>{{ $message }}</error>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 py-4">
                            <div class="form-check">
                                <input wire:model.live='NvoAct' class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    @if($NvoAct==TRUE) Usuario Activo @else Usuario Inactivo @endif
                                </label>
                            </div>
                        </div>

                        <div class="col-4 py-4">
                            <button wire:click="GuardaOcreaUsr('{{ $NvoId }}')" class="btn btn-primary">
                                @if($verCampo=='nuevo')
                                    Crear usuario
                                @else
                                    Guardar cambios {{ $NvoId }}
                                @endif
                            </button>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</div>
