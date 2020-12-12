<div class="max-w-sm m-5">
    <h2 class="text-lg mb-4">Aktivácia modulov</h2>

    <form method="POST" action="{{ route('moduleActivators.update', auth()->user()->active_organization) }}"
          class="">
        @csrf @method('PUT')
        @forelse(App\Models\Menu::horizontalMenu()->get() as $menu)
            {{--            @continue($menu->type == 'vertical')--}}
            <div class="flex mb-5 max-w-sm  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md
         @if($menu->organizations->contains($organization->id)) bg-teal-100 @endif
                ">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div class="flex w-full justify-between items-center">
                    <div class="font-bold">Modul: {{ $menu->name }}</div>

                        @if($menu->organizations->contains($organization->id))
                        <button class="px-2 py-1 hover:bg-gray-500 border-gray-600 border-2 rounded-lg ml-4 hover:text-gray-200 text-sm" name="modul" value="{{ $menu->id }}" type="submit">
                        Aktivované
                        </button>
                        @else
                        <button class="px-2 py-1 hover:bg-gray-500 bg-gray-700 text-white rounded-lg ml-4 hover:text-gray-200 text-sm" name="modul" value="{{ $menu->id }}" type="submit">
                            Aktivovať
                        </button>
                        @endif

                </div>
            </div>
        @empty
        @endforelse
    </form>
</div>
