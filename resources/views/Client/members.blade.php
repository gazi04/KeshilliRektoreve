@extends('layouts.client_app')

@section('title', 'Anëtarët e këshillit | Universiteti Publik Kadri Zeka')

@section('content')
    <section class="py-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-3 col-md-6">
            <div class="card text-center h-100 shadow-sm">
              <img
                src="{{ asset('img/pro1.avif') }}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Jeffery Riley"
                style="width: 200px; height: 200px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title mb-1">Jvbknl</h5>
                <p class="text-muted mb-3">Dekan</p>
                <div>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-info fs-5 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-linkedin"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card text-center h-100 shadow-sm">
              <img
                src="{{ asset('img/pro2.jpg') }}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Riley Beata"
                style="width: 200px; height: 200px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title mb-1">Rvuybjk</h5>
                <p class="text-muted mb-3">Dekan</p>
                <div>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-info fs-5 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-linkedin"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card text-center h-100 shadow-sm">
              <img
                src="{{ asset('img/pro1.avif') }}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Kamil Kiwis"
                style="width: 200px; height: 200px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title mb-1">uink</h5>
                <p class="text-muted mb-3">Rektor</p>
                <div>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-info fs-5 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-linkedin"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card text-center h-100 shadow-sm">
              <img
                src="{{ asset('img/pro2.jpg') }}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Kamil Kiwis"
                style="width: 200px; height: 200px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title mb-1">oijlis</h5>
                <p class="text-muted mb-3">Prof</p>
                <div>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" class="text-info fs-5 mx-2"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a href="#" class="text-primary fs-5 mx-2"
                    ><i class="bi bi-linkedin"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
