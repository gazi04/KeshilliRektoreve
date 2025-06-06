@extends('layouts.client_app')

@section('title', 'Rreth Nesh | Universiteti Publik Kadri Zeka')

@section('content')
<div class="bg-dark text-white text-center py-5" style="background: url('{{ asset('img/slide1.jpeg') }}') center/cover no-repeat;">
    <div class="container">
        <h5>Rreth Nesh</h5>
        <h1 class="display-4 fw-bold">Universiteti Kadri Zeka</h1>
    </div>
</div>

<div class="container py-5">
    <h3 class="border-start border-4 border-primary ps-3 mb-4">Rreth Universitetit Kadri Zeka</h3>
    <div class="row g-4">
        <div class="col-md-6">
            <p>Mirë se vini në Universitetin Kadri Zeka, aty ku dijenia takon frymëzimin dhe rrugëtimi arsimor i çdo individi vlerësohet. Që nga themelimi, universiteti ynë ka qenë një vatër e dijes, inovacionit dhe mundësive për shumë vite.</p>

            <div class="row g-3 mt-4">
                <div class="col-12 d-flex align-items-center p-3 bg-primary text-white">
                    <h4 class="mb-0">20,000</h4>
                    <p class="mb-0 ms-3">studentë të diplomuar</p>
                </div>
                <div class="col-12 d-flex align-items-center p-3 bg-primary text-white">
                    <h4 class="mb-0">16,214</h4>
                    <p class="mb-0 ms-3">Stafi dhe studentët e Kadri Zeka</p>
                </div>
                <div class="col-12 d-flex align-items-center p-3 bg-primary text-white">
                    <h4 class="mb-0">10k</h4>
                    <p class="mb-0 ms-3">TTë diplomuar jashtë Gjilani</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('img/pic6.jpg') }}" class="img-fluid rounded" alt="student">
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6">
            <img src="{{ asset('img/pic5.jpg') }}" class="img-fluid rounded" alt="history">
        </div>
        <div class="col-md-6">
            <h4 class="border-start border-4 border-primary ps-3 mb-3">Historia e Kadri Zeka</h4>
            <p>Universiteti Publik “Kadri Zeka” (UKZ) në Gjilan u themelua me vendimin e Qeverisë së Kosovës më 6 mars 2013 dhe u miratua nga Kuvendi më 30 maj 2013, me qëllim të zhvillimit të arsimit të lartë, kërkimeve shkencore dhe krijimtarisë artistike. Krijimi i këtij universiteti solli mundësi të reja për studentët nga Gjilani, Lugina e Preshevës dhe zonat përreth. Më 13 nëntor 2013, MASHT-i miratoi emrin zyrtar dhe akronimin UKZ.</p>

            <p>Rrënjët e arsimit të lartë në Gjilan datojnë që nga viti 1958, kur filloi përgatitja e mësimdhënësve në shkolla të larta. Në vitin 1973 u themelua Akademia Pedagogjike, e cila nisi punën në vitin 1975 dhe më pas u transformua në Qendër për Arsimin e Lartë të Mësimdhënësve në vitin 1978, duke hapur programe për Gjuhë dhe Letërsi Shqipe, Matematikë-Fizikë dhe programe tjera për përgatitjen e kuadrove arsimore.</p>

            <p>Gjatë viteve 1980/81, kjo qendër u shndërrua në Shkollën e Lartë Pedagogjike “Skënderbeu”, e cila ofroi programe për edukatore të enteve parashkollore dhe për mësim klasor. Më vonë, në vitin 2001, Senati i Universitetit të Prishtinës miratoi planet mësimore sipas Deklaratës së Bolonjës dhe në vitin akademik 2002/2003 filloi funksionimin Fakulteti i Edukimit, duke ndaluar regjistrimet në programet e vjetra të Shkollës së Lartë Pedagogjike.</p>

            <p>Pas themelimit të Universitetit “Kadri Zeka” në vitin 2013, Fakulteti i Edukimit mbeti një njësi përbërëse e rëndësishme e universitetit. Me mbështetjen e MASHT-it, fakulteti vazhdoi zbatimin e programeve moderne për përgatitjen e mësimdhënësve për arsimin fillor dhe të mesëm të ulët, duke ruajtur dhe zhvilluar traditën arsimore të rajonit të Gjilanit dhe më gjerë.</p>


        </div>
    </div>
</div>

<div class="container text-white py-5 bg-primary text-center">
    <div class="row g-4">
        <div class="col-md-4">
            <h3 class="fw-bold mb-1">90%</h3>
            <p>Sukses pas diplomimi</p>
        </div>
        <div class="col-md-4">
            <h3 class="fw-bold mb-1">Top 10</h3>
            <p>Universitetet në Ballkan</p>
        </div>
        <div class="col-md-4">
            <h3 class="fw-bold mb-1">No. 1</h3>
            <p>In The Nation for Standards R&D</p>
        </div>
    </div>
</div>

<div class="container py-5">
    <h3 class="text-center mb-5">Misioni dhe vlerat</h3>
    <div class="row g-4">
        <div class="col-md-6">
            <h5 class="border-start border-4 border-primary ps-2">Diversiteti</h5>
            <p>Vlerësojmë dhe festojmë një mozaik të pasur prej prejardhjeve dhe aspiratave.</p>
            <img src="{{ asset('img/pic6.jpg') }}" class="img-fluid rounded" alt="diversity">
        </div>
        <div class="col-md-6">
            <h5 class="border-start border-4 border-primary ps-2">Ekselenca Akademike</h5>
            <p>Përkushtuar arritjeve të larta akademike dhe hulumtuese në çdo fushë të veprimit.</p>
            <img src="{{ asset('img/slide1.jpeg') }}" class="img-fluid rounded" alt="excellence">
        </div>

    </div>
</div>
@endsection
