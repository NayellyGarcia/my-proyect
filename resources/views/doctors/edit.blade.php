@extends('layouts.panel')

@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Editar datos médico</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">
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
    <!--old es para recordar y no cambiar lo que se inserto al cometer un error -->
    <!--siempre se pone el id en url del usuario pedido-->
    <form action="{{ url('doctors/'.$doctor->id) }}" method="post">
      @csrf
      @method('PUT')
      <input type="hidden" name="method" value="PUT">
    <div class="form-group">
      <label for="name">Nombre del médico</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
    </div>
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="text" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
    </div>
    <div class="form-group">
      <label for="cedula">Cédula</label>
      <input type="text" name="cedula" class="form-control" value="{{ old('cedula', $doctor->cedula) }}">
    </div>
    <div class="form-group">
      <label for="address">Dirección</label>
      <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address) }}">
    </div>
    <div class="form-group">
      <label for="phone">Teléfono/ móvil</label>
      <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}">
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="text" name="password" class="form-control" value="">
      <p>Ingrese un valor sólo si desea modificar la contraseña.</p>
    </div>
    <button type="submit" class="btn btn-primary">
      Guardar
    </button>
  </form>
</div>
</div>
@endsection
