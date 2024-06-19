@extends('layouts.admin')
@section('title', 'Pengaduan')


@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush
@section('content')
    <!-- Header -->
    <div class="header pb-6" style="background-color: #e48500;">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h1 text-white d-inline-block mb-0">Pengaduan</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col">
            <div class="card">
              <!-- Card header -->
              <div class="card-header border-0">
                <h3 class="mb-0">Data Pengaduan</h3>
              </div>
              <!-- Light table -->
              <div class="table-responsive">
                <table class="table align-items-center table-flush" id="pengaduanTable">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort" data-sort="no">No</th>
                      <th scope="col" class="sort" data-sort="tanggal">Tanggal</th>
                      <th scope="col" class="sort" data-sort="name">Nama</th>
                      <th scope="col" class="sort" data-sort="isi">Isi Laporan</th>
                      <th scope="col" class="sort" data-sort="status">Status</th>
                      <th scope="col" class="sort" data-sort="action">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                      @foreach($pengaduan as $k => $v)

                      <tr>
                        <td class="budget">
                            <span class="text-sm">{{ $k += 1}}</span>
                        </td>
                        <td>
                            <span class="text-sm">{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-m-Y') }}</span>
                        </td>
                        <td><span class="text-sm">{{ $v->user->name}}</span></td>
                        <td>
                            <span class="text-sm">{{ Str::limit($v->isi_laporan, 30)}}</span>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            @if($v->status == '0')
                                <span class="text-sm badge badge-danger">Pending</span>
                            @elseif($v->status == 'proses')
                                <span class="text-sm badge badge-warning">Proses</span>
                            @else
                                <span class="text-sm badge badge-success">Selesai</span>
                            @endif
                          </div>
                        </td>
                        @if ($status == '0')
                            <td>
                                <a href="#" data-id_pengaduan="{{ $v->id_pengaduan }}" class="btn btn-primary pengaduan">Verifikasi</a>
                                <a href="#" data-id_pengaduan="{{ $v->id_pengaduan }}" class="btn btn-danger pengaduanDelete">Hapus</a>
                            </td>
                        @else
                            <td><a href="{{ route('pengaduan.show', $v->id_pengaduan)}}" class="btn btn-info">Lihat</a></td>
                        @endif
                      </tr>

                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- Card footer -->
              <div class="card-footer py-4">
                <nav aria-label="...">
                  <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">
                        <i class="fas fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('addon-script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pengaduanTable').DataTable();
    } );
</script>

<script>
    $(document).on('click', '#del', function(e) {
        let id = $(this).data('userId');
        console.log(id);
    });

    $(document).on('click', '.pengaduan', function (e) {
        e.preventDefault();
        let id_pengaduan = $(this).data('id_pengaduan');
        Swal.fire({
                title: 'Peringatan!',
                text: "Apakah Anda yakin akan memverifikasi pengaduan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('tanggapan') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_pengaduan": id_pengaduan,
                        "status": "proses",
                        "tanggapan": ''
                    },
                    success: function (response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Pengaduan berhasil diverifikasi!",
                                icon: 'success',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }else{
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Pengaduan gagal diverifikasi!",
                            icon: 'error',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Pemberitahuan!',
                    text: "Pengaduan gagal diverifikasi!",
                    icon: 'error',
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',
                });
            }
        });
    });

    $(document).on('click', '.pengaduanDelete', function (e) {
        e.preventDefault();
        let id_pengaduan = $(this).data('id_pengaduan');
        Swal.fire({
                title: 'Peringatan!',
                text: "Apakah Anda yakin akan menghapus pengaduan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ route('pengaduan.delete', 'id_pengaduan') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_pengaduan": id_pengaduan,
                    },
                    success: function (response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Pengaduan berhasil dihapus!",
                                icon: 'success',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }else{
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Pengaduan gagal dihapus!",
                            icon: 'error',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Pemberitahuan!',
                    text: "Pengaduan gagal dihapus!",
                    icon: 'error',
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',
                });
            }
        });
    });



</script>
@endpush
