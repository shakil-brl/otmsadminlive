@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <div class="m-5">
        <x-alert />
        @if (session('error_message'))
            <ul class="m-0 text-danger">
                @foreach (session('error_message') ?? [] as $neme => $err)
                    @foreach ($err as $e)
                        <li>
                            {{ $e }}
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @endif

        <div>
            @isset($batch)
                <div class="mb-4 mx-4">
                    <div id="batch-header">
                        <div>
                            <div class="icon">
                                <img src="{{ asset('img/new_icon') }}/batch_head.png" alt="">
                            </div>
                        </div>
                        <div class="row row-cols-4">
                            <div class="item">
                                <div class="title">Batch{{ $batch['id'] }}</div>
                                <div class="tag">ব্যাচ কোড #{{ $batch['batchCode'] ?? '' }}</div>
                            </div>
                            <div class="item">
                                <div class="title">{{ $batch['get_training']['title']['Name'] ?? '' }}</div>
                                <div class="tag">কোর্সের নাম</div>
                            </div>
                            <div class="item">
                                <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                                <div class="tag">ঠিকানা</div>
                            </div>
                            <div class="item">
                                <div class="title">{{ $batch['duration'] ?? '' }} দিন</div>
                                <div class="tag">মোট ক্লাস সময়কাল</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end pe-4">
                    @if (in_array('certificates.eligible', $roleRoutePermissions) &&
                            collect($batch['trainees'])->contains(
                                fn($trainee) => isset($trainee['certificate']) && $trainee['certificate']['is_eligible']))
                        <a href="{{ route('certificates.eligible', [encrypt($batch['id'])]) }}"
                            class="btn btn-md btn-warning mb-4">
                            Print Certificate
                        </a>
                    @endif
                </div>
                <div class="card mx-4">
                    <div class="card-body py-4 mt-5">
                        <h3 class="mt-5">Trainee List</h3>
                        <form action="{{ route('certificates.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="batch_id" id="" value="{{ $batch['id'] }}">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Email-NID</th>
                                        <th>Phone</th>
                                        <th class="d-flex align-item-center gap-2 justify-content-center">
                                            <label for="selectAll">Distribute</label>

                                            @if (!$has_certificate && in_array('certificates.store', $roleRoutePermissions))
                                                <input type="checkbox" id="selectAll" class="form-check-input">
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (collect($batch['trainees']) as $trainee)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>
                                                <div>
                                                    English: {{ $trainee['profile']['KnownAs'] ?? '' }}
                                                </div>
                                                <div>
                                                    Bangla: {{ $trainee['profile']['KnownAsBangla'] ?? '' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    Email: {{ $trainee['profile']['Email'] ?? '' }}
                                                </div>
                                                <div>
                                                    NID: {{ $trainee['profile']['NID'] ?? '' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    Phone: {{ $trainee['profile']['Phone'] ?? '' }}
                                                </div>
                                                <div>
                                                    Phone-2: {{ $trainee['profile']['Phone2'] ?? '' }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $disabled = !in_array('certificates.store', $roleRoutePermissions)
                                                        ? 'disabled'
                                                        : '';
                                                @endphp
                                                @if (isset($trainee['certificate']))
                                                    @if ($trainee['certificate']['is_eligible'])
                                                        <input class="trainee form-check-input" name="training_applicant_ids[]"
                                                            value="{{ $trainee['id'] }}" id="att{{ $loop->iteration }}"
                                                            type="checkbox" checked {{ $disabled }}>
                                                    @else
                                                        <input class="trainee form-check-input" name="training_applicant_ids[]"
                                                            value="{{ $trainee['id'] }}" id="att{{ $loop->iteration }}"
                                                            type="checkbox" {{ $disabled }}>
                                                    @endif
                                                @else
                                                    <input class="trainee form-check-input" name="training_applicant_ids[]"
                                                        value="{{ $trainee['id'] }}" id="att{{ $loop->iteration }}"
                                                        type="checkbox" {{ $disabled }}>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @error('training_applicant_ids')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                            @if (in_array('certificates.store', $roleRoutePermissions))
                                <div class="text-center my-5">
                                    <button type="submit" class="btn btn-lg btn-success sumbit-form">Submit</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#selectAll").click(function() {
                if ($(this).prop('checked')) {
                    $('.trainee').prop('checked', true);
                } else {
                    $('.trainee').prop('checked', false);
                }
            });
        });

        $(document).on("click", ".sumbit-form", function(e) {
            e.preventDefault();
            const form = $(this).closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to submit the form?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, sumbit!",
                cancelButtonText: "No, cancel!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
