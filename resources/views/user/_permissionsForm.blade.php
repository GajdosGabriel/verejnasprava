@role('admin')
<div class="sm:flex">

    <div class="bg-gray-400 p-2 md:w-1/3 rounded-md">
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
                            >
                            <label class="input-label" for="council">{{ $permission->title }}</label>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-gray-400 p-2 md:w-1/3 rounded-md">
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
                            >
                            <label class="input-label" for="council">{{ $permission->title }}</label>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-gray-400 p-2 md:w-1/3 rounded-md">
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
                            >
                            <label class="input-label" for="council">{{ $permission->title }}</label>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>

</div>

@endrole
