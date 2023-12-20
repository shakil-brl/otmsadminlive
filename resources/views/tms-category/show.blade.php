@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Category</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tmsCategory->name }}
                        </div>

        </div>
    </div>
@endsection
