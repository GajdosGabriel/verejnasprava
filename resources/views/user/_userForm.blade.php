

            <div class="card">
                <div class="card-header">Pridať osobu</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Meno</label>

                            <div class="col-md-8">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $user->first_name }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Priezvisko</label>

                            <div class="col-md-8">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? $user->last_name }}" required autocomplete="last_name">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    {{-- Section Counsils --}}
                    <div class="col-md-8 offset-4">
                       <strong>Zastupiteľstvá</strong>
                    </div>

{{--                     Councils--}}
                    @forelse($councils as $council)
                    <div class="form-group row {{ $errors->has('council') ? ' has-error' : '' }}">
                        <label class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="council" type="checkbox" id="council" value="{{ $council->id }}"
                                @if($council->users->contains($user->id) ) checked @endif
                                >
                                <label class="form-check-label" for="council">{{ $council->name }}</label>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse



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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Uložiť
                                </button>
                            </div>
                        </div>

                </div>
            </div>




