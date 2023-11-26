@extends('layout.admin')

@section('title', 'Tutorial')

@section('content')
<div class="container-fluid px-4 mb-4">
    <h3 class="mt-4 mb-3">Tutorial Penggunaan Website</h3>
    @include('partials.flash')
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card border-0 rounded-0">
                    <div class="card-header bg-red-200 border-0 rounded-0 text-white">
                        <h5>Berikut adalah langkah-langkah mudah untuk memanfaatkan fitur-fitur Sistem Pendukung Keputusan Metode Electre:</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <dt>Langkah 1: Mengelola Alternatif<br></dt>
                            <p class="card-text text-justify">
                                Alternatif adalah opsi yang tersedia dalam sistem pendukung keputusan.
                                Untuk menambahkan alternatif baru, klik pada menu 'Alternatif' dan pilih 'Tambah'.
                                Isi detail yang diperlukan dan klik 'Simpan'. Voila! Alternatif baru Anda telah
                                ditambahkan. <br>Untuk mengedit atau menghapus alternatif, klik pada alternatif
                                yang ingin Anda ubah, pilih 'Edit' atau 'Hapus' sesuai kebutuhan Anda, lakukan
                                perubahan yang diinginkan, dan jangan lupa untuk menyimpan perubahan Anda.</p>
                            <dt>Langkah 2: Mengatur Kriteria<br></dt>
                            <p class="card-text text-justify">
                                Kriteria adalah parameter yang digunakan untuk mengevaluasi alternatif. Untuk
                                menambahkan kriteria baru, klik pada menu 'Kriteria' dan pilih 'Tambah'.
                                Isi detail yang diperlukan dan klik 'Simpan'. Kriteria baru Anda telah siap!
                                <br>Untuk mengedit atau menghapus kriteria, klik pada kriteria yang ingin
                                Anda ubah, pilih 'Edit' atau 'Hapus' sesuai kebutuhan Anda, lakukan perubahan
                                yang diinginkan, dan jangan lupa untuk menyimpan perubahan Anda.
                            </p>
                            <dt>Langkah 3: Memasukkan Nilai<br></dt>
                            <p class="card-text text-justify">
                                Nilai adalah penilaian untuk setiap alternatif berdasarkan kriteria yang telah
                                ditentukan. Untuk memasukkan nilai, klik pada menu 'Nilai' dan pilih ikon 'Edit'.
                                Isi Nilai untuk setiap alternatif dan kriteria, kemudian klik 'Simpan'.
                                Nilai Anda telah berhasil diinputkan!
                            </p>
                            <dt>Langkah 4: Melihat Hasil<br></dt>
                            <p class="card-text text-justify">
                                Setelah memasukkan semua alternatif, kriteria, dan nilai, Anda dapat melihat hasil
                                dari sistem pendukung keputusan. Klik pada menu 'Hasil' untuk melihat
                                rangking dari setiap alternatif berdasarkan nilai dan kriteria yang telah Anda masukkan.
                            </p>
                            <hr>
                            <p class="card-text text-justify">
                                Dengan menginputkan Alternatif, Kriteria, dan Nilai, sistem ini akan
                                secara otomatis menghitung dan memberikan Anda hasil perbandingan yang
                                objektif dan mudah dipahami. Mulailah sekarang dan buatlah keputusan yang
                                lebih baik dengan website ini!"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
