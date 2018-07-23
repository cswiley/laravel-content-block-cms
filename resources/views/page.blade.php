@extends('cms::site')

@section('css')
    <style type="text/css">

    </style>
@stop

@section('main')
<div class="row column medium-10 small-12">
    <nav aria-label="You are here:" role="navigation" class="nav-breadcrumbs">
        <ul class="breadcrumbs">
            <li><a href="/{{config('cms.prefix', 'cms')}}">Menu</a></li>
            <li>
                <span class="show-for-sr">Current: </span> {{$title}}
            </li>
        </ul>
    </nav>
    <cms-viewer path="{{ $title }}" get="{{ cms_api_path($title) }}" post="{{ cms_path() }}"></cms-viewer>
</div>
@stop
