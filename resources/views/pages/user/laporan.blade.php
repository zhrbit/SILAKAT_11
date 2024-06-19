@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<main id="main" class="martop">

    <section class="inner-page">
      <div class="container ">
        <div class="title text-center mb-5">
            <h1 class="fw-bold">Pengaduan Saya</h1>
        </div>
        <div class="pengaduan">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($pengaduan as $i)
                <div class="col">
                    <div class="card h-100">
                      <img src="{{ asset('storage/',$i->foto)}}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title"><b>{{ $i->judul_laporan }}</b></h5>
                        <p class="card-text">{{ $i->isi_laporan }}</p>
                          <a href="{{ route('pengaduan.detail', $i->id_pengaduan) }}" class="btn btn-primary">Detail</a>
                      </div>
                      <div class="card-footer">
                        <small class="text-muted">{{ Carbon\Carbon::parse($i->tgl_kejadian)->format('d F Y') }}</small>
                      </div>
                    </div>
                  </div>
                @empty
                @endforelse
              </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection