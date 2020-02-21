
<div   style="margin-bottom: 5px; float: left">
    @forelse($categories as $category)
        <a href="{{ url( auth()->user()? \Auth::user()->slug : 'category'  , $category->slug) }}"><button type="button" class="btn btn-primary {{ ($category->slug) ? 'active' : '' }}">{{ $category->name }}</button></a>
     @empty
        <p>nothing</p>
     @endforelse
</div>

<div>
    @if(Auth::user())
        <a href="{{ route('post.create', [auth()->user()->id, auth()->user()->slug ])  }}"><button class="btn btn-danger pull-right">Nový doklad</button></a>
    @endif
</div>

<div class="clearfix"></div>

{{--@if(auth()->user()->customers()->count() < 1)--}}
{{--<div class="jumbotron">--}}
    {{--<h1>Gratulujeme, pokračujeme!</h1>--}}
    {{--<p>Najprv vytvoríme dodávateľa, aby sme mohli zadať prvý doklad.</p>--}}
    {{--<p><a class="btn btn-primary btn-lg" href="{{ url(auth()->user()->slug, 'customers') }}" role="button">Pridať dodávateľa</a></p>--}}
{{--</div>--}}
    {{--@endif--}}