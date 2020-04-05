
        <table class="table table-bordered table-inverse table-hover">
            <thead>
            <tr class="alert-info">
                <th>Meno</th>
                <th>Email</th>
                <th>Status</th>
                <th>Člen</th>
                <th>Role</th>
                <th>Panel</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                @forelse($users as $user)
                    <td>{{ $user->full_name() }}</td>

                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->email_verified_at)
                            <span class="badge badge-secondary">Aktívny</span>
                        @else
                            <a href="{{ route('user.invitation', [$user->id, $user->slug]) }}" title="Poslať pozvánku">
                                <span class="badge badge-info">Poslať pozvánku</span>
                            </a>
                        @endif

                    </td>
                    <td>
                        @foreach($user->councils as $role)
                        <span class="badge badge-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>

                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge badge-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>


                    {{--@can( 'update', $post)--}}
                    <td class="d-flex justify-content-center">
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




