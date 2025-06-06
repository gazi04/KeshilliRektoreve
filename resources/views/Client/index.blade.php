@extends('layouts.client_app')

@section('title', 'Ballina - Universiteti Publik Kadri Zeka')

@section('content')
    <div class="my-3"></div>
    <div class="my-3"></div>
    <div class="my-3"></div>
    <div class="my-3"></div>
    <div class="my-3"></div>

    <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner" id="slider-container"></div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#mainSlider"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#mainSlider"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="container mt-5"> {{-- Added container and mt-5 for spacing --}}
        <div class="row text-center mb-4 g-4"> {{-- Added g-4 for consistent spacing --}}
            <div class="col-md-3">
                <div class="card bg-light border-0 shadow-sm h-100"> {{-- Added h-100 for equal height cards --}}
                    <div class="card-body">
                        <h5 class="card-title text-primary">12</h5>
                        <p class="card-text">Facultete</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">5,000+</h5>
                        <p class="card-text">Studentë aktiv</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">20</h5>
                        <p class="card-text">Konferenca këtë vit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">10+</h5>
                        <p class="card-text">Kërkime shkencores</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="py-5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="display-5 fw-bold mb-0">
            Lajmet<span class="text-primary">.</span>
          </h2>
          <a
            href="{{ url('/njoftime.html') }}" {{-- Use url() helper --}}
            class="text-primary fw-semibold text-decoration-none"
          >
            Shiko të gjitha <i class="bi bi-arrow-right"></i> {{-- Assuming Bootstrap Icons are available --}}
          </a>
        </div>

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="row g-0 bg-light rounded overflow-hidden shadow-sm">
              <div class="col-md-6">
                <img
                  src="{{ asset('img/pic6.jpg') }}" {{-- Use asset() helper --}}
                  loading="lazy"
                  alt="Main News"
                  class="img-fluid h-100 w-100 object-fit-cover"
                />
              </div>
              <div
                class="col-md-6 p-4 d-flex flex-column justify-content-between"
              >
                <div>
                  <span class="badge bg-primary mb-2">Inovacioni</span>
                  <h3 class="fw-bold">
                    Universiteti Kadri Zeka it aspernatur aut odit aut fugit,
                    sed quia conse
                  </h3>
                  <p class="text-muted small">
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
                    odit aut fugit, sed quia consequuntur magni dolores eos qui
                    ratione voluptatem sequi nesciunt.
                  </p>
                </div>
                <a
                  href="{{ url('/njoftim.html?id=1') }}" {{-- Use url() helper --}}
                  class="fw-semibold text-primary text-decoration-none"
                >
                  Lexo më shumë <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="row g-3">
              <div class="col-12 d-flex">
                <img
                  src="{{ asset('img/slide1.jpeg') }}" {{-- Use asset() helper --}}
                  alt="News"
                  loading="lazy"
                  class="flex-shrink-0 rounded me-3"
                  width="100"
                  height="100"
                  style="object-fit: cover;" {{-- Added object-fit for consistent sizing --}}
                />
                <div>
                  <h6 class="fw-bold mb-1">
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatu
                  </h6>
                  <p class="small text-muted mb-0"> {{-- Added mb-0 --}}
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur...
                  </p>
                </div>
              </div>

              <div class="col-12 d-flex">
                <img
                  src="{{ asset('img/pic6.jpg') }}" {{-- Use asset() helper --}}
                  alt="News"
                  loading="lazy"
                  class="flex-shrink-0 rounded me-3"
                  width="100"
                  height="100"
                  style="object-fit: cover;"
                />
                <div>
                  <h6 class="fw-bold mb-1">
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatu
                  </h6>
                  <p class="small text-muted mb-0">
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur...
                  </p>
                </div>
              </div>

              <div class="col-12 d-flex">
                <img
                  src="{{ asset('img/slide1.jpeg') }}" {{-- Use asset() helper --}}
                  alt="News"
                  loading="lazy"
                  class="flex-shrink-0 rounded me-3"
                  width="100"
                  height="100"
                  style="object-fit: cover;"
                />
                <div>
                  <h6 class="fw-bold mb-1">
                    HNemo enim ipsam voluptatem quia voluptas sit aspernatu
                  </h6>
                  <p class="small text-muted mb-0">
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur...
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="members" class="py-5 bg-white">
      <div class="container">
        <h2 class="mb-4 text-black">Anëtarët e Këshillit</h2>
        <div class="row text-center g-4" id="members-container"></div>
      </div>
    </section>

    <section id="conferences" class="py-5 bg-primary text-white">
      <div class="container">
        <h2 class="mb-4 text-white">Konferenca</h2>

        <div class="row border-top border-white border-2 pt-3 g-3">

          <div class="col-md-6 col-lg-3">
            <div class="d-flex flex-column h-100 ps-3 pe-3 border-end border-white">
              <small class="text-light">Arsim</small>
              <div class="d-flex justify-content-between">
                <a href="{{ url('/konferenca-2024.html') }}" class="text-white text-decoration-none fw-semibold">Konferenca Arsimore</a>
                <span class="badge bg-light text-primary ms-2">2025-05-10</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="d-flex flex-column h-100 ps-3 pe-3 border-end border-white">
              <small class="text-light">Akademike</small>
              <div class="d-flex justify-content-between">
                <a href="{{ url('/konferenca-2024.html') }}" class="text-white text-decoration-none fw-semibold">Seminari Akademik</a>
                <span class="badge bg-light text-primary ms-2">2024-10-22</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="d-flex flex-column h-100 ps-3 pe-3 border-end border-white">
              <small class="text-light">Studentor</small>
              <div class="d-flex justify-content-between">
                <a href="{{ url('/konferenca-2023.html') }}" class="text-white text-decoration-none fw-semibold">Forumi Studentor</a>
                <span class="badge bg-light text-primary ms-2">2025-03-01</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="d-flex flex-column h-100 ps-3 pe-3 border-end border-white border-lg-0">
              <small class="text-light">Shkencor</small>
              <div class="d-flex justify-content-between">
                <a href="{{ url('/konferenca-2023.html') }}" class="text-white text-decoration-none fw-semibold">Simpoziumi Shkencor</a>
                <span class="badge bg-light text-primary ms-2">2023-11-17</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="documents" class="py-5 bg-white">
      <div class="container">
        <h2 class="mb-4 text-dark">Dokumente</h2>
        <div class="list-group">
          <a href="{{ asset('docs/Kerkese_Transfer.pdf') }}" class="list-group-item list-group-item-action border-secondary border-bottom" download>
            Formular Aplikimi Bachelor
          </a>
          <a href="{{ asset('docs/Kerkese_Transfer.pdf') }}" class="list-group-item list-group-item-action border-secondary border-bottom" download>
            Orari i Provimeve - Janar 2025
          </a>
          <a href="{{ asset('docs/Kerkese_Transfer.pdf') }}" class="list-group-item list-group-item-action border-secondary border-bottom" download>
            Rregullorja Akademike
          </a>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
    <script>
      const sliderImages = [
        {
          src: "{{ asset('img/slide1.jpeg') }}",
          title: "Mirë se vini në Këshillin e Rektorëve",
          subtitle: "Bashkë për një të ardhme më të mirë arsimore",
        },
        {
          src: "{{ asset('img/slide1.jpeg') }}",
          title: "Konferenca Kombëtare 2025",
          subtitle: "Për një vizion të përbashkët në arsim",
        },
        {
          src: "{{ asset('img/slide1.jpeg') }}",
          title: "Mbledhja e Radhës",
          subtitle: "Diskutime për strategjitë akademike",
        },
      ];
      const news = [
        {
          title: "Takimi i Radhës",
          text: "Takim me rektorët publik.",
          img: "{{ asset('img/slide3.jpg') }}",
        },
        {
          title: "Konferenca",
          text: "Diskutim mbi politikat arsimore.",
          img: "{{ asset('img/slide2.jpg') }}",
        },
        {
          title: "Deklaratë",
          text: "Prioritetet akademike 2025.",
          img: "{{ asset('img/slide2.jpg') }}",
        },
      ];
      const members = [
        {
          name: "Prof. Dr. Amir Asllani",
          position: "Rektor",
          img: "{{ asset('img/pro1.avif') }}",
        },
        { name: "Prof. Dr. Amir Asllani", position: "Anëtar", img: "{{ asset('img/pro2.jpg') }}" },
        { name: "Prof. Dr. Amir Asllani", position: "Anëtar", img: "{{ asset('img/pro1.avif') }}" },
        {
          name: "Prof. Dr. Amir Asllani",
          position: "Anëtar",
          img: "{{ asset('img/pro4.jpg') }}",
        },
      ];
      const conferences = [
        { title: "Konferenca Arsimore 2025", date: "2025-05-10" },
        { title: "Forumi Arsimor", date: "2025-09-21" },
      ];
      const documents = [
        { title: "Statuti", url: "#" },
        { title: "Strategjia 2024–2028", url: "#" },
      ];

      function renderSlider() {
        const container = document.getElementById("slider-container");
        sliderImages.forEach((item, i) => {
          container.innerHTML += `
        <div class="carousel-item${i === 0 ? " active" : ""}">
          <img src="${
            item.src
          }" class="d-block w-100" style="height:450px;object-fit:cover" alt="Slide ${
            i + 1
          }">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
            <h5 class="text-white">${item.title}</h5>
            <p class="text-light">${item.subtitle}</p>
          </div>
        </div>
      `;
        });
      }

      // The original HTML had a news section but no 'news-container' for dynamic rendering,
      // only static content. Keeping the renderNews function for completeness, but it won't
      // dynamically populate the main news section as per the original HTML structure.
      // If you intend to dynamically populate the main news section, you'd need to modify the HTML.
      function renderNews() {
        // const container = document.getElementById("news-container"); // This ID is not in the HTML
        // news.forEach((item) => { ... });
      }

      function renderMembers() {
        const container = document.getElementById("members-container");
        members.forEach((member) => {
          container.innerHTML += `
        <div class="col-md-3">
          <div class="card shadow-sm border-0 h-100"> {{-- Added h-100 for equal height cards --}}
            <img src="${member.img}" class="card-img-top" alt="${member.name}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title fw-bold">${member.name}</h5> {{-- Added fw-bold --}}
              <p class="card-text text-muted mb-0">${member.position}</p> {{-- Added mb-0 --}}
            </div>
          </div>
        </div>
      `;
        });
      }

      // The conferences section is static in the HTML, not dynamically rendered by JS in the original file.
      function renderConferences() {
        // const list = document.getElementById("conferences-list"); // This ID is not in the HTML
        // conferences.forEach((conf) => { ... });
      }

      // The documents section is static in the HTML, not dynamically rendered by JS in the original file.
      function renderDocuments() {
        // const list = document.getElementById("documents-list"); // This ID is not in the HTML
        // documents.forEach((doc) => { ... });
      }

      renderSlider();
      renderMembers();
      // renderNews(); // Uncomment if you add a container for dynamic news rendering
      // renderConferences(); // Uncomment if you make this section dynamic
      // renderDocuments(); // Uncomment if you make this section dynamic
    </script>
@endpush
