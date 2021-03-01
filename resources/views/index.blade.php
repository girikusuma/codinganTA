@extends('layout/main')

@section('title', 'Rekomedasi Sepeda Motor')

@section('container')
<div class="content-wrapper">
  <div class="jumbotron">
    <h1 class="display-4">Sistem Rekomendasi Pemilihan</h1>
    <h1 class="display-4">Sepeda Motor</h1>
    <p class="lead">Metode yang digunakan dalam melakukan sistem rekomendasi ini adalah menggunakan metode Sistem Pendukung Keputusan Simple Additive Weighting (SAW). Sistem ini menggunakan ontologi sebagai tulang punggungnya dimana terdapat 19 classes, 16 Object properties, 16 Data properties dan beberapa individual yang menjadi objek dalam sistem ini.</p>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="images/browsingcard.jpg" alt="Card image cap" style="height : 12rem; width : 17.9rem;">
          <div class="card-body">
            <a href="{{ route('browsing') }}"><h5 class="card-title btn btn-warning btn-lg btn-block">Browsing</h5></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="images/searchingcard.jpg" alt="Card image cap" style="height : 12rem; width : 17.9rem;">
          <div class="card-body">
            <a href="{{ route('searching.index') }}"><h5 class="card-title btn btn-success btn-lg btn-block">Searching</h5></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="images/rekomendasicard.jpg" alt="Card image cap" style="height : 12rem; width : 17.9rem;">
          <div class="card-body">
            <a href="{{ route('rekomendasi.index') }}"><h5 class="card-title btn btn-dark btn-lg btn-block">Rekomendasi</h5></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="images/questionnairecard.jpg" alt="Card image cap" style="height : 12rem; width : 17.9rem;">
          <div class="card-body">
            <a href="https://forms.gle/QvFVHwEGkoupnfZ48" target="_blank"><h5 class="card-title btn btn-info btn-lg btn-block">Questionnaire</h5></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection