@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <a href="{{ route('balita.index') }}">
                <button class="btn btn-dark btn-sm fw-bold"><i class="bi bi-arrow-left-short"></i> Kembali</button>
            </a>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Tambah Data balita</h5>

                        <form method="POST" action="" id="balitaForm" name="balitaForm">
                            @method('POST')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="id_ortu" class="col-form-label">Nama orang Tua</label>
                                    <select name="id_ortu" id="id_ortu" class="form-select"
                                        aria-label="Default select example" required>
                                        <option selected>Pilih Nama Orang Tua</option>
                                        @foreach ($data['ortu'] as $ortu)
                                            <option value="{{ $ortu->id }}">
                                                {{ $ortu->nama_ayah }} |
                                                {{ $ortu->nama_ibu }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="nama_balita" class="col-form-label">Nama Balita</label>
                                    <input type="text" name="nama_balita" id="nama_balita" class="form-control"
                                        placeholder="Masukkan nama lengkap balita" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="tanggal_lahir_balita" class="col-form-label">Tanggal Lahir
                                        Balita</label>
                                    <input type="date" name="tanggal_lahir_balita" id="tanggal_lahir_balita"
                                        class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir
                                        Balita</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                        placeholder="Tempat lahir" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="jenis_kelamin_balita" class="col-form-label">Jenis Kelamin
                                        Balita</label>
                                    <select name="jenis_kelamin_balita" id="jenis_kelamin_balita" class="form-select"
                                        aria-label="Default select example" required>
                                        <option selected>Pilih jenis kelamin</option>
                                        <option value="Laki-laki">Laki - laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Tambahkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('#balitaForm').submit(function(event) {
                event.preventDefault();

                // Dapatkan CSRF token dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('balita.store') }}',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Sertakan CSRF token di header
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses atau lakukan aksi lainnya
                        // alert(response.message);

                        // Bersihkan form
                        $('#balitaForm')[0].reset();

                        // Redirect ke halaman balita.index
                        window.location.href = '{{ route('balita.index') }}';
                    },
                    error: function(error) {
                        // Tampilkan pesan error jika ada
                        alert('Terjadi kesalahan saat menyimpan data balita.');
                    }
                });
            });
        });
    </script>
@endsection
