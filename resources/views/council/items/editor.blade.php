@section('script-header')
<script src={{ asset('tinymce/js/tinymce/tinymce.min.js') }}></script>
@endsection

@section('script-down')
    <script>
    tinymce.init({
        selector: '#editor',
        language: 'sk',
        branding: false,
        menubar: false,
        height: 300,
    });
</script>
@endsection
