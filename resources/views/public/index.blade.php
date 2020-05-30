@extends('layouts.app')
@section('page-title', 'Zoznam dokladov')

@section('navigation') <x-navigation /> @endsection

@section('content')



    <div class="container md:flex">
        {{-- Image--}}
{{--        <div class="w-64 h-64 bg-cover" style="background-image: url({{ asset('image/dievca-left.png') }})" title="Woman holding a mug">--}}
        <img class="sm:w-1/3" src="{{ asset('image/dievca-left.png') }}" title="Woman holding a mug">
        </img>

            <div class="mb-8 p-6 flex flex-col items-center justify-center">
                <div class="text-gray-900 text-3xl mb-2">Can coffee make you a better developer?</div>
                <p class="text-gray-700 text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
            <button class="btn btn-primary mt-5">Registrácia</button>
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
        <div class="w-48 mx-auto pt-6 border-b-2 border-orange-500 text-center text-2xl text-blue-700">BEZ ZÁVEZKOV</div>
        <div class="p-2 text-center text-lg text-gray-700">Najlepšie webové riešenie. Registrácie zadarmo.</div>
        <div class="flex justify-center flex-wrap p-10">

            <div class="relative w-48 h-64 m-5 bg-white shadow-lg">
                <div class="flex items-center w-48 h-20 bg-orange-500">
                    <i class="fas fa-bezier-curve fa-3x mx-auto text-white"></i>
                </div>
                <p class="mx-2 py-2 border-b-2 text-center text-gray-700 font-semibold uppercase">UI Design</p>
                <p class="p-2 text-sm text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac est massa.</p>
                <div class="absolute right-0 bottom-0 w-8 h-8 bg-gray-300 hover:bg-orange-300 text-center cursor-pointer">
                    <i class="fas fa-chevron-right mt-2 text-orange-500"></i>
                </div>
            </div>

            <div class="relative w-48 h-64 m-5 bg-white shadow-lg">
                <div class="flex items-center w-48 h-20 bg-orange-500">
                    <i class="fas fa-bezier-curve fa-3x mx-auto text-white"></i>
                </div>
                <p class="mx-2 py-2 border-b-2 text-center text-gray-700 font-semibold uppercase">UI Design</p>
                <p class="p-2 text-sm text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac est massa.</p>
                <div class="absolute right-0 bottom-0 w-8 h-8 bg-gray-300 hover:bg-orange-300 text-center cursor-pointer">
                    <i class="fas fa-chevron-right mt-2 text-orange-500"></i>
                </div>
            </div>
            ...
        </div>
    </div>

{{--    @include('layouts.banner-middle')--}}


    <div class="container mx-auto ">

        <h3 class="text-center mt-5 text-3xl text-gray-500">Publikované doklady</h3>

{{--        @include('modul.categoryList')--}}
{{--        @include('post.post-table-predna')--}}
        </div>

        {{--    {!! $posts ->render() !!}--}}



@endsection
