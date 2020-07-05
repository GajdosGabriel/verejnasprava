@if($item->interpellations)
    <div class="">

        {{--        <a href="{{ route('interpellation.store', [ $item->id, $item->slug]) }}"--}}
        {{--           title="Prihlásený do rozpravy k bodu rokovania">--}}
        {{--            <span style=" flex: 0 0 auto"--}}
        {{--                  class="badge badge-primary">Do rozpravy: {{ $item->interpellations()->whereStatus(1)->count() }}</span>--}}
        {{--        </a>--}}

        <div class="border-2 rounded-md border-gray-300">
            <div class="flex justify-between mb-3 bg-gray-300 p-1">
                <h4 class="font-semibold text-gray-800">Prihlásnenie do rozpravy</h4>
                <span class="text-sm">({{ $item->interpellations()->count() }})</span>

            </div>
            <ul>
                @forelse($item->interpellations()->get() as $interpellation)
                    <li class="flex justify-between border-b-2 border-dotted px-2">
                        <span>{{ $interpellation->user->full_name() }}</span>
                        <a href="{{ route('interpellation.store', [ $item->id, $item->slug]) }}">
                            <span class="text-gray-800 text-sm cursor-pointer">x</span>
                        </a>
                    </li>
                @empty
                    <li class="flex justify-between border-b-2 border-dotted px-2">žiadny prihlásený</li>
                @endforelse
            </ul>
        </div>
    </div>

@endif
