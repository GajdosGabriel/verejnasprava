<div class="accordion" id="accordionExample">
    @forelse($posts as $key => $value)
    <div class="card">
        <div class="card-header" id="headingOne{{ $key }}">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                    {{ $key }}
                </button>
            </h2>
        </div>

        <div id="collapseOne{{ $key }}" class="collapse" aria-labelledby="headingOne{{ $key }}" data-parent="#accordionExample">
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Organizácia</th>
                        <th>Popis</th>
                        <th>Kategória</th>
                        <th>Dodávateľ</th>
                        <th>Suma</th>
                        <th>Súbor</th>
                        <th>Dátum</th>
                        @if(Auth::check())
                            <th>Panel</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($value as $post)
                        <tr>
                            <td><a href="{{ url($post->organization->slug) }}">{{ $post->organization->name}}</a></td>
                            <td>{{ $post->name }}</td>
                            <td class="text-center">
                                @if($post->category->id === 1)
                                    <img class="" style="height: 23px" src="{{ asset('image/f.gif')  }}" title="Faktúra">
                                @elseif($post->category->id === 2)
                                    <img class="" style="height: 23px" src="{{ asset('image/o.gif')  }}" title="Objednávka">
                                @elseif($post->category->id === 3)
                                    <img class="" style="height: 23px" src="{{ asset('image/z.gif')  }}" title="Zmlúva">
                                @else($post->category->id === 4)
                                    <img class="" style="height: 23px" src="{{ asset('image/v.gif')  }}" title="Všeobecno-záväzné nariadenie">
                                @endif
                            </td>
                            <td><strong>{{ $post->company->name }}</strong><br> {{ $post->company->city }}, <small>ico:{{ $post->company->ico }}</small></td>
                            <td style="width: 10%"><strong>{{ $post->DisplayPrice }} Eu</strong></td>
                            <td>
                                @forelse($post->file as $file)
                                    <a target="_blank" href="{{ URL::to('/')}}/download/{{  $file->name }}">Príloha</a>
                                @empty
                                    Bez prílohy
                                @endforelse
                            </td>
                            <td>{{ $post->date_in }}</td>
                            {{--@can('update', $post)--}}
                            <td>
                                <form action="{{ route('deletepost', [$post->id]) }}" method="post" id="delete-form">
                                    @method('DELETE') @csrf
                                    <a href="" onclick="get_form(this).submit(); return false"><i @if(Auth::id() === $post->user_id) @else style="font-size: 118%;color: grey;" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>
                                </form>
                                <form action="{{ route('deletepost', $post->id ) }}" method="POST" id="delete-form">
                                    @csrf @method('DELETE')
                                    <a href="" onclick="get_form(this).submit(); return false"><i @if(Auth::id() === $post->user_id) @else style="font-size: 118%;color: grey;" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>
                                </form>
                                <a @if(Auth::id() === $post->organization_id) @else style="color: grey;pointer-events: none;cursor: default" @endif class="faicons" href="{{ url($post->organization->slug . '/post-edit', $post->id) }}"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i></a>
                                <a @if(Auth::id() === $post->organization_id) @else style="color: grey;pointer-events: none;cursor: default" @endif  class="faicons" href="{{ url($post->organization->slug . '/post-copy', $post->id) }}"><i class="fa fa-copy" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Kopírovať"></i></a>
                            </td>
                            {{--@endcan--}}
                        </tr>
                    @empty
                        Bez záznamu
                    @endforelse
                    </tbody>
                </table>



            </div>
        </div>
    </div>
        @empty
        <p>Bez záznamu</p>
        @endforelse


</div>
