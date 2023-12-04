@extends('layouts.auth-master')

@section('template_title')
Tms Inspection
@endsection

@section('content')
<div class="m-5">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card p-6">
            <h3>Tms Inspection List</h3>
            <x-alert />
            <livewire:inspection>
        </div>

    </div>
</div>
</div>
@endsection