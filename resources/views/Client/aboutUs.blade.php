@extends('layouts.client_app')

@section('title', 'Rreth Nesh | Universiteti Publik Kadri Zeka')

@section('content')

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Rreth Nesh</h1>
    </div>
</div>

<section class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Rreth Universitetit Kadri Zeka<span class="text-primary-600">.</span>
            </h2>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Mirë se vini në Universitetin Kadri Zeka, aty ku dijenia takon frymëzimin dhe rrugëtimi arsimor i çdo individi vlerësohet. Që nga themelimi, universiteti ynë ka qenë një vatër e dijes, inovacionit dhe mundësive për shumë vite.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                <div class="bg-primary-600 text-black p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-3xl font-bold">20,000</h4>
                        <p class="text-sm font-light">studentë të diplomuar</p>
                    </div>
                </div>
                <div class="bg-primary-600 text-black p-6 rounded-lg shadow-lg flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-3xl font-bold">16,214</h4>
                        <p class="text-sm font-light">Stafi dhe studentët</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-primary-600 text-black p-6 rounded-lg shadow-lg flex items-center space-x-4">
                 <div class="flex-shrink-0">
                    <svg class="h-10 w-10 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-3xl font-bold">10k</h4>
                    <p class="text-sm font-light">Të diplomuar jashtë Gjilani</p>
                </div>
            </div>
        </div>

        <div class="order-first md:order-last">
            <img src="{{ asset('img/pic6.jpg') }}" class="w-full h-auto object-cover rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-500" alt="student">
        </div>
    </div>
</section>

<section class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <img src="{{ asset('img/pic5.jpg') }}" class="w-full h-auto object-cover rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-500" alt="history">
        </div>
        <div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Historia e Kadri Zeka<span class="text-primary-600">.</span>
            </h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
                Universiteti Publik “Kadri Zeka” (UKZ) në Gjilan u themelua me vendimin e Qeverisë së Kosovës më 6 mars 2013 dhe u miratua nga Kuvendi më 30 maj 2013, me qëllim të zhvillimit të arsimit të lartë, kërkimeve shkencore dhe krijimtarisë artistike. Krijimi i këtij universiteti solli mundësi të reja për studentët nga Gjilani, Lugina e Preshevës dhe zonat përreth. Më 13 nëntor 2013, MASHT-i miratoi emrin zyrtar dhe akronimin UKZ.
            </p>
            <p class="text-gray-600 mb-4 leading-relaxed">
                Rrënjët e arsimit të lartë në Gjilan datojnë që nga viti 1958, kur filloi përgatitja e mësimdhënësve në shkolla të larta. Në vitin 1973 u themelua Akademia Pedagogjike, e cila nisi punën në vitin 1975 dhe më pas u transformua në Qendër për Arsimin e Lartë të Mësimdhënësve në vitin 1978, duke hapur programe për Gjuhë dhe Letërsi Shqipe, Matematikë-Fizikë dhe programe tjera për përgatitjen e kuadrove arsimore.
            </p>
            <p class="text-gray-600 mb-4 leading-relaxed">
                Gjatë viteve 1980/81, kjo qendër u shndërrua në Shkollën e Lartë Pedagogjike “Skënderbeu”, e cila ofroi programe për edukatore të enteve parashkollore dhe për mësim klasor. Më vonë, në vitin 2001, Senati i Universitetit të Prishtinës miratoi planet mësimore sipas Deklaratës së Bolonjës dhe në vitin akademik 2002/2003 filloi funksionimin Fakulteti i Edukimit, duke ndaluar regjistrimet në programet e vjetra të Shkollës së Lartë Pedagogjike.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Pas themelimit të Universitetit “Kadri Zeka” në vitin 2013, Fakulteti i Edukimit mbeti një njësi përbërëse e rëndësishme e universitetit. Me mbështetjen e MASHT-it, fakulteti vazhdoi zbatimin e programeve moderne për përgatitjen e mësimdhënësve për arsimin fillor dhe të mesëm të ulët, duke ruajtur dhe zhvilluar traditën arsimore të rajonit të Gjilanit dhe më gjerë.
            </p>
        </div>
    </div>
</section>

<section class="bg-primary-600 text-black py-16">
    <div class="container mx-auto px-4 text-center">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center">
                <span class="text-5xl lg:text-6xl font-extrabold mb-2">90%</span>
                <p class="text-xl font-light">Sukses pas diplomimit</p>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-5xl lg:text-6xl font-extrabold mb-2">Top 10</span>
                <p class="text-xl font-light">Universitetet në Ballkan</p>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-5xl lg:text-6xl font-extrabold mb-2">No. 1</span>
                <p class="text-xl font-light">In The Nation for Standards R&D</p>
            </div>
        </div>
    </div>
</section>

<section class="container mx-auto px-4 py-16">
    <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">
        Misioni dhe Vlerat<span class="text-primary-600">.</span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden group">
            <img src="{{ asset('img/pic6.jpg') }}" class="w-full h-80 object-cover transform transition-transform duration-500 group-hover:scale-105" alt="diversity">
            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Diversiteti</h3>
                <p class="text-gray-600">
                    Vlerësojmë dhe festojmë një mozaik të pasur prej prejardhjeve dhe aspiratave.
                </p>
            </div>
        </div>
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden group">
            <img src="{{ asset('img/slide1.jpeg') }}" class="w-full h-80 object-cover transform transition-transform duration-500 group-hover:scale-105" alt="excellence">
            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Ekselenca Akademike</h3>
                <p class="text-gray-600">
                    Përkushtuar arritjeve të larta akademike dhe hulumtuese në çdo fushë të veprimit.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
