@extends('layouts.app')
@section('recaptcha') {!! htmlScriptTagJsApi(['action' => 'homepage']) !!} @endsection
@section('page-title', 'Kontakt')

@section('navigation') <x-navigation /> @endsection

@section('content')


        <div class="col-md-12">
            <h1 class="mb-4">Napíšte nám</h1>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">

                        {{-- Contact Addresse--}}
                        <div class="col-md-7 col-xs-12">
                            <h4>Korenšpondencia</h4>
                            <p style="text-align: left;"><strong>Gajdoš Gabriel-Reprezent<br></strong>Východná 3<br>Trenčín 911 08</p>

                            <h4>Sídlo podnikania:</h4>
                            <p style="text-align: left;"><strong>Gajdoš Gabriel-Reprezent</strong><br>Sekčovska 19<br>086 41 Raslavice</p>
                            <p style="text-align: left;">IČO: 14 287 315<br>
                                DIC: 1020747398<br>
                                IC DPH: SK1020747398<br>
                            </p>

                            <p>Živnostenský list vydaný dňa 19.01.1998 pod. sp.č.: Žo 98/00061/000 reg. č. 36/98</p>

                        </div>

                        {{-- Picture of autor--}}
                        <div class="col-md-5 col-xs-12">
                            <img src="https://zastavy-vlajky.sk/images/gabriel.jpg" class="card-img-top" alt="...">
                            <div class="">
                                <p class="">
                                    <small>Programátor projektu</small><br>
                                    <strong>Tel.:  <a href="tel:0905320616">0905 320 616</a></strong><br>
                                    <strong>Email: <a href="mailto:admin@verejnyportal.eu">admin@verejnyportal.eu</a></strong>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Contact form--}}
                <div class="col-md-6">
                    <h5 class="mb-4">Napíšte nám</h5>
                    <form method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="name">Meno</span>
                            </div>
                            <input type="text" name="name" class = "form-control"  placeholder="Meno" value="{{ old('name') }}" aria-describedby="name"/>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email">Email</span>
                            </div>
                            <input type="email" name="email" class = "form-control"  placeholder="Emailový kontakt" value="{{ old('email') }}" required aria-describedby="email"/>
                        </div>


                        <div class="input-group mb-3">
                            <textarea class="form-control" name="text" placeholder="Vaša správa ..." rows="7" required></textarea>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary float-right">Odoslať</button>
                        </div>

                    </form>
                </div>




            </div>

        </div>







@endsection
