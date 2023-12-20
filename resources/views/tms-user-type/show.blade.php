@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms User Type</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Role Id:</strong>
                            {{ $tmsUserType->role_id }}
                        </div>
                        <div class="form-group">
                            <strong>Profileid:</strong>
                            {{ $tmsUserType->ProfileId }}
                        </div>
                        <div class="form-group">
                            <strong>District Id:</strong>
                            {{ $tmsUserType->district_id }}
                        </div>
                        <div class="form-group">
                            <strong>Upazila Id:</strong>
                            {{ $tmsUserType->upazila_id }}
                        </div>
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $tmsUserType->provider_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created User Id:</strong>
                            {{ $tmsUserType->created_user_id }}
                        </div>

        </div>
    </div>
@endsection
