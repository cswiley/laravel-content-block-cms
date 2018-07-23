@extends('cms::site')

@section('main')
    <section>
        <div class="row column small-12">
            <ol type="1" class="home-menu">
                @foreach($menu as $key => $name)
                    <li class="item">
                        <a href="/{{ config('cms.prefix', 'cms')}}/{{$key}}/edit">
                            {{$name}}
                        </a>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
@stop
