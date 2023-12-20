@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Course</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name Bn:</strong>
                            {{ $tmsCourse->name_bn }}
                        </div>
                        <div class="form-group">
                            <strong>Name En:</strong>
                            {{ $tmsCourse->name_en }}
                        </div>

        </div>
    </div>
@endsection
