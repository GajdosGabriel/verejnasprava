<a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ url('/logout') }}"
   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
    Odhlásiť
</a>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    @csrf
</form>
