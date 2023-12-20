@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms Providers Batch</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('providers-batche.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-providers-batch.form')

            </form>
        </div>
    </div>
@endsection
