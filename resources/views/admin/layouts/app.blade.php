<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @hasSection('title')
            @yield('title') - {{ env('APP_NAME') }}
        @else
            {{ env('APP_NAME') }}
        @endif
    </title>

    <link href="{{ asset('assets/admin/_css/style.css') }}" rel="stylesheet">
</head>
<body>

@include('admin.partials._header')
<div class="main-content">
    <div class="container">
        @yield('content')
    </div>
</div>

@include('admin.partials._footer')
<script src="{{ asset('assets/plugins/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/_js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
