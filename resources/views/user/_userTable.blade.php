<table class="table-auto w-full">
   
    <thead class="bg-gray-300">
        <tr>
            <th class="table-header">Meno</th>
            <th class="table-header">Pracovné zaradenie</th>
            <th class="table-header">Zastupiteľstvo</th>
            @role('admin')
                <th class="table-header">Status</th>
                <th class="table-header">Role</th>
                <th class="table-header">Nálepka</th>
                <th class="table-header">Panel</th>
            @endrole
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <td class="table-data">
                    <a href="{{ route('users.show', $user->id) }}"><strong>{{ $user->full_name() }}</strong></a>
                </td>
                <td class="table-data">
                    {{ $user->employment }}
                </td>
                <td class="table-data">
                    @foreach ($user->councils as $council)
                        <a href="{{ route('council.user.index', $council->id) }}">
                            <span class="badge badge-secondary">{{ $council->name }}</span>
                        </a>
                    @endforeach
                </td>
                @role('admin')
                    <td class="table-data">
                        @if ($user->email_verified_at)
                            <span class="badge badge-primary">Aktívny</span>
                        @else
                            <a href="{{ route('user.invitation', [$user->id, $user->slug]) }}">
                                @if ($user->send_invitation == null)
                                    <span class="badge badge-primary" title="Poslať pozvánku">Poslať pozvánku</span>
                                @else
                                    <span class="badge badge-primary" title="Pozvánka poslaná dňa">Pozvaný:
                                        {{ $user->send_invitation->diffForHumans() }}</span>
                                @endif
                            </a>
                        @endif
                    </td>
                    <td class="table-data">
                        @foreach ($user->roles as $role)
                            <span class="border-2 rounded-md border-gray-400 px-2">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="table-data">
                        @foreach ($user->tags as $tag)
                            <span class="border-2 rounded-md border-gray-400 px-2">{{ $tag->name }}</span>
                        @endforeach
                    </td>

                    <td class="table-data">
                        <nav-drop-down inline-template>
                            <div class="relative flex items-start">
                                <a @click="isOpen =! isOpen" class="" href="#">
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                                    </svg>
                                </a>

                                <div v-if="isOpen"
                                    class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                                    {{-- Item Up button --}}
                                    <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap"
                                        href="{{ route('users.edit', $user->id) }}" title="Upraviť užívateľa">
                                        Upraviť
                                    </a>

                                    {{-- Item Down button --}}
                                    <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                        class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap">
                                        @csrf @method('DELETE')
                                        <button title="Vymazať položku">Zmazať</button>
                                    </form>
                                </div>

                            </div>
                        </nav-drop-down>
                    </td>
                @endrole
            </tr>
        @empty
            {{-- <tbody><tr><td>Žiadne doklady</td></tr></tbody> --}}
        @endforelse

    </tbody>
</table>
