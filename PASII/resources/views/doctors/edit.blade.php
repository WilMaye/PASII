<?php
  use Illuminate\Support\Str;
?>
@extends('layouts.panel')

@section('styles')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection

@section('content')

          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Editar Médico</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('/medicos')}}" class="btn btn-sm btn-success">
                  <i class="fas fa-chevron-left"> </i>  
                  Regresar</a>

                </div>
              </div>
            </div>

            <div class="card-body">

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                      <i class="fas fa-exclamation-triangle"></i>
                      <strong>Por Favor!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif

                <form action="{{url ('/medicos/'.$doctor->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label form="name">Nombre del médico</label>
                        <input type="text" name="name" class="form-control" value="{{old('name', $doctor->name)}}">
                    </div>

                    <div>
                        <label for="specialties">Especialidades</label>
                        <select name="specialties[]" id="specialties" class="form-control selectpicker"
                        data-style="btn-primary" title="Seleccionar especialidades" multiple required>
                            @foreach ($specialties as $especialidad)
                              <option value="{{ $especialidad->id }}">{{ $especialidad->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label form="email">Correo Electrónico</label>
                        <input type="text" name="email" class="form-control" value="{{old('email', $doctor->email)}}">
                        </div>

                        
                    <div class="form-group">
                        <label form="dpi">DPI</label>
                        <input type="text" name="dpi" class="form-control" value="{{old('dpi', $doctor->dpi)}}">
                        </div>

                    <div class="form-group">
                        <label form="address">Dirección</label>
                        <input type="text" name="address" class="form-control" value="{{old('address', $doctor->address)}}">
                        </div>

                    <div class="form-group">
                        <label form="phone">Teléfono / Móvil</label>
                        <input type="text" name="phone" class="form-control" value="{{old('phone', $doctor->phone)}}">
                        </div>

                        <div class="form-group">
                        <label form="password">Contraseña</label>
                        <input type="text" name="password" class="form-control">
                        <small class="text-warning">SOLO LLENA EL CAMPO SI DESEA CAMBIAR LA CONTRASEÑA</small>
                        </div>

                       <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios</button> 
                </form>

            </div>
          </div>
    
@endsection

@section('scripts')

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(()=> {});
    $('#specialties').selectpicker('val', @json($specialty_ids));   
</script>

@endsection
