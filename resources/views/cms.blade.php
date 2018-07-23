@extends('cms::site')

@section('css')
    <style type="text/css">

    </style>
@stop

@section('main')
<div class="row column medium-10 small-12">
    <cms-viewer path="{{ $title }}" get="{{ cms_api_path('test') }}" post="{{ cms_path() }}"></cms-viewer>
    {{--<cms-json data-page="{{$title}}" data-route="{{config('cms.prefix', 'cms')}}"></cms-json>--}}
</div>
@stop
