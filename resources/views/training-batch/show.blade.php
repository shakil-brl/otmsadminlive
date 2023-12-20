@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Training Batch</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Batchcode:</strong>
                            {{ $trainingBatch->batchCode }}
                        </div>
                        <div class="form-group">
                            <strong>Trainingid:</strong>
                            {{ $trainingBatch->trainingId }}
                        </div>
                        <div class="form-group">
                            <strong>Geocode:</strong>
                            {{ $trainingBatch->GEOCode }}
                        </div>
                        <div class="form-group">
                            <strong>Totaltrainees:</strong>
                            {{ $trainingBatch->totalTrainees }}
                        </div>
                        <div class="form-group">
                            <strong>Startdate:</strong>
                            {{ $trainingBatch->startDate }}
                        </div>
                        <div class="form-group">
                            <strong>Lastapplicationdate:</strong>
                            {{ $trainingBatch->lastApplicationDate }}
                        </div>
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $trainingBatch->provider_id }}
                        </div>
                        <div class="form-group">
                            <strong>Trainingproviderorgid:</strong>
                            {{ $trainingBatch->TrainingProviderOrgId }}
                        </div>
                        <div class="form-group">
                            <strong>Geolocation:</strong>
                            {{ $trainingBatch->GEOLocation }}
                        </div>
                        <div class="form-group">
                            <strong>Trainingvenue:</strong>
                            {{ $trainingBatch->TrainingVenue }}
                        </div>
                        <div class="form-group">
                            <strong>Duration:</strong>
                            {{ $trainingBatch->duration }}
                        </div>

        </div>
    </div>
@endsection
