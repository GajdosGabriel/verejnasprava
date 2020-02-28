<li class="text-danger list-group-item">Vymazali ste objednávku
    <strong>č. {{ $activity->subject->order_number }} </strong>
    <span title="{{ $activity->created_at }}" class="pull-right">{{ $activity->created_at->diffForHumans() }}</span>
</li>
