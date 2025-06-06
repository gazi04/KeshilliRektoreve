@extends('layouts.client_app')

@section('title', 'Dokumentet | Universiteti Publik Kadri Zeka')

@section('content')
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="mb-4 text-dark">Dokumente</h2>
        <div class="list-group">
          <a
            href="{{ asset('docs/Statuti_UPKZ_2022.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >Statuti UPKZ 2022</a
          >
          <a
            href="{{ asset('docs/Rregullore_e_studimeve_BA_2023.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >Rregullore e studimeve BA 2023</a
          >
          <a
            href="{{ asset('docs/Kodi_i_Etikes_UPKZ.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >Kodi i Etikes UPKZ</a
          >
          <a
            href="{{ asset('docs/Kerkese_Transfer.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >Kërkesë Transfer</a
          >
          <a
            href="{{ asset('docs/Udhezues_per_pranimin_e_studenteve_ne_studime_BA_2024_2025.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >Udhëzues për pranimin e studentëve në studime BA 2024-2025</a
          >
          <a
            href="{{ asset('docs/Thirrje_per_aplikim_bursave_2024_2025.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >Thirrje për aplikim bursave 2024-2025</a
          >
          <a
            href="{{ asset('docs/KONKURS_per_asistent_2024.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >KONKURS për asistent 2024</a
          >
          <a
            href="{{ asset('docs/KONKURS_per_administrate_2024.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >KONKURS për administratë 2024</a
          >
          <a
            href="{{ asset('docs/KERKESE_Leshim_Pune.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >KËRKESË Lëshim Pune</a
          >
          <a
            href="{{ asset('docs/KERKESE_Pushim.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >KËRKESË Pushim</a
          >
          <a
            href="{{ asset('docs/KERKESE_per_komision_provimit_te_magjistratures.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >KËRKESË për komision provimit të magjistraturës</a
          >
          <a
            href="{{ asset('docs/KERKESE_per_mbrojtjen_e_temes_se_diplomes_master.pdf') }}"
            class="list-group-item list-group-item-action border-secondary border-bottom"
            download
            >KËRKESË për mbrojtjen e temës së diplomës master</a
          >
        </div>
      </div>
    </section>
@endsection
