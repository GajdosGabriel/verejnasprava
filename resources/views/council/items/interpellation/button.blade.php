{{--    @if($item->interpellations)--}}


<li
    class="flex justify-between border-b-2 border-dotted px-2 text-sm">
    <a href=""
       title="Prihlásený do rozpravy k bodu rokovania">

        @forelse($item->interpellations as $interpelation)

            @if($interpelation->user_id == auth()->user()->id)
                Odhlásiť sa
            @endif

        @empty
            Prihlásiť sa
        @endforelse

    </a>
</li>


{{--    @endif--}}



