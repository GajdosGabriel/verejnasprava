<table class="table table-bordered table-inverse table-hover">
    <thead>
    <tr class="alert-info">
        <th>Dátum</th>
        <th>Popis</th>
        <th>Kategória</th>
        <th>Dodávateľ</th>
        <th>Cena spolu</th>
        <th>Súbor</th>
        <th>Int. číslo</th>
        <th>Panel</th>
    </tr>
    </thead>
    <tbody>
    <tr>


        @forelse($posts as $post)
            <td>{{ $post->date_in }}</td>
            <td>{{ $post->name }}</td>
            <td>{{ $post->category->name }}</td>
            <td>{{ $post->contact->name }}</td>
            <td>{{ number_format($post->price, 2, ',', ' ') }} Eu</td>
            <td>
            @forelse($post->file as $file)
              <a target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
            @empty
                Bez prílohy
            @endforelse

            <td>{{ $post->int_number }}</td>

            {{--@can( 'update', $post)--}}
            <td class="d-flex justify-content-center">
                <a class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Akcia
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{ route('org.post.edit', [$post->id, $post->slug]) }}">
                        <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                        Upraviť položku
                    </a>
                    <a class="dropdown-item" href="{{ route('org.post.copy', [$post->id, $post->slug]) }}">
                        <i class="fa fa-copy" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                        Kopírovať
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('org.post.delete', [$post->id, $post->slug]) }}" class="d-flex justify-content-between" id="delete-form" method="post">
                            @csrf @method('DELETE')
                        <a class="dropdown-item" href="#" onclick="get_form(this).submit(); return false">
                            <i @if(Auth::id() === $post->user_id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>
                            Zmazať
                        </a>
                    </form>
                </div>
            </td>
            {{--@endcan--}}
    </tr>
    @empty
        {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
    @endforelse

    </tbody>
</table>


@section('script')
<script>
    function get_form( element )
    {

        var r = confirm("Vymazať položku?");

        while( element )
        {
            element = element.parentNode;

            if( element.tagName.toLowerCase() == "form" )
            {

                if (r == true) {
                    return element
                } else {
                    return 0;
                }
                return element;
            }
        }
//        return 0; //error: no form found in ancestors
    }
</script>

    @endsection