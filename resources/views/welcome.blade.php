@extends('layouts.main')

@section('container')

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <div class="col-lg-12">
    <h1 class="display-5 fw-bold lh-1 mb-3">Aplikasi Eksekusi Online </h1>
    <h2>Pengadilan Negeri Pekanbaru Kelas IA</h2>
    <p class="lead">Eksekusi adalah menjalankan putusan pengadilan yang telah mempunyai kekuatan hukum tetap <i>(res judicata / inkracht van gewijsde)</i> yang bersifat penghukuman <i>(condemnatoir)</i>, yang dilakukan secara paksa, jika perlu dengan bantuan kekuatan umum.</p>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
      <a href="/login" class="btn btn-primary btn-lg px-4 me-md-2">Login</a>
      <a href="/register" class="btn btn-outline-secondary btn-lg px-4">Register</a>
    </div>
  </div>
</div>

<div class="row align-items-md-stretch mt-5">
  <div class="col-md-6">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/img/eksekusi-1.jpeg" class="d-block w-100" alt="..." height="380">
        </div>
        <div class="carousel-item">
          <img src="/img/eksekusi-2.jpeg" class="d-block w-100" alt="..." height="380">
        </div>
        <div class="carousel-item">
          <img src="/img/eksekusi-3.jpeg" class="d-block w-100" alt="..." height="380">
        </div>
        <div class="carousel-item">
          <img src="/img/eksekusi-4.jpeg" class="d-block w-100" alt="..." height="380">
        </div>
        <div class="carousel-item">
          <img src="/img/eksekusi-5.jpeg" class="d-block w-100" alt="..." height="380">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="col-md-6">
    <h4>Syarat Permohonan Eksekusi</h4>
    <div class="accordion" id="accordionExample">
      @foreach ($jenisEksekusis as $key=>$jenisEksekusi)
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne{{ $key }}">
            # {{ $jenisEksekusi->nama }}
          </button>
        </h2>
        <div id="collapseOne{{ $key }}" class="accordion-collapse collapse @if($key==0) show @endif" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ol class="list-group list-group-numbered">
              @foreach ($jenisEksekusi->persyaratan as $item)
                <li class="list-group-item">{{ $item->nama }}</li>
              @endforeach
            </ol>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
  <div class="col-lg-12">
    <div class="h-100 p-5 bg-light border rounded-3">
      <div class="row mt-3">
        <div class="col-md-6">
          <h2>Kontak</h2>
          <p><i class="fa-solid fa-location-dot"></i> Jl. Teratai No.85, Kec. Sukajadi, Kota Pekanbaru, Riau 28156</p>
          <p><i class="fa-solid fa-phone"></i> (0761) 22573</p>
          <p><i class="fa-solid fa-envelope"></i> admin@pn-pekanbaru.go.id</p>
        </div>
        
        <div class="col-md-6">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6525020617514!2d101.43822491523869!3d0.5223706638193949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac05cdce8e07%3A0x28887b5bfb92cc78!2sPengadilan%20Negeri%20Pekanbaru!5e0!3m2!1sen!2sid!4v1673931468073!5m2!1sen!2sid" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width: 100%; height: 150px;"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mt-5">
  Created by IT Team Pengadilan Negeri Pekanbaru &middot; &copy; 2022
</footer>

@endsection