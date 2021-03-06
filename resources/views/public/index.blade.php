@extends('layouts.app')
@section('page-title', 'Zoznam dokladov')

@section('navigation') <x-navigation.navPublic /> @endsection


@section('content')



    <div class="container mx-auto md:flex">

        {{-- Image--}}
{{--        <div class="w-64 h-64 bg-cover" style="background-image: url({{ asset('image/dievca-left.png') }})" title="Woman holding a mug">--}}
        <div>
            <img class="-mt-4 -mb-12" src="{{ asset('image/dievca-left.png') }}" title="Verejný portál, správovanie pre úspešných.">
        </div>

            <div class="mb-6 p-6 flex flex-col items-center justify-center">
                <div class="text-gray-900 font-semibold text-2xl mt-5 md:text-3xl  mb-2 text-center">Správa obecného zastupiteľstva</div>
                <div class="flex flex-col text-gray-700 font-semibold text-lg">

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Výtváranie zápisov
                    </div>

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Evidencia poslancov
                    </div>

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Elektronické hlasovanie
                    </div>

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Hlasovanie na diaľku
                    </div>

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Operatívne hlasovanie
                    </div>

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Príprava návrhov
                    </div>

                    <div class="flex items-center mb-1">
                        <svg class="h-5 w-5 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Rozosielanie pozvánok
                    </div>

                </div>
            <a class="border-2 rounded-md px-4 py-2 hover:bg-blue-800 bg-blue-500 text-white mt-6 cursor-pointer" href="/register">Rýchla registrácia</a>
                <span class="text-xs text-gray-700 mt-1">Registrácia bez poplatkov</span>
            </div>



    </div>


{{--    @include('layouts.banner-top')--}}
{{--<div class="md:flex">--}}
{{--    <img class="w-auto md:-mt-4 md:-mb-24" src="{{ asset('image/dievca-left.png') }}">--}}

{{--    <div class="flex flex-col items-center p-2 md:justify-center text-gray-700">--}}
{{--        <div class="text-center mb-3 md:text-2xl">Obdržíte certifikát ktorý potvrdzuje že zverejňujete informácie ktoré spĺňujú požiadavky zákona</div>--}}

{{--        <a href="{{ url('/register') }}" class="btn btn-primary text-center shadow-lg">Začať zdarma bez záväzkov</a>--}}
{{--        <p><small class="text-gray-600">Registrácia bez poplatkov</small></p>--}}

{{--    </div>--}}
{{--</div>--}}




    <div class="w-full p-6 bg-blue-100">

        <div class="w-48 mx-auto pt-6 border-b-2 border-teal-500 text-center text-2xl text-blue-700">BEZ ZÁVEZKOV</div>
        <div class="p-2 text-center text-lg text-gray-700">Jednou bezplatnou registráciou získate riešenie pre správu obecného zastupiteľstva <br /> a prístup k zverejňovaniu zmlúv a faktúr.
            <span class="font-semibold">Registrácia zadarmo.</span></div>
        <div class="flex justify-center flex-wrap p-6">

            <div class="w-48 h-64 m-5 bg-white shadow-lg text-center">
                <div class="flex items-center w-48 h-20 bg-teal-500">
                    <i class="fas fa-bezier-curve fa-3x mx-auto text-white">Program 1</i>
                </div>
                <p class="mx-2 py-2 border-b-2 text-center text-gray-700 font-semibold uppercase">Zverejňovanie dokladov</p>
                <p class="p-2 text-sm text-gray-700">Zverejňovanie zmlúv a faktúr.</p>
                <a href="register" class="p-2 text-sm text-gray-700 text-center cursor-pointer text-blue-700 font-semibold">Pokračovať</a>
            </div>

            <div class="w-48 h-64 m-5 bg-white shadow-lg text-center">
                <div class="flex items-center w-48 h-20 bg-teal-500">
                    <i class="fas fa-bezier-curve fa-3x mx-auto text-white">Program 2</i>
                </div>
                <p class="mx-2 py-2 border-b-2 text-gray-700 font-semibold uppercase">Obecné zastupiteľstvo</p>
                <p class="p-2 text-sm text-gray-700">Nástroj pre správu obecného zastupiteľstva.</p>
                <a href="register" class="p-2 text-sm text-gray-700 text-center cursor-pointer text-blue-700 font-semibold">Pokračovať</a>
            </div>
{{--            ...--}}
        </div>
        <div class="text-center">
            <a class="btn btn-primary mb-5" href="/register">Jedna registrácia 2x služby</a>
        </div>

    </div>

{{--    @include('layouts.banner-middle')--}}


    <div class="container mx-auto ">

        <h3 class="text-center mt-5 text-3xl text-gray-500" >Posledné doklady</h3>

{{--        @include('modul.categoryList')--}}
        <table-front-post></table-front-post>
{{--        <accordion-table></accordion-table>--}}
{{--        @include('post.post-table-predna')--}}
        </div>

        {{--    {!! $posts ->render() !!}--}}



@endsection
