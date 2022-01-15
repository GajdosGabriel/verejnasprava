@extends('layouts.app')
{{-- @section('recaptcha') {!! htmlScriptTagJsApi(['action' => 'homepage']) !!} @endsection --}}
@section('page-title', 'Kontakt')

@section('navigation')
<x-navigation.navPublic /> @endsection

@section('content')


    <div class="container mx-auto">
        <h1 class="font-bold text-gray-700 p-6 text-2xl">Kontaktné údaje</h1>
        <div class="row">
            <div class="col-sm-6">

                <div class="md:flex">
                    {{-- Contact Addresse --}}
                    <div class="flex flex-col px-6 py-2">
                        <div class="font-bold mb-3 text-gray-700">Sídlo podnikania</div>
                        <span>Gajdoš Gabriel-Reprezent</span>
                        <span>Sekčovska 19</span>
                        <span>086 41 Raslavice</span>
                        <span>IČO: 14 287 315</span>
                        <span> DIC: 1020747398</span>
                        <span>IC DPH: SK1020747398</span>
                    </div>

                    <div class="flex flex-col px-6 py-2">
                        <div class="font-bold mb-3 text-gray-700">Korenšpondenčná adresa</div>
                        <span>Gajdoš Gabriel-Reprezent</span>
                        <span>Východná 3</span>
                        <span>Trenčín 911 08</span>
                    </div>

                    {{-- Picture of autor --}}
                    <div class="px-6 py-2">
                        <div class="mb-3 font-bold text-gray-700">Autor</div>
                        <img src="https://zastavy-vlajky.sk/images/gabriel.jpg" class="rounded shadow-md mb-1" alt="...">
                        <div class="flex flex-col">
                            <span class="text-secondary text-gray-600 text-sm">Mgr. Gabriel Gajdoš - programátor</span>
                            <span>Tel.: <a href="tel:0905320616">0905 320 616</a></span>
                            <span>Email: <a href="mailto:admin@verejnyportal.eu">admin@verejnyportal.eu</a></span>
                        </div>
                    </div>

                </div>

                <p class="text-gray-600 px-6">Živnostenský list vydaný dňa 19.01.1998 pod. sp.č.: Žo 98/00061/000 reg. č.
                    36/98</p>

            </div>

            {{-- Contact form --}}
            <div class="mt-5 p-6 font-bold text-gray-500 max-w-3xl">
                <h5 class="mb-4">Napíšte nám</h5>

                @include('modul.errors')

                <form method="POST" action="{{ route('home.contactUs') }}">
                    @csrf @method('POST')
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="name">Meno</span>
                        </div>
                        <input type="text" name="name" class="border-2 w-full rounded shadow-md p-2 border-gray-500"
                            placeholder="Meno" value="{{ old('name') }}" aria-describedby="name" />
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="email">Email</span>
                        </div>
                        <input type="email" name="email" class="border-2 w-full rounded shadow-md p-2 border-gray-500"
                            placeholder="Emailový kontakt" value="{{ old('email') }}" required aria-describedby="email" />
                    </div>


                    <div class="input-group mb-3">
                        <textarea class="border-2 w-full rounded shadow-md p-2 border-gray-500" name="body"
                            placeholder="Vaša správa ..." rows="7" required></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="phone">Tel.</span>
                        </div>
                        <input type="text" name="phone" class="border-2 w-full rounded shadow-md p-2 border-gray-500"
                            placeholder="Telefónný kontakt" value="{{ old('phone') }}" required aria-describedby="phone" />
                    </div>

                    <div class="input-group mb-3">
                        <label>Som človek 3+2 = </label>
                        <input class="mx-2 rounded-sm text-gray-800" type="number" name="iamHuman"
                            placeholder="Zadajte číslo 5" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary w-full">Odoslať</button>
                    </div>

                </form>
            </div>




        </div>

    </div>







@endsection
