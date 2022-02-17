@extends('layouts.app')
@section('botones')

    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Regresar</a>

@endsection
@section('content')
    <h1 class="text-center mb-5">Crear nueva receta</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="post" action="{{ route('recetas.store') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="titulo receta">

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>
            </form>
        </div>
    </div>

@endsection
