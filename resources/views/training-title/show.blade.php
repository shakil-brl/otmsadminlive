@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Training Title</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $trainingTitle->Name }}
                        </div>
                        <div class="form-group">
                            <strong>Nameen:</strong>
                            {{ $trainingTitle->NameEn }}
                        </div>
                        <div class="form-group">
                            <strong>Trainingareaid:</strong>
                            {{ $trainingTitle->TrainingAreaId }}
                        </div>

        </div>
    </div>
@endsection
