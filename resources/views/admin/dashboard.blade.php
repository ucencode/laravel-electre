@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Dashboard</h1>
    @include('partials.flash')
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Sistem Pendukung Keputusan Pemilihan Prioritas Pengembangan Layanan Pada Perusahaan Pitcar Service Menggunakan Metode ELECTRE (Elimination and Choice Translation Realite)</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text text-justify">
                            Metode ELECTRE merupakan salah satu metode analisis untuk pengambilan keputusan menggunakan multi-kriteria,
                            berasal dari Eropa pada tahun 1960-an. ELECTRE sendiri merupakan singkatan dari Elimination Et Choix
                            Traduisant la Realité, yang dalam bahasa Inggris berarti Elimination and Choice Expressing Reality. Metode ELECTRE
                            memungkinkan untuk menentukan apakah suatu alternatif mendominasi
                            alternatif lain dengan membandingkan setiap kriteria secara individual.
                            Suatu alternatif dapat dikatakan mendominasi alternatif lain, jika
                            memiliki nilai yang lebih dari alternatif lain. Dengan mengunakan
                            metode pemeringkatan ini, diharapkan penilaian terhadap layanan bengkel
                            mobil dapat dilakukan dengan lebih akurat.
                            </p>
                            <p class="card-text text-justify">
                            Melalui metode ELECTRE,
                            penilaian dapat didasarkan pada perbandingan langsung antara
                            alternatif-alternatif layanan, dengan mempertimbangkan kriteria yang
                            telah ditetapkan. Hal ini memungkinkan untuk menghasilkan hasil
                            pemeringkatan yang objektif dan membantu bengkel mobil dalam
                            menentukan dan memilih layanan yang menjadi prioritas berdasarkan
                            penilaian multi-kriteria. Dengan demikian, bengkel mobil dapat
                            memaksimalkan potensi bisnis dengan meningkatkan kepuasan
                            pelanggan, dan memperkuat posisi mereka dalam pasar otomotif yang
                            kompetitif.
                            </p>
                            <hr>
                            <p class="card-text">
                                Langkah Penyelesaian Metode Electre adalah sebagai berikut:
                            </p>
                            <ol type="1">
                                <li>Penentuan matriks keputusan</li>
                                <li>Normalisasi matriks Keputusan (R)</li>
                                <li>Matriks preferensi (V)</li>
                                <li>Menentukan Concordance Index (Ckl)</li>
                                <li>Menentukan Disccordance Index (Dkl)</li>
                                <li>Membentuk matriks Concordance (C)</li>
                                <li>Membentuk matriks Discordance (D)</li>
                                <li>Membentuk matriks dominan Concordance (F)</li>
                                <li>Membentuk matriks dominan Concordance (G)</li>
                                <li>Membentuk matriks dominan Agregasi (E)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
