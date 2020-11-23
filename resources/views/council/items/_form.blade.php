<div class="">
    <div class="">
        <div class="md:flex w-full items-center">

            {{--  title --}}
            <div class="form-group">
                <label for="name" class="font-semibold">Bod programu</label>

                <input id="name" type="text"
                       class="input-control focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            </div>
            {{--  type vote --}}
            <div class="form-group md:px-10">
                <label for="vote_type" class="font-semibold">Hlasovanie</label>

                <select name="vote_type" class="custom-select px-4 bg-gray-200 rounded-md" id="vote_type">
                    <option value="0">Verejné</option>
                    <option value="1">Tajné</option>
                </select>

            </div>


        </div>
        <div class="card-body">
            <div class="my-5">
                <label class="font-semibold">Popis návrhu</label>

                <div class="col-md-8">
                    <textarea id="editor" class="form-control" name="description" rows="10"></textarea>
                </div>
            </div>

            <div class="md:flex justify-between my-5">

                {{--Príloha--}}
                <div class="form-group">
                    <label for="filename" class="font-semibold">Prílohy k návrhu</label>

                    <div class="">
                        <input type="file" name="filename[]" value="{{ old('filename') }}" multiple
                               placeholder="Príloha" id="filename">
                    </div>
                </div>


            </div>


            <div class="flex justify-between mt-6">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Späť</a>
                <button type="submit" class="btn btn-primary">Uložiť</button>
            </div>
        </div>
    </div>
</div>
