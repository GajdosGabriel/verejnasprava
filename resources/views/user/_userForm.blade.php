

            <div class="card">
                <div class="card-header">Pridať osobu</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Meno</label>

                            <div class="col-md-8">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row {{ $errors->has('company_id') ? ' has-error' : '' }}">
                        <label class="col-md-4 col-form-label text-md-right">Funkcia</label>
                        <div class="col-md-8">
                            <select name="role" class="form-control" required id="exampleSelect1">
                                <option value="" selected >Vybrať funkciu</option>
                                <option value="role view">Zamestnanec</option>
                                <option value="council view">Zastupiteľstvo</option>
                                <option value="council create">Zapisovateľ</option>
                            </select>
                        </div>
                    </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrácia
                                </button>
                            </div>
                        </div>

                </div>
            </div>




