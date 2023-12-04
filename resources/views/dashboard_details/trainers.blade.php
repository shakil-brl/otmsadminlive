@extends('layouts.auth-master')

@section('content')
<div class="card p-6">
    <h3>Trainer List </h3>
    <div class="m-5">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <x-alert />
            <livewire:trainer-profile-table>
                <x-go-back />
        </div>
    </div>
</div>
@endsection