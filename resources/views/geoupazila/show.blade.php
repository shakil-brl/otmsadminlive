@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Geoupazila</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $geoupazila->Code }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $geoupazila->Name }}
                        </div>
                        <div class="form-group">
                            <strong>Nameeng:</strong>
                            {{ $geoupazila->NameEng }}
                        </div>
                        <div class="form-group">
                            <strong>Parentcode:</strong>
                            {{ $geoupazila->ParentCode }}
                        </div>

        </div>
    </div>
@endsection
