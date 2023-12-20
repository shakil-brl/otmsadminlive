@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Role Has Permission</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Permission Id:</strong>
                            {{ $tmsRoleHasPermission->permission_id }}
                        </div>
                        <div class="form-group">
                            <strong>Role Id:</strong>
                            {{ $tmsRoleHasPermission->role_id }}
                        </div>

        </div>
    </div>
@endsection
