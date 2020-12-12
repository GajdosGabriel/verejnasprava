<li class="list-group-item">Zverejnenie
    <a href="{{ route('order.show', [ $activity->subject->id, $activity->subject->id]) }}">dokladu</a>
    <strong>č. {{ $activity->subject->order_number }}</strong>
    <span title="{{ $activity->created_at }}" class="pull-right">{{ $activity->created_at->diffForHumans() }}</span>
</li>