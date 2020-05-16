@extends('layouts.app')

@section('page-title', 'Zverejňovanie dokumentov')

@section('navigation')
    @include('public.navigation')
@endsection

@section('content')

{{--    @include('layouts.banner-top')--}}
{{--    @include('layouts.banner-middle')--}}

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 offset-lg-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Zverejňujte faktúry</h4>
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-sm float-left">Začať zdarma</a>
                    </div>

                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="https://www.youtube.com/embed/sXCDTYenouQ" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center my-5 d-flex justify-content-center flex-column">
               <div><a href="{{ url('/register') }}" class="btn btn-primary">Začať zdarma bez záväzkov</a></div>
                <small class="text-secondary">Registrácia bez poplatkov</small>
            </div>
        </div>



        <h3 class="text-center mt-5">Zverejnené doklady</h3>
{{--        @include('modul.categoryList')--}}
        @include('post.post-table-predna')


        {{--    {!! $posts ->render() !!}--}}
    </div>


@endsection
