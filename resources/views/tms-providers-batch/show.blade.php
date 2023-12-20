@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Providers Batch</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $tmsProvidersBatch->provider_id }}
                        </div>
                        <div class="form-group">
                            <strong>Batch Ids:</strong>
                            {{ $tmsProvidersBatch->batch_ids }}
                        </div>
                        <div class="form-group">
                            <strong>Created User Id:</strong>
                            {{ $tmsProvidersBatch->created_user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tms Group Id:</strong>
                            {{ $tmsProvidersBatch->tms_group_id }}
                        </div>

        </div>
    </div>
@endsection
