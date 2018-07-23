@extends('cms::layouts.site')

@section('content')
    <header>
        <h1>CMS Blocks</h1>
    </header>
    <section class="cms-home">
        <ul class="home-menu">
            @foreach($menu as $key => $name)
                <li class="item">
                    <a href="/{{ config('cms.prefix', 'cms')}}/{{$key}}/edit">
                        {{$name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
@stop
