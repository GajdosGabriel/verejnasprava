
            <div class="">

                <div class="">

                    {{-- Form First name --}}
                    <div class="form-group">
                        <label for="first_name" class="input-label">Meno</label>

                        <div class="col-md-8">
                            <input id="first_name" type="text" class="input-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $user->first_name }}" required autocomplete="name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Form First name --}}
                    <div class="form-group">
                        <label for="last_name" class="input-label">Priezvisko</label>

                        <div class="col-md-8">
                            <input id="last_name" type="text" class="input-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? $user->last_name }}" required autocomplete="last_name">

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Form Email --}}
                    <div class="form-group">
                            <label for="email" class="input-label">Email</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="input-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    {{-- Form Role and permission --}}
                    <div class="">
                        @can('delete')
                        <div class="flex">


                            {{-- Section Roles --}}
                            <div class="p-4">
                                <strong>Role</strong>

                                {{-- Role --}}
                                @forelse($user->roles as $role)
                                    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role{{ $role->id }}" class="col-form-label"></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="role[]" type="checkbox" id="role{{ $role->id }}" value="{{ $role->id }}"
                                                   @if($user->id == $user->roles->contains($role->id))  checked @endif
                                            >
                                            <label class="input-label" for="role">{{ $role->name }}</label>
                                        </div>
                                    </div>
                                @empty
                                    Nemáte založené žiadne role.
                                @endforelse
                            </div>

                            {{-- Section Counsils --}}
                            <div class="p-4">
                               <strong>Člen zastupiteľstva</strong>

                                @forelse($organization->councils as $council)
                                <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                    <label class="col-form-label"></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="council[]" type="checkbox" id="council" value="{{ $council->id }}"
                                        @if($council->users->contains($user->id) ) checked @endif
                                        >
                                        <label class="input-label" for="council">{{ $council->name }}</label>
                                    </div>
                                </div>
                                @empty
                                    Nemáte založené žiadne zastupiteľstvo.
                                @endforelse
                            </div>

                            {{-- Section Permissions --}}
                            <div class="p-4">
                                <strong>Prístup</strong>

                                @forelse($user->permissions as $council)
                                    <div class="form-group {{ $errors->has('council') ? ' has-error' : '' }}">
                                        <label class="col-form-label"></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="council[]" type="checkbox" id="council" value="{{ $council->id }}"
                                                   @if($council->users->contains($user->id) ) checked @endif
                                            >
                                            <label class="input-label" for="council">{{ $council->name }}</label>
                                        </div>
                                    </div>
                                @empty
                                    Nemáte založené žiadne zastupiteľstvo.
                                @endforelse
                            </div>

                        </div>
                        @endcan

                    {{--                    <div class="form-group row {{ $errors->has('role') ? ' has-error' : '' }}">--}}
{{--                        <label class="col-md-4 col-form-label text-md-right">Funkcia</label>--}}
{{--                        <div class="col-md-8">--}}
{{--                            <select name="role" class="form-control" required id="exampleSelect1">--}}
{{--                                <option value="" selected >Vybrať funkciu</option>--}}
{{--                                <option value="show">Člen zastupiteľstva</option>--}}
{{--                                <option value="edit">Zapisovateľ zastupiteľstva</option>--}}
{{--                                <option value="admin">Predseda zastupiteľstva</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                        <div class="form-group">
                            <div class="flex justify-between my-3">
                                <a href="{{ redirect()->back() }}" class="btn btn-secondary">Späť</a>
                                <button type="submit" class="btn btn-primary">Uložiť</button>
                            </div>
                        </div>
                </div>
                </div>
            </div>




