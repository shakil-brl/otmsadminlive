@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms Providers Trainer</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('providers-trainer.update', $tmsProvidersTrainer->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-providers-trainer.form')

            </form>
        </div>
    </div>
@endsection
