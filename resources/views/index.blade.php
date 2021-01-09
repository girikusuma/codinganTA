@extends('layout/main')

@section('title', 'Browsing')

@section('container')
  <div class="content-wrapper">
    <a href="{{ url ('/browsing') }}">Browsing</a>
    <a href="{{ url ('/searching') }}">Searching</a>
  </div>
@endsection