
        <table class="table-auto">
            <thead>
            <tr>
                <th  class="px-4 py-2">Meno</th>
                <th  class="px-4 py-2">Email</th>
                <th  class="px-4 py-2">Status</th>
                <th  class="px-4 py-2">Člen</th>
                <th  class="px-4 py-2">Role</th>
                <th  class="px-4 py-2">Panel</th>
            </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->full_name() }}</td>

                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">
                        @if($user->email_verified_at)
                            <span class="badge badge-primary">Aktívny</span>
                        @else
                            <a href="{{ route('user.invitation', [$user->id, $user->slug]) }}">
                                @if($user->send_invitation == null)
                                <span class="badge badge-primary"  title="Poslať pozvánku">Poslať pozvánku</span>
                                @else
                                <span class="badge badge-primary" title="Pozvánka poslaná dňa">Poslané: {{ $user->send_invitation }}</span>
                                @endif
                            </a>
                        @endif

                    </td>
                    <td class="border px-4 py-2">
                        @foreach($user->councils as $role)
                        <span class="badge badge-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>

                    <td class="border px-4 py-2">
                        @foreach($user->roles as $role)
                            <span class="badge badge-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>


                    {{--@can( 'update', $post)--}}
                    <td class="border px-4 py-2">
                        <a class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog text-secondary"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.edit', [$user->id, $user->slug]) }}">
                                <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť užívateľa"></i>
                                Upraviť užívateľa
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.delete', [$user->id, $user->slug]) }}" onclick="get_form(this).submit(); return false">
                                <i style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>
                                Zmazať
                            </a>
                        </div>
                    </td>
                    {{--@endcan--}}
            </tr>
            @empty
                {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
            @endforelse

            </tbody>
        </table>




