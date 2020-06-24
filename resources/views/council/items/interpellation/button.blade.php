<div class="">
    @if($item->interpellations)
        <a href="{{ route('interpellation.store', [ $item->id, $item->slug]) }}"
           title="Prihlásený do rozpravy k bodu rokovania">
            <span
                class="badge badge-primary">Do rozpravy: {{ $item->interpellations()->whereStatus(1)->count() }}</span>
        </a>
    @endif
</div>


