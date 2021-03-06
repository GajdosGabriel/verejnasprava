<table class="table-auto w-full">
    <thead class="bg-gray-300">
    <tr>
        <th class="px-4 py-2">Meno</th>
        <th class="px-4 py-2">Člen</th>
        @role('admin')
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Status</th>
        <th class="px-4 py-2">Role</th>
        <th class="px-4 py-2">Skupina</th>
        <th class="px-4 py-2">Panel</th>
        @endrole
    </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
        <tr>
            <td class="border px-4 py-2 flex justify-between">
                <strong>{{ $user->full_name() }}</strong>
                <span class="text-gray-600">{{ $user->employment }}</span>
            </td>
            <td class="border px-4 py-2">
                @foreach($user->councils as $role)
                    <span class="badge badge-secondary">{{ $role->name }}</span>
                @endforeach
            </td>
            @role('admin')
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">
                @if($user->email_verified_at)
                    <span class="badge badge-primary">Aktívny</span>
                @else
                    <a href="{{ route('user.invitation', [$user->id, $user->slug]) }}">
                        @if($user->send_invitation == null)
                            <span class="badge badge-primary" title="Poslať pozvánku">Poslať pozvánku</span>
                        @else
                            <span class="badge badge-primary"
                                  title="Pozvánka poslaná dňa">Pozvaný: {{ $user->send_invitation->diffForHumans() }}</span>
                        @endif
                    </a>
                @endif
            </td>
            <td class="border px-4 py-2">
                @foreach($user->roles as $role)
                    <span class="badge badge-secondary">{{ $role->name }}</span>
                @endforeach
            </td>
            <td class="border px-4 py-2">
                @foreach($user->tags as $tag)
                    <span class="badge badge-secondary">{{ $tag->name }}</span>
                @endforeach
            </td>

            <td class="border px-4 py-2">
                <nav-drop-down inline-template>
                    <div class="relative flex items-start">
                        <a @click="isOpen =! isOpen" class="" href="#">
                            <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                            </svg>
                        </a>

                        <div v-if="isOpen"
                             class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                            {{-- Item Up button--}}
                            <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap"
                               href="{{ route('users.edit', $user->id) }}" title="Upraviť užívateľa">
                                Upraviť
                            </a>

                            {{-- Item Down button--}}
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
        {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
    @endforelse

    </tbody>
</table>




