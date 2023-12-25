@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Class Documentations</h3>
        <x-alert />
        @isset($classDocs)
            <div class="my-3 d-flex">
                <div class="w-100">
                    <form action="">
                        <div class="d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="{{ 'search documentation title & type' }}">
                            <input type="submit" class="form-control btn btn-primary w-25" value="{{ 'Search' }}">
                        </div>
                    </form>
                </div>
                <div class="w-100 text-end">
                    <a href="#" class="btn btn-lg btn-info me-1" data-bs-toggle="modal" data-bs-target="#create_class_doc"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                        title="Create Class Documentations">
                        Create Class Documentations
                    </a>
                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>Doc Title</th>
                    <th>Description</th>
                    <th>Doc File</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($classDocs) as $doc)
                        @php
                            $extention = [];
                            if ($doc['document_path']) {
                                $extention = explode('.', $doc['document_path']);
                            }
                        @endphp
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $doc['document_title'] ?? '' }}
                            </td>
                            <td>
                                {{ $doc['description'] ?? '' }}
                            </td>
                            <td>
                                <a href="#">
                                    <div class="symbol symbol-50px me-5">

                                        @if (isset($extention[1]))
                                            @if ($extention[1] == 'pdf')
                                                <img src="{{ asset('img/file_icon/pdf.svg') }}"
                                                    class="theme-light-show" alt="" />
                                                <img src="{{ asset('img/file_icon/pdf-dark.svg') }}"
                                                    class="theme-dark-show" alt="" />
                                            @elseif($extention[1] == 'doc')
                                                <img src="{{ asset('img/file_icon/doc.svg') }}"
                                                    class="theme-light-show" alt="" />
                                                <img src="{{ asset('img/file_icon/doc-dark.svg') }}"
                                                    class="theme-dark-show" alt="" />
                                            @elseif($extention[1] == 'excel' && $extention[1] == 'xlsx')
                                                <img src="{{ asset('img/file_icon/xml.svg') }}"
                                                    class="theme-light-show" alt="" />
                                                <img src="{{ asset('img/file_icon/xml-dark.svg') }}"
                                                    class="theme-dark-show" alt="" />
                                            @else
                                                <img src="{{ asset('img/file_icon/blank.svg') }}"
                                                    class="theme-light-show" alt="" />
                                                <img src="{{ asset('img/file_icon/blank-dark.svg') }}"
                                                    class="theme-dark-show" alt="" />
                                            @endif  
                                        @else
                                            <img src="{{ asset('img/file_icon/blank.svg') }}"
                                                class="theme-light-show" alt="" />
                                            <img src="{{ asset('img/file_icon/blank-dark.svg') }}"
                                                class="theme-dark-show" alt="" />
                                        @endif

                                    </div>
                                </a>

                            </td>
                            <td>

                                <a href="" class="btn btn-sm btn-primary me-1 show-action" title="Details">
                                    view
                                </a>
                                <a href="#" class="btn btn-sm btn-info me-1 edit" data-id=""
                                    data-bs-toggle="modal" data-bs-target="#edit" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom" title="Edit">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger delete" data-id=""
                                    data-name="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                    data-bs-placement="bottom" title="Delete">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
    <!--end::Content-->

@section('script')
    <script></script>
@endsection

@endsection
