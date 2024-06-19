@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')
<main id="main" class="martop">

    <section class="inner-page">
      <div class="container ">
        <!-- <div class="title text-center mb-5">
            <h3 class="fw-bold">Layanan Pengaduan Masyarakat</h3>
            <h5 class="fw-normal">Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</h5>
        </div> -->

        <div class="row">
            <div class="col-md-4">
                <div class="card card-responsive p-4 border-0 shadow rounded mx-auto">
                    <h5><b>Data Pelapor</b></h5>
                    <p>
                    {{ $pengaduan->user->name }} <br>
                    {{ Carbon\Carbon::parse($pengaduan->tgl_kejadian)->format('d F Y') }} <br>
                    </p>
               </div>
            </div>
            <div class="col-md-8">
                <div class="card card-responsive p-4 border-0 shadow rounded mx-auto text-center">
                    <img src="{{ $pengaduan->foto }}" alt="">
                    <h3>{{ $pengaduan->judul_laporan }}</h3>
                    <p>
                        @if($pengaduan->status == '0')
                            <span class="text-sm text-white p-1 bg-danger">Pending</span>
                        @elseif($pengaduan->status == 'proses')
                            <span class="text-sm text-white p-1 bg-warning">Proses</span>
                        @else
                            <span class="text-sm text-white p-1 bg-success">Selesai</span>
                        @endif
                    </p>
                    <p>{{ $pengaduan->isi_laporan }}</p>
                    <span class="text-sm badge badge-warning">Proses</span>
               </div>
            </div>
        </div>



      </div>
    </section>

  </main><!-- End #main -->
@endsection
