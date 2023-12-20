@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Development Partner</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $developmentPartner->name }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $developmentPartner->address }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $developmentPartner->email }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $developmentPartner->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Is Active:</strong>
                            {{ $developmentPartner->is_active }}
                        </div>
                        <div class="form-group">
                            <strong>Blocked:</strong>
                            {{ $developmentPartner->blocked }}
                        </div>

        </div>
    </div>
@endsection
