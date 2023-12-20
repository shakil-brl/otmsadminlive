@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Geodistrict</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $geodistrict->Code }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $geodistrict->Name }}
                        </div>
                        <div class="form-group">
                            <strong>Nameeng:</strong>
                            {{ $geodistrict->NameEng }}
                        </div>
                        <div class="form-group">
                            <strong>Parentcode:</strong>
                            {{ $geodistrict->ParentCode }}
                        </div>

        </div>
    </div>
@endsection
