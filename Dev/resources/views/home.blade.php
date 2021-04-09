@extends('layouts.principal')

@section('contenido')
{{ $user->rol->nom }}
@endsection