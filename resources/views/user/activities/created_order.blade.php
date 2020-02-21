<li class="list-group-item">Vytvorili ste <a href="{{ url(auth()->user()->slug. '/ordershow/'  . $activity->subject->id  ) }}">objednávku</a>
   <strong>č.: {{ $activity->subject->order_number }}</strong>
    <span title="{{ $activity->created_at }}" class="pull-right">{{ $activity->created_at->diffForHumans() }}</span>
</li>
