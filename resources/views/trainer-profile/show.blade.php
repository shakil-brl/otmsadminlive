@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Trainer Profile</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Profileid:</strong>
                            {{ $trainerProfile->ProfileId }}
                        </div>
                        <div class="form-group">
                            <strong>Professionalbio:</strong>
                            {{ $trainerProfile->professionalBio }}
                        </div>
                        <div class="form-group">
                            <strong>Review:</strong>
                            {{ $trainerProfile->review }}
                        </div>
                        <div class="form-group">
                            <strong>Rating:</strong>
                            {{ $trainerProfile->rating }}
                        </div>
                        <div class="form-group">
                            <strong>Isactive:</strong>
                            {{ $trainerProfile->isActive }}
                        </div>
                        <div class="form-group">
                            <strong>Creatorprofileid:</strong>
                            {{ $trainerProfile->CreatorProfileId }}
                        </div>

        </div>
    </div>
@endsection
