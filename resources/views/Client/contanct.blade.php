@extends('layouts.client_app')

@section('title', 'Na kontakto | Universiteti Publik Kadri Zeka')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <h2 class="fw-bold mb-4">Na kontaktoni</h2>
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Emri dhe Mbiemri</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" placeholder="Emri Mbiemri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Adresa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="admin@gmail.com">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Numri i Telefonit</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" class="form-control" placeholder="01234567890">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subjekti</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                                <input type="text" class="form-control" placeholder="Shkruaj këtu">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mesazhi juaj</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                            <textarea class="form-control" rows="3" placeholder="Shkruaj mesazhin këtu"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary px-4 py-2">DËRGO MESAZH</button>
                </form>
            </div>

            <div class="col-lg-4">
                <h4 class="fw-bold mb-3">Informatat</h4>
                <p><i class="bi bi-geo-alt"></i> ”Zija Shemsiu” nr.183. 60000 Gjilan</p>
                <p><i class="bi bi-telephone"></i> Tel: +383 280-390-112</p>
                <p><i class="bi bi-telephone-forward"></i> Mob: +383 45-800-025</p>
                <p><i class="bi bi-envelope"></i> e-mail: info@uni-gjilan.net</p>

                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="btn btn-outline-secondary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-secondary"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-outline-secondary"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
