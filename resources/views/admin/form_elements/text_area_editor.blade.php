@push('scripts')
{{--    <link rel="stylesheet"  type="text/css" href="{{ asset('assets/js/summernote/summernote.css') }}"></link>--}}
{{--    <link rel="stylesheet"  type="text/css" href="{{ asset('assets/css/file_manager.css') }}"></link>--}}
{{--    <script src="{{ asset('assets/js/summernote/summernote.js') }}"></script>--}}
@endpush
<textarea name="{{$editorName}}" id="{{$editorId}}" class="form-control" >
    {{$slot}}
</textarea>
<script>
    const editor{{$editorId}} = '#{{$editorId}}';
    $(document).ready(function() {

        $(editor{{$editorId}}).summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            fontNames: ['Arial', 'Open Sans', 'Raleway'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize', 'fontname']],
                ['insert', ['picture', 'link', 'video']],
                ['color', ['color']],
                ['table', ['table']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['fullscreen', ['fullscreen', 'codeview']],

            ]
        });
    });
</script>
