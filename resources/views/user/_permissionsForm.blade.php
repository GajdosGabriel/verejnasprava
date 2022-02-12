@role('admin')
<div class="flex flex-wrap ">

    @forelse($organization->menus as $menu)
        @if($menu->id == 1)
            {{--  Zverejňovanie --}}
            <div class="bg-gray-400 p-2 md:w-1/3 rounded-md border-gray-500 border-2 m-1">
                <h1 class="font-medium text-lg">Zverejňovanie</h1>
                <div class="md:flex w-full bg-yellow-400">
                    {{-- Section Permissions --}}
                    <div class="p-4 ">
                        <strong>Prístup</strong>
                        @forelse(Spatie\Permission\Models\Permission::whereCategory('post')->get() as $permission)
                            <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                <label class="col-form-label"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="permission[]" type="checkbox" id="council"
                                           value="{{ $permission->id }}"
                                           @if($permission->users->contains($user->id) ) checked @endif
                                           @if( ! request()->is('users/*/edit') && ! request()->is('users/create') ) disabled @endif
                                    >
                                    <label class="input-label" for="council">{{ $permission->title }}</label>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if($menu->id == 3)
            {{--  Zastupiteľstvo --}}
            <div class="bg-gray-400 p-2 md:w-1/3 rounded-md border-gray-500 border-2 m-1">
                <h1 class="font-medium text-lg">Zastupiteľstvo</h1>
                <div class="md:flex w-full bg-yellow-400">
                    {{-- Section Permissions --}}
                    <div class="p-4 ">
                        <strong>Prístup</strong>
                        @forelse(Spatie\Permission\Models\Permission::whereCategory('council')->get() as $permission)
                            <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                <label class="col-form-label"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="permission[]" type="checkbox" id="council"
                                           value="{{ $permission->id }}"
                                           @if($permission->users->contains($user->id) ) checked @endif
                                           @if( ! request()->is('users/*/edit') && ! request()->is('users/create') ) disabled @endif
                                    >
                                    <label class="input-label" for="council">{{ $permission->title }}</label>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        @if($menu->id == 2)
            {{--  Kontakty --}}
            <div class="bg-gray-400 p-2 md:w-1/3 rounded-md border-gray-500 border-2 m-1">
                <h1 class="font-medium text-lg">Kontakty</h1>
                <div class="md:flex w-full bg-yellow-400">
                    {{-- Section Permissions --}}
                    <div class="p-4 ">
                        <strong>Prístup</strong>
                        @forelse(Spatie\Permission\Models\Permission::whereCategory('contact')->get() as $permission)
                            <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                <label class="col-form-label"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="permission[]" type="checkbox" id="council"
                                           value="{{ $permission->id }}"
                                           @if($permission->users->contains($user->id) ) checked @endif
                                           @if( ! request()->is('users/*/edit') && ! request()->is('users/create') ) disabled @endif
                                    >
                                    <label class="input-label" for="council">{{ $permission->title }}</label>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if($menu->id == 6)
            {{--  Tasks --}}
            <div class="bg-gray-400 p-2 md:w-1/3 rounded-md border-gray-500 border-2 m-1">
                <h1 class="font-medium text-lg">Úlohy</h1>
                <div class="md:flex w-full bg-yellow-400">
                    {{-- Section Permissions --}}
                    <div class="p-4 ">
                        <strong>Prístup</strong>
                        @forelse(Spatie\Permission\Models\Permission::whereCategory('task')->get() as $permission)
                            <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                <label class="col-form-label"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="permission[]" type="checkbox" id="council"
                                           value="{{ $permission->id }}"
                                           @if($permission->users->contains($user->id) ) checked @endif
                                           @if( ! request()->is('users/*/edit') && ! request()->is('users/create') ) disabled @endif
                                    >
                                    <label class="input-label" for="council">{{ $permission->title }}</label>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        @if($menu->id == 5)
            {{--  Objednávky --}}
            <div class="bg-gray-400 p-2 md:w-1/3 rounded-md border-gray-500 border-2 m-1">
                <h1 class="font-medium text-lg">Objednávky</h1>
                <div class="md:flex w-full bg-yellow-400">
                    {{-- Section Permissions --}}
                    <div class="p-4 ">
                        <strong>Prístup</strong>
                        @forelse(Spatie\Permission\Models\Permission::whereCategory('order')->get() as $permission)
                            <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                <label class="col-form-label"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="permission[]" type="checkbox" id="council"
                                           value="{{ $permission->id }}"
                                           @if($permission->users->contains($user->id) ) checked @endif
                                           @if( ! request()->is('users/*/edit') && ! request()->is('users/create') ) disabled @endif
                                    >
                                    <label class="input-label" for="council">{{ $permission->title }}</label>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    @empty
    @endforelse

</div>

@endrole
