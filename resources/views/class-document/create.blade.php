@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <div class="card p-5">
            <h3 class="text-center">Upload Document</h3>
            @if (session('error_message'))
                {{-- @dump(session('error_message')) --}}
                <ul class="text-danger">
                    @foreach (session('error_message') ?? [] as $neme => $err)
                        @foreach ($err as $e)
                            <li>
                                {{ $e }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            @endif
            {{-- <x-alert /> --}}

            <form class="" action="{{ route('class-documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tms_batch_schedule_detail_id" value="{{ $schedule_details_id }}">
                <div class="mb-3">
                    <label for="file-title" class="form-label">Title:</label>
                    <input type="text" name="document_title" class="form-control" id="file-title"
                        value="{{ old('document_title') }}"></input>
                    @error('document_title')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file-description" class="form-label">Description:</label>
                    <textarea class="form-control" name="description" id="file-description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">File:</label>
                    <input class="form-control" type="file" name="doc_file" id="formFile">
                    @error('doc_file')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
@endsection
