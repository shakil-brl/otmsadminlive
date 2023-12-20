@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Development Partner Empoly</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Profile Id:</strong>
                            {{ $developmentPartnerEmpoly->profile_id }}
                        </div>
                        <div class="form-group">
                            <strong>Development Partner Id:</strong>
                            {{ $developmentPartnerEmpoly->development_partner_id }}
                        </div>
                        <div class="form-group">
                            <strong>Joining Date:</strong>
                            {{ $developmentPartnerEmpoly->joining_date }}
                        </div>
                        <div class="form-group">
                            <strong>Training Batch Id List:</strong>
                            {{ $developmentPartnerEmpoly->training_batch_id_list }}
                        </div>

        </div>
    </div>
@endsection
