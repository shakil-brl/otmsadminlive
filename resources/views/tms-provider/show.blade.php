@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Provider</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tmsProvider->name }}
                        </div>
                        <div class="form-group">
                            <strong>Mobile:</strong>
                            {{ $tmsProvider->mobile }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $tmsProvider->email }}
                        </div>
                        <div class="form-group">
                            <strong>Web Url:</strong>
                            {{ $tmsProvider->web_url }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $tmsProvider->address }}
                        </div>
                        <div class="form-group">
                            <strong>Created User Id:</strong>
                            {{ $tmsProvider->created_user_id }}
                        </div>

        </div>
    </div>
@endsection
