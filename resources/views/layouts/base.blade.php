<!DOCTYPE html>
<html>
<head lang="en-US">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('page_title', 'title')</title>
    @foreach (config('cms.stylesheets') as $stylesheet)
        <link rel="stylesheet" href="{{ $stylesheet }}">
    @endforeach
    <link rel="stylesheet" href="{{ cms_assets('css/app.css') }}">
    @stack('stylesheets')
    @yield('css')
</head>
<body id="cms-wrap">

<div id="myApp">
    <div class="main-header">
        <div class="row">
            <div class="column small-12">
        @include('cms::partials.menu', ['menu' => $menu])
            </div>
        </div>
    </div>
    <div class="row">
        <div class="column small-12">
            @yield('main')
        </div>
    </div>
</div>

@foreach (config('cms.scripts') as $scripts)
    <script type="text/javascript" src="{{ $scripts }}"></script>
@endforeach
<script type="text/javascript" src="{{ cms_assets('js/app.js') }}"></script>
<script>
</script>

</body>
</html>
