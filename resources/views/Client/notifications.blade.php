@extends('layouts.client_app')

@section('title', 'Njoftimet | Universiteti Publik Kadri Zeka')

@section('content')
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="mb-4 text-dark text-center">Njoftimet</h2>
        <div class="d-flex justify-content-center gap-3 mb-4">
          <button class="btn btn-outline-primary active" data-filter="all">Të Gjitha</button>
          <button class="btn btn-outline-primary" data-filter="lajm">Lajm</button>
          <button class="btn btn-outline-primary" data-filter="konkurs">Konkurs</button>
          <button class="btn btn-outline-primary" data-filter="komunikate">Komunikatë</button>
        </div>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6 news-card" data-category="lajm">
            <div class="card h-100 shadow-sm border-0">
              <img src="{{ asset('img/pic5.jpg') }}" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title fw-bold">Njoftimi i fundit për regjistrim</h5>
                <p class="card-text text-muted">
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">Publikuar: 2025-05-30</small>
                <a href="{{ url('/njoftim.html?id=1') }}" class="btn btn-sm btn-primary">Lexo më shumë</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 news-card" data-category="konkurs">
            <div class="card h-100 shadow-sm border-0">
              <img src="{{ asset('img/pic6.jpg') }}" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title fw-bold">Konkursi për pozita të reja akademike</h5>
                <p class="card-text text-muted">
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">Publikuar: 2025-05-28</small>
                <a href="{{ url('/njoftim.html?id=2') }}" class="btn btn-sm btn-primary">Lexo më shumë</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 news-card" data-category="komunikate">
            <div class="card h-100 shadow-sm border-0">
              <img src="{{ asset('img/slide1.jpeg') }}" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title fw-bold">Komunikatë për shtyp mbi bashkëpunimin ndërkombëtar</h5>
                <p class="card-text text-muted">
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">Publikuar: 2025-05-25</small>
                <a href="{{ url('/njoftim.html?id=3') }}" class="btn btn-sm btn-primary">Lexo më shumë</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 news-card" data-category="lajm">
            <div class="card h-100 shadow-sm border-0">
              <img src="{{ asset('img/slide2.jpg') }}" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title fw-bold">Dita e Hapur e Universitetit</h5>
                <p class="card-text text-muted">
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">Publikuar: 2025-05-20</small>
                <a href="{{ url('/njoftim.html?id=4') }}" class="btn btn-sm btn-primary">Lexo më shumë</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 news-card" data-category="komunikate">
            <div class="card h-100 shadow-sm border-0">
              <img src="{{ asset('img/slide3.jpg') }}" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title fw-bold">Njoftim për provimet e semestrit të pranverës</h5>
                <p class="card-text text-muted">
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">Publikuar: 2025-05-15</small>
                <a href="{{ url('/njoftim.html?id=5') }}" class="btn btn-sm btn-primary">Lexo më shumë</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
    <script>
      const filterButtons = document.querySelectorAll("[data-filter]");
      const newsCards = document.querySelectorAll(".news-card");

      function filterNews(category) {
        newsCards.forEach((card) => {
          card.style.display =
            category === "all" || card.dataset.category === category
              ? "block"
              : "none";
        });

        filterButtons.forEach((btn) => {
          btn.classList.toggle("active", btn.dataset.filter === category);
        });
      }
      window.addEventListener("DOMContentLoaded", () => {
        const params = new URLSearchParams(window.location.search);
        const filter = params.get("filter") || "all";
        filterNews(filter);
      });
      filterButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
          const selected = btn.getAttribute("data-filter");
          filterNews(selected);
          // Update URL for consistent filtering on refresh/share
          const url = new URL(window.location.href);
          url.searchParams.set('filter', selected);
          window.history.pushState({ path: url.href }, '', url.href);
        });
      });
    </script>
@endpush
