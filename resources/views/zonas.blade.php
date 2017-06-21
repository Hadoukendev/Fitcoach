@extends('plantilla')
@section('pagecontent')
  @include('content_holders.auth', ['role'=>'superadmin'])
<div class="container-bootstrap">
  @include('content_holders.notificaciones')
  <div class="topclear">
    &nbsp;
  </div>

    <div class="row profile">
      <div class="col-sm-12">
        @include('content_holders.notificaciones')
      </div>
		<div class="col-md-3">
			@include('content_holders.sidebar3', ['menu'=>'zonasmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- zonas -->
              <h2>Zonas</h2>
              @if (!$zonas->isEmpty())
                   <div class="panel-group" id="zonas" role="tablist" aria-multiselectable="true">
                     @foreach ($zonas as $zona)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $zona->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#zonas" href="#collapse{{ $zona->id }}" aria-expanded="false" aria-controls="collapse{{ $zona->id }}">
                             <a role="button">
                                   {{ Ucfirst($zona->identificador) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $zona->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $zona->id }}">
                           <div class="panel-body">
                             <div class="zona">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-zona') }}/{{ $zona->id }}" method="post"  enctype="multipart/form-data">
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Identificador</label>
                                     <div class="col-sm-9">
                                       <input id="identificador{{ $zona->id }}" class="form-control" type="text" value="{{ $zona->identificador }}" name="identificador" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Dirección</label>
                                     <div class="col-sm-9">
                                       <textarea id="direccion{{ $zona->id }}" class="form-control" name="direccion" disabled required>{{ $zona->direccion }}</textarea>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Latitud</label>
                                     <div class="col-sm-9">
                                       <input id="latitud{{ $zona->id }}" class="form-control" type="text" value="{{ $zona->latitud }}" name="latitud" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Longitud</label>
                                     <div class="col-sm-9">
                                       <input id="longitud{{ $zona->id }}" class="form-control" type="text" value="{{ $zona->longitud }}" name="longitud" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Clase</label>
                                     <div class="col-sm-9">
                                       <select class="form-control"  name="clases_id" disabled id="clases_id{{ $zona->id }}" required>
                                         <option value="">Selecciona una opción</option>
                                         @foreach ($clases as $clase)
                                           <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                                         @endforeach
                                       </select>
                                     </div>
                                   </div>
                                   <script type="text/javascript">
                                     if (document.getElementById('clases_id{{ $zona->id }}') != null) document.getElementById('clases_id{{ $zona->id }}').value = '{!! $zona->clases_id !!}';
                                   </script>
               												{!! csrf_field() !!}
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $zona->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $zona->id }}" onclick="habilitar({{ $zona->id }})">Editar</a> &nbsp;

                                          <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $zona->id }}').click();">Borrar</a>
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-zona') }}/{{ $zona->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $zona->id }}">
                                </form>

                              </div>

                          </div>
                               </div>
                               <div class="text-right">

                               </div>
                             </div>
                           </div>
                         </div>
                       </div>

                     @endforeach

                   </div>

           @else
             <p>No tienes zonas</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#zonas" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar zona
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="zona">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-zona') }}" method="post"  enctype="multipart/form-data">

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Identificador</label>
                         <div class="col-sm-9">
                           <input id="identificadorNuevo" class="form-control" type="text" value="{{ old('identificador') }}" name="identificador" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Dirección</label>
                         <div class="col-sm-9">
                           <textarea id="direccionNuevo" class="form-control" name="direccion" required>{{ old('direccion') }}</textarea>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Latitud</label>
                         <div class="col-sm-9">
                           <input id="latitudNuevo" class="form-control" type="text" value="{{ old('latitud') }}" name="latitud" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Longitud</label>
                         <div class="col-sm-9">
                           <input id="longitudNuevo" class="form-control" type="text" value="{{ old('longitud') }}" name="longitud" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Clase</label>
                         <div class="col-sm-9">
                           <select class="form-control"  name="clases_id" id="clases_idNuevo" required>
                             <option value="">Selecciona una opción</option>
                             @foreach ($clases as $clase)
                               <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                             @endforeach
                           </select>
                         </div>
                       </div>
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <div class="col-sm-12 text-right">
                              <input class="btn btn-success" type="submit" value="Guardar" id="botonguardarNuevo">
                            </div>
                          </div>
                    </form>
                  </div>
              </div>
                   </div>

                 </div>
               </div>
             </div>
           </div>

           <!--termina zonas -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('identificador'+valor).disabled=false;
    document.getElementById('direccion'+valor).disabled=false;
    document.getElementById('latitud'+valor).disabled=false;
    document.getElementById('longitud'+valor).disabled=false;
    document.getElementById('clases_id'+valor).disabled=false;

    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>

@endsection
