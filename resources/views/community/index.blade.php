@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-8">
                <h3>
                    <a href="/">Community</a>

                    @if ($channel)
                        <span>&mdash; {{ $channel->title }}</span>
                    @endif
                </h3>

                @include('partials.list')
            </div>

            @include('partials.add-link')
        </div>
    </div>
@stop
