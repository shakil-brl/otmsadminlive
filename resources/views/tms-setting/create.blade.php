@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <div class="card p-5">
            <h3 class="text-center">Create setting</h3>
            @if (session('error_message'))
                <ul class="text-danger">
                    @foreach (session('error_message') ?? [] as $name => $err)
                        @foreach ($err as $e)
                            <li>
                                {{ $e }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            @endif

            <div class="border rounded p-5 mt-5">
                <form class="" action="{{ route('tms-settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @include('tms-setting.form')
                    
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var uploadTypeSelect = document.getElementById('upload_type');
            var fileInputDiv = document.getElementById('file_input');
            var textInputDiv = document.getElementById('text_input');

            uploadTypeSelect.addEventListener('change', function() {
                if (this.value === 'file') {
                    fileInputDiv.style.display = 'block';
                    textInputDiv.style.display = 'none';
                } else if (this.value === 'text') {
                    fileInputDiv.style.display = 'none';
                    textInputDiv.style.display = 'block';
                }
            });
        });

        ClassicEditor
            .create(document.querySelector('#text'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
