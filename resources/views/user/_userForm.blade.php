
            <div class="">

                <div class="">

                    {{-- Form First name --}}
                    <div class="form-group">
                        <label for="first_name" class="input-label">Meno</label>

                        <div class="col-md-8">
                            <input id="first_name" type="text" class="w-full @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $user->first_name }}" required autocomplete="name" autofocus>

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
                            <input id="last_name" type="text" class="w-full @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? $user->last_name }}" required autocomplete="last_name">

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
                                <input id="email" type="email" class="w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                    {{-- Form employment --}}
                    <div class="form-group">
                        <label for="employment" class="input-label">Funkcia</label>

                        <div class="col-md-8">
                            <input id="employment" type="text" class="w-full @error('employment') is-invalid @enderror" name="employment" value="{{ old('employment') ?? $user->employment }}" autocomplete="employment">

                            @error('employment')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>




