@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Batch Group</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name Bn:</strong>
                            {{ $tmsBatchGroup->name_bn }}
                        </div>
                        <div class="form-group">
                            <strong>Name En:</strong>
                            {{ $tmsBatchGroup->name_en }}
                        </div>
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $tmsBatchGroup->code }}
                        </div>
                        <div class="form-group">
                            <strong>Remark:</strong>
                            {{ $tmsBatchGroup->remark }}
                        </div>

        </div>
    </div>
@endsection
