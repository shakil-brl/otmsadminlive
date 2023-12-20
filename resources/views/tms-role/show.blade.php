@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Role</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tmsRole->name }}
                        </div>

        </div>
    </div>
@endsection
