@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Class Document</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Tms Batch Schedule Detail Id:</strong>
                            {{ $tmsClassDocument->tms_batch_schedule_detail_id }}
                        </div>
                        <div class="form-group">
                            <strong>Document Title:</strong>
                            {{ $tmsClassDocument->document_title }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $tmsClassDocument->description }}
                        </div>
                        <div class="form-group">
                            <strong>Document Path:</strong>
                            {{ $tmsClassDocument->document_path }}
                        </div>
                        <div class="form-group">
                            <strong>Tms Course Id:</strong>
                            {{ $tmsClassDocument->tms_course_id }}
                        </div>
                        <div class="form-group">
                            <strong>Doc Type:</strong>
                            {{ $tmsClassDocument->doc_type }}
                        </div>

        </div>
    </div>
@endsection
