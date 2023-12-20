@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Holly Day</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Day Name En:</strong>
                            {{ $tmsHollyDay->day_name_en }}
                        </div>
                        <div class="form-group">
                            <strong>Day Name Bn:</strong>
                            {{ $tmsHollyDay->day_name_bn }}
                        </div>
                        <div class="form-group">
                            <strong>Holly Bay:</strong>
                            {{ $tmsHollyDay->holly_bay }}
                        </div>

        </div>
    </div>
@endsection
