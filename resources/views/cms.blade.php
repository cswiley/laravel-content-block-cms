@extends('cms::site')

@section('css')
    <style type="text/css">

    </style>
@stop

@section('main')
<div class="row column medium-10 small-12">
    <cms-json data-page="{{$title}}" data-route="{{config('cms.prefix', 'cms')}}"></cms-json>
</div>
@stop
