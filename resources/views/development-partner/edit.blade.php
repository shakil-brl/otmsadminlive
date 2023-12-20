@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Development Partner</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('development-partner.update', $developmentPartner->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('development-partner.form')

            </form>
        </div>
    </div>
@endsection
