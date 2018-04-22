@extends('layouts.crud')

@section('title', 'Crear Evento')
@section('titulo', 'CRUD Eventos')

@section('content')
  <article class="col-sm-10">
    <h2>
      Crear Evento
      <a href="{{route('eventos.index')}}" class="btn btn-primary pull-right">Listar</a>
    </h2>
    @include('eventos.codigo.info')

    {!! Form::model($evento, ['route' => ['eventos.update', $evento->id], 'method' =>'PUT', 'files' => true]) !!}
      @include('eventos.codigo.form')
    {!! Form::close() !!}      

  </article>
  <article class="col-sm-2 text-center">
    @include('eventos.codigo.aside')
  </article>
@endsection

{{-- @extends('layouts.crud')

@section('title', 'Editar Evento')
@section('titulo', 'CRUD Eventos')

@section('content')
  <article class="col-sm-10">
    <h2>
      Editar Evento
      <a href="{{route('eventos.index')}}" class="btn btn-primary pull-right">Listar</a>
    </h2>
    @include('eventos.codigo.error')
    {!! Form::model($evento, ['route' => ['eventos.update', $evento->id], 'method' =>'PUT', 'files' => true]) !!}
      @include('eventos.codigo.form')
    {!! Form::close() !!}
        
  </article>
  <article class="col-sm-2 text-center">
    @include('eventos.codigo.aside')
  </article>
@endsection --}}