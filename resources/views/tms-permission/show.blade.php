@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Permission</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tmsPermission->name }}
                        </div>
                        <div class="form-group">
                            <strong>Route Name:</strong>
                            {{ $tmsPermission->route_name }}
                        </div>
                        <div class="form-group">
                            <strong>Guard Name:</strong>
                            {{ $tmsPermission->guard_name }}
                        </div>

        </div>
    </div>
@endsection
