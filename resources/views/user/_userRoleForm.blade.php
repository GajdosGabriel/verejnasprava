@role('admin')
<div class="bg-gray-200 mb-4 rounded-md">
    <h1 class="font-medium text-lg">{{ $user->full_name() }} je:</h1>

    <div class="md:flex w-full bg-yellow-600">

        {{-- Section Counsils --}}
        <div class="p-4 sm:w-1/2">
            <strong>Člen zastupiteľstva</strong>

            @forelse($organization->councils as $council)
                <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                    <label class="col-form-label"></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="council[]" type="checkbox" id="council"
                               value="{{ $council->id }}"
                               @if($council->users->contains($user->id) ) checked @endif
                        >
                        <label class="input-label" for="council">{{ $council->name }}</label>
                    </div>
                </div>
            @empty
                <br>  Nie je založené žiadne zastupiteľstvo.
            @endforelse
        </div>


        {{-- Section Roles --}}
        <div class="py-4 sm:w-1/2">
            <strong>Role</strong>
            {{-- Role --}}
            @forelse(Spatie\Permission\Models\Role::all() as  $role)
                @continue($role->name == 'super-admin')
                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                    <label for="role{{ $role->id }}" class="col-form-label"></label>
                    <div class="form-check form-check-inline whitespace-no-wrap">
                        <input class="form-check-input" name="role[]" type="checkbox" id="role{{ $role->id }}"
                               value="{{ $role->id }}"
                               @if($user->id == $user->roles->contains($role->id))  checked @endif
                        >
                        <label class="input-label" for="role">{{ $role->name }}</label>
                    </div>
                </div>
            @empty
                Nemáte založené žiadne role.
            @endforelse
        </div>
    </div>
</div>
@endrole
