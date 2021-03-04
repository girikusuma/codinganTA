@extends('layout/main')

@section('title', 'Info')

@section('container')
<div class="content-wrapper">
    <div class="container pt-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-browsing-tab" data-toggle="pill" href="#v-pills-browsing" role="tab" aria-controls="v-pills-browsing" aria-selected="true">Browsing</a>
                    <a class="nav-link" id="v-pills-searching-tab" data-toggle="pill" href="#v-pills-searching" role="tab" aria-controls="v-pills-searching" aria-selected="false">Searching</a>
                    <a class="nav-link" id="v-pills-rekomendasi-tab" data-toggle="pill" href="#v-pills-rekomendasi" role="tab" aria-controls="v-pills-rekomendasi" aria-selected="false">Rekomendasi</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-browsing" role="tabpanel" aria-labelledby="v-pills-browsing-tab">
                        <h2>Browsing</h2>
                        <p>===== Cara Melakukan Browsing =====</p>
                        <table class="table">
                            <tr>
                                <td>1.</td>
                                <td>Guest user masuk ke halaman penjelajahan sistem.</td>
                            </tr>
                            <tr>
                                <td>2. </td>
                                <td>Pada dashboard  sistem terdapat beberapa hyperlink untuk melakukan penjelajahan sistem.</td>
                            </tr>
                            <tr>
                                <td>3. </td>
                                <td>Guest user memilih salah satu hyperlink yang diinginka.</td>
                            </tr>
                            <tr>
                                <td>4. </td>
                                <td>Sistem menerima request penjelajahan dan melakukan proses penjelajahan.</td>
                            </tr>
                            <tr>
                                <td>5. </td>
                                <td>Sistem menampilkan hasil penjelajahan pada halaman hasil penjelajahan.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-searching" role="tabpanel" aria-labelledby="v-pills-searching-tab">
                        <h2>Searching</h2>
                        <p>===== Cara Melakukan Searching =====</p>
                        <table class="table">
                            <tr>
                                <td>1.</td>
                                <td>Guest user masuk ke halaman pencarian sistem.</td>
                            </tr>
                            <tr>
                                <td>2. </td>
                                <td>Guest user akan memilih output dan input pada isian dropdown, lalu mengeksekusi pencarian pengetahuan dengan melakukan klik pada tombol “Cari”.</td>
                            </tr>
                            <tr>
                                <td>3. </td>
                                <td>Sistem akan menerima request pencarian pengetahuan dan melakukan proses pencarian.</td>
                            </tr>
                            <tr>
                                <td>4. </td>
                                <td>Sistem menampilkan hasil pencarian dan hasil kueri pada halaman hasil pencarian.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-rekomendasi" role="tabpanel" aria-labelledby="v-pills-rekomendasi-tab">
                        <h2>Rekomendasi</h2>
                        <p>===== Cara Melakukan Rekomendasi =====</p>
                        <table class="table">
                            <tr>
                                <td>1.</td>
                                <td>Guest user masuk ke halaman rekomendasi sistem.</td>
                            </tr>
                            <tr>
                                <td>2. </td>
                                <td>Guest user akan memilih cara input motor dan memilih input filter kriteria dibandingkan pada isian dropdown atau memilih motor, lalu mengeksekusi rekomendasi sepeda motor dengan melakukan klik pada tombol “Lihat Rekomendasi”.</td>
                            </tr>
                            <tr>
                                <td>3. </td>
                                <td>Sistem akan menerima request rekomendasi sepeda motor dan melakukan proses rekomendasi.</td>
                            </tr>
                            <tr>
                                <td>4. </td>
                                <td>Sistem menampilkan hasil rekomendasi sepeda motor.</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection