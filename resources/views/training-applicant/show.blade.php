@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Training Applicant</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Profileid:</strong>
                            {{ $trainingApplicant->ProfileId }}
                        </div>
                        <div class="form-group">
                            <strong>Trainingtitleid:</strong>
                            {{ $trainingApplicant->TrainingTitleId }}
                        </div>
                        <div class="form-group">
                            <strong>Batchid:</strong>
                            {{ $trainingApplicant->BatchId }}
                        </div>
                        <div class="form-group">
                            <strong>Applicationdate:</strong>
                            {{ $trainingApplicant->ApplicationDate }}
                        </div>
                        <div class="form-group">
                            <strong>Marks:</strong>
                            {{ $trainingApplicant->Marks }}
                        </div>
                        <div class="form-group">
                            <strong>Isselected:</strong>
                            {{ $trainingApplicant->IsSelected }}
                        </div>
                        <div class="form-group">
                            <strong>Isrejected:</strong>
                            {{ $trainingApplicant->IsRejected }}
                        </div>
                        <div class="form-group">
                            <strong>Istrainee:</strong>
                            {{ $trainingApplicant->IsTrainee }}
                        </div>
                        <div class="form-group">
                            <strong>Isdroppedout:</strong>
                            {{ $trainingApplicant->isDroppedOut }}
                        </div>
                        <div class="form-group">
                            <strong>Droppedoutreason:</strong>
                            {{ $trainingApplicant->droppedOutReason }}
                        </div>
                        <div class="form-group">
                            <strong>Droppedoutbyprofileid:</strong>
                            {{ $trainingApplicant->droppedOutByProfileId }}
                        </div>
                        <div class="form-group">
                            <strong>Droppedoutdate:</strong>
                            {{ $trainingApplicant->droppedOutDate }}
                        </div>

        </div>
    </div>
@endsection
