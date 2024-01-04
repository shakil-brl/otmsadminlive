@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <div class="card p-5">
            <h3 class="text-center">Upload Document</h3>
            <form class="" action="{{ route('class-documents.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="file-title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="file-title"></input>
                </div>
                <div class="mb-3">
                    <label for="file-description" class="form-label">Description:</label>
                    <textarea class="form-control" id="file-description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">File:</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
@endsection
