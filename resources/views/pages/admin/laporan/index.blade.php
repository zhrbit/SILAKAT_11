@extends('layouts.admin')

@section('title', 'Laporan')

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <style>
        /* Gaya untuk mengatur ukuran kanvas chart */
        #myChart {
            max-width: 100%;
            max-height: 400px;
            margin: auto;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <div class="header pb-6" style="background-color: #e48500;">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h1 text-white d-inline-block mb-0">Laporan</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <!-- Chart Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Chart Pengaduan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mt-4">
                <!-- Filter Laporan Card -->
                <div class="card">
                    <div class="card-header border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>Filter Laporan</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('laporan.get') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="date_from" class="form-control" placeholder="Tanggal Awal"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $date_from ?? '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="date_to" class="form-control" placeholder="Tanggal Akhir"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $date_to ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Cari Laporan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mt-4">
                <!-- Data Pengaduan Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Pengaduan</h3>
                            </div>
                            <div class="col text-right">
                                @if (!empty($pengaduan))
                                    <form action="{{ route('laporan.export') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="date_from" value="{{ $date_from ?? '' }}">
                                        <input type="hidden" name="date_to" value="{{ $date_to ?? '' }}">
                                        <button type="submit" class="btn btn-info">Export PDF</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Data Pengaduan -->
                       @if(!empty($pengaduan))
                            <table class="table" id="pengaduanTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengaduan</th>
                                        <th>Nama</th>
                                        <th>Judul Laporan</th>
                                        <th>Isi Laporan</th>
                                        <th>Tgl Kejadian</th>
                                        <th>Lokasi Kejadian</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporan as $k => $i)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ \Carbon\Carbon::parse($i->tgl_pengaduan)->format('d-m-Y') }}</td>
                                            <td>{{ $i->user->name ?? 'User tidak ditemukan' }}</td>
                                            <td>{{ $i->judul_laporan }}</td>
                                            <td>{{ $i->isi_laporan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($i->tgl_kejadian)->format('d-m-Y') }}</td>
                                            <td>{{ $i->lokasi_kejadian }}</td>
                                            <td>{{ $i->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('#pengaduanTable').DataTable();
        });

        const ctx = document.getElementById('myChart').getContext('2d');
        const data = @json($pengaduan ?? []);
        const labels = data.map(item => item.judul_laporan);
        const counts = data.map(item => item.total ?? 0);  // Sesuaikan dengan struktur data yang sebenarnya

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '# of Pengaduan',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            boxWidth: 20,
                            padding: 10
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            },
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                }
            }
        });

        @if (session()->has('status'))
            Swal.fire({
                title: 'Pemberitahuan!',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        @endif
    </script>
@endpush