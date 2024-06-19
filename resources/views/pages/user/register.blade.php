<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Login | Pengaduan Masyarakat</title>

  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')
</head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/">
        Pengaduan Masyarakat
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/">
               Pengaduan Masyarakat
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="/" class="nav-link">
              <span class="nav-link-inner--text">Home</span>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ url('tentang')}}" class="nav-link">
                <span class="nav-link-inner--text">Tentang</span>
            </a>
          </li>
        </ul> --}}
        <hr class="d-lg-none" />

      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-9" style="background: linear-gradient(#e48500, #feb47b);">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Register</h1>
              <p class="text-lead text-white">Silahkan isi form dibawah ini untuk membuat akun baru.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="card bg-secondary border-0">
              <div class="card-header bg-transparent pb-5">       
                <form action="{{ route('user.register-post') }}" role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                          </div>
                          <input type="number" value="{{ old('nik') }}" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="NIK">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="number " value="{{ old('telp') }}" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" placeholder="No Telpon">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                        <select name="jenis_kelamin" class="custom-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Silahkan Pilih Jenis Kelamin Anda</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <!-- <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div> -->
                  <!-- <div class="row my-4">
                    <div class="col-12">
                      <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                        <label class="custom-control-label" for="customCheckRegister">
                          <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                        </label>
                      </div>
                    </div>
                  </div> -->
                  <div class="text-center">
                    <button type="submit"  class="btn btn-warning mt-4">Buat Akun</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                  <a href="{{ url('login')}}" class="text-light"><small>Sudah punya akun?</small></a>
                </div>
              </div>
          </div>
        </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">

          <div class="copyright text-center text-muted">
            &copy; Copyright <strong><span><a href="" target="_blank">Kelompok 11</a></span></strong>. My Web
          </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  @stack('prepend-script')
  @include('includes.admin.script')
  @stack('addon-script')

  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

  <!-- <script>
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });

      $(function() {
        $('#province_id').on('change', function() {
          let province_id = $('#province_id').val();

          console.log(province_id);

          $.ajax({
            type: 'POST',
            url: "{{ route('getkota') }}",
            data: {
            province_id: province_id},
            cache: false,

            success: function(message) {
              $('#regency_id').html(message);
              $('#district_id').html('');
              $('#village_id').html('');
            },
            error: function(data) {
              console.log(`Error on ${data}`);
            }
          });
        });

        $('#regency_id').on('change', function() {
          let regency_id = $('#regency_id').val();
          $.ajax({
            type: 'POST',
            url: "{{ route('getkecamatan') }}",
            data: {regency_id: regency_id},
            cache: false,

            success: function(message) {
              $('#district_id').html(message);
              $('#village_id').html('');
            },

            error: function(data) {
            console.log(`Error on ${data}`);
            }
          });
        });

        $('#district_id').on('change', function() {
          let district_id = $('#district_id').val();
          $.ajax({
            type: 'POST',
            url: "{{ route('getdesa') }}",
            data: {district_id: district_id},
            cache: false,

            success: function(message) {
            $('#village_id').html(message);},
            error: function(data) {
            console.log(`Error on ${data}`);
          }

          })
        })
      })
    });
  </script> -->

</body>

</html>
