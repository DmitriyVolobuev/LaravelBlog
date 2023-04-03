
<input id="{{ $name }}" type="hidden" {{ $attributes }}>
<trix-editor input="{{ $name }}"></trix-editor>

@once

    @push('js')
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    @endpush

    @push('css')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    @endpush

@endonce
