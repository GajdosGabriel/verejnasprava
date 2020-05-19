@forelse($posts as $key => $value)
<table class="table-auto container mx-auto">
    <thead>
    <tr>
        <th class="px-4 py-2">Organizácia</th>
        <th class="px-4 py-2">Popis</th>
        <th class="px-4 py-2">Kategória</th>
        <th class="px-4 py-2">Dodávateľ</th>
        <th class="px-4 py-2">Suma</th>
        <th class="px-4 py-2">Súbor</th>
        <th class="px-4 py-2" >Dátum</th>
    </tr>
    </thead>
    <tbody>
    @forelse($value as $post)
        <tr>
            <td class="border px-4 py-2"><a href="{{ route('publishedPosts', [$post->organization->id, $post->organization->slug]) }}">{{ $post->organization->name}}</a></td>
            <td class="border px-4 py-2">{{ $post->name }}</td>
            <td class="border px-4 py-2">
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
            <td class="border px-4 py-2"><strong>{{ $post->contact->name }}</strong><br> {{ $post->contact->city }}, <small>ico:{{ $post->contact->ico }}</small></td>
            <td class="border px-4 py-2"><strong>{{ $post->DisplayPrice }} Eu</strong></td>
            <td class="border px-4 py-2">
                @forelse($post->files as $file)
                    <a target="_blank" href="{{ URL::to('/')}}/download/{{  $file->name }}">Príloha</a>
                @empty
                    Bez prílohy
                @endforelse
            </td>
            <td class="border px-4 py-2">{{ $post->date_in }}</td>
        </tr>
    @empty
        Bez záznamu
    @endforelse
    </tbody>
</table>

@empty
    <p>Bez záznamu</p>
@endforelse



{{--<div class="accordion mb-5" id="accordionExample">--}}
{{--    @forelse($posts as $key => $value)--}}
{{--    <div class="card">--}}
{{--        <div  id="headingOne{{ $key }}">--}}
{{--            <h2 class="mb-0">--}}
{{--                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">--}}
{{--                    {{ $key }}--}}
{{--                </button>--}}
{{--            </h2>--}}
{{--        </div>--}}

{{--        <div id="collapseOne{{ $key }}" class="collapse" aria-labelledby="headingOne{{ $key }}" data-parent="#accordionExample">--}}
{{--            <table class="table table-striped">--}}
{{--                    <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Organizácia</th>--}}
{{--                            <th>Popis</th>--}}
{{--                            <th>Kategória</th>--}}
{{--                            <th>Dodávateľ</th>--}}
{{--                            <th>Suma</th>--}}
{{--                            <th>Súbor</th>--}}
{{--                            <th>Dátum</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @forelse($value as $post)--}}
{{--                        <tr>--}}
{{--                            <td><a href="{{ route('publishedPosts', [$post->organization->id, $post->organization->slug]) }}">{{ $post->organization->name}}</a></td>--}}
{{--                            <td>{{ $post->name }}</td>--}}
{{--                            <td class="text-center">--}}
{{--                                @if($post->category->id === 1)--}}
{{--                                    <img class="" style="height: 23px" src="{{ asset('image/f.gif')  }}" title="Faktúra">--}}
{{--                                @elseif($post->category->id === 2)--}}
{{--                                    <img class="" style="height: 23px" src="{{ asset('image/o.gif')  }}" title="Objednávka">--}}
{{--                                @elseif($post->category->id === 3)--}}
{{--                                    <img class="" style="height: 23px" src="{{ asset('image/z.gif')  }}" title="Zmlúva">--}}
{{--                                @else($post->category->id === 4)--}}
{{--                                    <img class="" style="height: 23px" src="{{ asset('image/v.gif')  }}" title="Všeobecno-záväzné nariadenie">--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td><strong>{{ $post->contact->name }}</strong><br> {{ $post->contact->city }}, <small>ico:{{ $post->contact->ico }}</small></td>--}}
{{--                            <td style="width: 10%"><strong>{{ $post->DisplayPrice }} Eu</strong></td>--}}
{{--                            <td>--}}
{{--                                @forelse($post->files as $file)--}}
{{--                                    <a target="_blank" href="{{ URL::to('/')}}/download/{{  $file->name }}">Príloha</a>--}}
{{--                                @empty--}}
{{--                                    Bez prílohy--}}
{{--                                @endforelse--}}
{{--                            </td>--}}
{{--                            <td>{{ $post->date_in }}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        Bez záznamu--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--        @empty--}}
{{--        <p>Bez záznamu</p>--}}
{{--        @endforelse--}}


{{--</div>--}}
