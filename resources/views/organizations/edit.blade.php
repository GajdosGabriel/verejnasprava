
{{--    <div class="container mx-auto p-6 min-h-screen">--}}

{{--    <h1 class="page-title">Upraviť organizáciu</h1>--}}

    <form action="{{ route('organizations.update', $organization->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        @include('modul.errors')

        @include('organizations._form')

    </form>
{{--    </div>--}}


