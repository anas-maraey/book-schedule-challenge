@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        @foreach($schedule as $key => $date)

            <div class="col-sm-3">

                <div class="tile-stats tile-gray">
                    <div class="icon"><i class="entypo-suitcase"></i></div>

                    <div class="col-2 text-right">
                        <h1 class="display-4"><span class="badge badge-secondary">{!! date('d', $date) !!}</span></h1>
                        <h2>{!! date('M', $date) !!}</h2>
                    </div>

                    <h3>{!! date('l', $date) !!}</h3>
                </div>

            </div>

            @if(($key+1 % 3 == 0))
            </div>
            <div class="row">
            @endif
        @endforeach
        </div>

        <br />
    </div>
@endsection