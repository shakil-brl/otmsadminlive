@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms Providers Batch</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('providers-batche.update', $tmsProvidersBatch->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-providers-batch.form')

            </form>
        </div>
    </div>
@endsection
