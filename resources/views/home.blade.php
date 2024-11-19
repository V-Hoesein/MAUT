@extends('layout.app')
@section('title', $title)
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div >
      <div >
        <img src="images/SMA3.jpg" class="d-block h-60 w-100" alt="...">
       <div class="carousel-caption d-none d-md-block">
          <div  style="color: black;" class="p-4 bg-secondary-subtle border rounded-3">
            <h3><B>SELAMAT DATANG</B></h3>
            <p >SISTEM PENGAMBILAN KEPUTUSAN GAYA BELAJAR SISWA DI SMA NEGERI 1 JANGKA </p>
          </div>
        </div>
      </div>
  </div>
@endsection
