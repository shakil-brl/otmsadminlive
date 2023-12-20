@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Providers Trainer</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $tmsProvidersTrainer->provider_id }}
                        </div>
                        <div class="form-group">
                            <strong>Batch Id:</strong>
                            {{ $tmsProvidersTrainer->batch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Profileid:</strong>
                            {{ $tmsProvidersTrainer->ProfileId }}
                        </div>

        </div>
    </div>
@endsection
