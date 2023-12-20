@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Geodivision</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $geodivision->Code }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $geodivision->Name }}
                        </div>
                        <div class="form-group">
                            <strong>Nameeng:</strong>
                            {{ $geodivision->NameEng }}
                        </div>

        </div>
    </div>
@endsection
