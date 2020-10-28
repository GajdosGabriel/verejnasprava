@role('admin')
<div class="">
    @role('admin')
    <div class="md:flex w-full">


        {{-- Section Counsils --}}
        <div class="p-4 sm:w-1/3">
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

        {{-- Section Permissions --}}
        <div class="p-4 sm:w-1/3">
            <strong>Prístup</strong>

            {{--                                @forelse($user->permissions as $council)--}}
            {{--                                    <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">--}}
            {{--                                        <label class="col-form-label"></label>--}}
            {{--                                        <div class="form-check form-check-inline">--}}
            {{--                                            <input class="form-check-input" name="council[]" type="checkbox" id="council" value="{{ $council->id }}"--}}
            {{--                                                   @if($council->users->contains($user->id) ) checked @endif--}}
            {{--                                            >--}}
            {{--                                            <label class="input-label" for="council">{{ $council->name }}</label>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                @empty--}}
            {{--                                  <br>  Nemáte založené žiadne zastupiteľstvo.--}}
            {{--                                @endforelse--}}


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
                <br>  Nemáte založené žiadne zastupiteľstvo.
            @endforelse
        </div>

        @role('super-admin')
        {{-- Section Roles --}}
        <div class="py-4 sm:w-1/3">
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
        @endrole
    </div>
    @endrole

    <div class="form-group">
        <div class="flex justify-between my-3">
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
            <button type="submit" class="btn btn-primary">Uložiť</button>
        </div>
    </div>
</div>
@endrole
