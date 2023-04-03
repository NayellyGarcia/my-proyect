@extends('layouts.panel')

@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Registrar nueva cita</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
          Cancelar y volver
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <!--if para verificar errores-->
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
      @foreach ($errors->all() as $error)
      <!--por cada error se muestra un li, punto-->
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    </div>
    @endif

    <form action="{{ url('appointments') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="">Descripción</label>
        <input name="description" id="description" type="text" class="form-control" placeholder="Describe brevemente la consulta.">
      </div>
  <div class="form-row">
    <div class="col-md-6">
      <label for="specialty">Especialidad</label>
      <select name="specialty_id" id="specialty" class="form-control" required>
        <option value="">Seleccionar especialidad</option>
        @foreach ($specialties as $specialty)
          <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6">
      <label for="email">Médico</label>
      <select name="doctor_id" id="doctor" class="form-control">
        
      </select>
    </div>
  </div>

    <div class="form-group">
      <label for="cedula">Fecha</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
        </div>
        <input class="form-control datepicker" placeholder="Seleccionar fecha" 
        id="date" type="text" value="{{ date('Y-m-d') }}" 
        data-date-format="yyyy-mm-dd" 
        data-date-start-date="{{ date('Y-m-d') }}" 
        data-date-end-date="+30d">
      </div>
    </div>
    <div class="form-group">
      <label for="address">Hora de atención</label>
      <div id="hours">
      <div class="alert alert-info" role="alert">
        Selecciona un médico y una fecha, para ver citas disponibles.
      </div>
      </div>
    </div>
    <div class="form-group">
      <label for="type">Tipo de consulta</label>
    <div class="custom-control custom-radio">
      <input type="radio" id="type1" name="type" checked class="custom-control-input">
      <label class="custom-control-label" for="type1">Consulta</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="type2" name="type" class="custom-control-input">
      <label class="custom-control-label" for="type2">Examen</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="type2" name="type" class="custom-control-input">
      <label class="custom-control-label" for="type2">Operación</label>
    </div>
    </div>
    <button type="submit" class="btn btn-primary">
      Guardar
    </button>
  </form>
</div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection
