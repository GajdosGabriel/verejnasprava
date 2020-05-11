@extends('layouts.app')

@section('navigation')
    @include('user.navigation')
@endsection

@section('content')


    <div class="row">
        <div class="col-md-8">
            <h2>User Home</h2>
            <div class="alert alert-primary" role="alert" class="accordion" id="accordionExample">
                Zverejňovať <a href="#" class="alert-link">zmlúvy a faktúry</a>!

                <button class="btn btn-link btn-sm" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    open
                </button>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

            <div class="alert alert-secondary" role="alert">
                Vystavovať <a href="#" class="alert-link">objednávky!</a>
            </div>
            <div class="alert alert-success" role="alert">
                Evidencia <a href="#" class="alert-link">zamestnancov!</a>
            </div>
            <div class="alert alert-danger" role="alert">
                Evidencia <a href="#" class="alert-link">dane a poplatky!</a>
            </div>
        </div>

        <div class="col-md-4">
            <h2>User Home</h2>
            <div class="alert alert-primary" role="alert">
                Zverejňovať <a href="#" class="alert-link">zmlúvy a faktúry</a>!
            </div>
            <div class="alert alert-secondary" role="alert">
                Vystavovať <a href="#" class="alert-link">objednávky!</a>
            </div>
            <div class="alert alert-success" role="alert">
                Evidencia <a href="#" class="alert-link">zamestnancov!</a>
            </div>
            <div class="alert alert-danger" role="alert">
                Evidencia <a href="#" class="alert-link">dane a poplatky!</a>
            </div>
        </div>
    </div>


@endsection

