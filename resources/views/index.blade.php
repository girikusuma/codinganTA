@extends('layout/main')

@section('title', 'Rekomedasi Sepeda Motor')

@section('container')

  <div class="content-wrapper">
    <div class="jumbotron">
      <h1 class="display-4">Sistem Rekomendasi Pemilihan</h1>
      <h1 class="display-4">Sepeda Motor</h1>
      <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/browsingcard.jpg" alt="Card image cap">
            <div class="card-body">
              <a href="{{ url ('/browsing') }}"><h5 class="card-title btn btn-warning btn-lg btn-block">Browsing</h5></a>
            </div>
          </div>
        </div>
        <div class="col">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/searchingcard.jpg" alt="Card image cap">
            <div class="card-body">
              <a href="{{ url ('/searching') }}"><h5 class="card-title btn btn-success btn-lg btn-block">Searching</h5></a>
            </div>
          </div>
        </div>
        <div class="col">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/questionnairecard.jpg" alt="Card image cap">
            <div class="card-body">
              <a href="{{ url ('/browsing') }}"><h5 class="card-title btn btn-info btn-lg btn-block">Questionnaire</h5></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection