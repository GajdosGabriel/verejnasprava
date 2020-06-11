<div class="flex relative">
    @if($item->interpellations)
        <a href="{{ route('interpellation.store', [ $item->id, $item->slug]) }}"
           title="Prihlásený do rozpravy k bodu rokovania">
            <span style=" flex: 0 0 auto"
                  class="badge badge-primary">Do rozpravy: {{ $item->interpellations()->whereStatus(1)->count() }}</span>
        </a>

{{--        <div class="absolute z-10 mt-6 whitespace-no-wrap">--}}
{{--            <ul>--}}
{{--                @forelse($item->interpellations()->whereStatus(1)->get() as $interpellation)--}}
{{--                    <li--}}
{{--                        class="badge badge-light flex flex-1 border-2 border-gray-400 rounded-sm">{{ $interpellation->user->full_name() }}</li>--}}
{{--                @empty--}}
{{--                    --}}{{--                <a href="{{ route('interpellation.store', [ $item->id, $item->slug]) }}">--}}
{{--                    --}}{{--                    <span class="badge badge-light">Do rozpravy</span>--}}
{{--                    --}}{{--                </a>--}}
{{--                @endforelse--}}

{{--            </ul>--}}

{{--        </div>--}}


    @endif
</div>


