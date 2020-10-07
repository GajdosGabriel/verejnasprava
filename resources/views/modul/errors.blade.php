

@if ($errors->any())
    <div class="">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-red-500 p-2 bg-red-200 border-red-600 border-2 rounded-sm shadow-md text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



