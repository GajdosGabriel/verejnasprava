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
                {{--@forelse($post->file as $pos )--}}
                    {{--<a target="_blank" href="{{ URL::to('/')}}/download/{{  $pos['name'] }}">Príloha</a>--}}
                {{--@empty--}}
                    {{--Bez prílohy--}}
                {{--@endforelse--}}

                {{--@forelse($post->file as $file)--}}
                    {{--<a target="_blank" href="{{ URL::to('/')}}/download/{{  $file->name }}">Príloha</a>--}}
                {{--@empty--}}
                    {{--Bez prílohy--}}
                {{--@endforelse--}}

                @if( isset($post->files))
                    <a target="_blank" href="{{ URL::to('/')}}/download/{{  $post->file['name'] }}">Príloha</a>
                @else
                    Bez prílohy
            @endif
            <td>{{ $post->int_number }}</td>

            {{--@can( 'update', $post)--}}
            <td>
                <form action="{{ route('org.post.delete', [$post->id, $post->slug]) }}" class="d-flex justify-content-between" id="delete-form" method="post">
                    @csrf @method('DELETE')
                    <a href="#" onclick="get_form(this).submit(); return false"><i @if(Auth::id() === $post->user_id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>
                    <a @if(Auth::id() === $post->organization_id) @else style="color: grey" @endif class="faicons" href="{{ route('org.post.edit', [$post->id, $post->slug]) }}"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i></a>
                    <a @if(Auth::id() === $post->organization_id) @else style="color: grey" @endif  class="faicons" href="{{ route('org.post.copy', [auth()->user()->active_organization, auth()->user()->slug ]) }}"><i class="fa fa-copy" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Kopírovať"></i></a>
                </form>

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