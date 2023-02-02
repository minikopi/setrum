@extends('layouts.admin')

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- CSS Libraries -->
@foreach ($css_files as $css_file)
  <link rel="stylesheet" href="{{ $css_file }}">
@endforeach
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! $output !!}
        </div>
    </div>
@endsection

@push('js')
    <!-- JS Libraies -->
    @foreach ($js_files as $js_file)
        <script src="{{ $js_file }}"></script>
    @endforeach

<script>
    if (typeof $ !== 'undefined') {
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    }
</script>
<!-- Page Specific JS File -->
@endpush