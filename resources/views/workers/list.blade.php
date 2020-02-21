<h2>Zamestnanci</h2>
<button style="margin-top: -19px;" id="novyzamestnanec" class="btn btn-primary pull-right">Pridať zamestnanca</button>
<table class="table">
    <thead>
    <tr class="bg-success">
        <td>Meno</td>
        <td>Priezvisko</td>
        <td>Funkcia</td>
        <td>Email</td>
        <td>Prax</td>
        <td>Nástup</td>
        <td>Akcia</td>
    </tr>
    </thead>
    @forelse($workers as $worker)
        <tr>
            <td>{{ $worker->first_name }}</td>
            <td>{{ $worker->last_name }}</td>
            <td>{{ $worker->position }}</td>
            <td>{{ $worker->email }}</td>
            <td>{{ $worker->date_contract }}</td>
            <td>{{ $worker->date_born }}</td>
            <td>
            <form action="{{ url('delete' , $worker->id) }}" class="post" id="delete-form" method="post">
              @csrf @method('DELETE')
                <a href="#" onclick="get_form(this).submit(); return false"><i @if(Auth::id() === $worker->id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>
            </form>
            </td>
        </tr>
    @empty
        <tbody><tr><td>Bez zamestnancov</td></tr></tbody>
    @endforelse
</table>


@section('script')
    <script>
        function get_form( element )
        {

            var r = confirm("Vymazať položku?");

            while( element )
            {
                element = element.parentNode

                if( element.tagName.toLowerCase() == "form" )
                {

                    if (r == true) {
                        return element
                    } else {
                        return 0;
                    }
                    return element
                }
            }
//        return 0; //error: no form found in ancestors
        }
    </script>
@endsection
