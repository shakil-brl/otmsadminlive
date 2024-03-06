@extends('layouts.auth-master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1;
        }

        .rating {
            display: inline-block;
        }

        .rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked~label {
            color: #f8d301;
        }
    </style>

    <style>
        star-rating {
            --star-rating-max-stars: 10;
            --star-rating-star-size: 1.3;
            --star-rating-star-color-disabled: #555;
            --star-rating-star-color-hover: goldenrod;
            --star-rating-star-color-selected: var(--star-rating-star-color-hover);
            --star-rating-star-color-active: yellow;
            --star-rating-star-color: currentColor;
            --star-rating-star-scale-hover: 1.3;

            display: grid;
            grid-template-columns: repeat(var(--star-rating-max-stars), 1fr);
            width: fit-content;

            & label {
                cursor: pointer;
                display: none;
                text-align: center;
            }

            & input {
                appearance: none;
                color: rgb(134, 134, 134);
                cursor: pointer;
                font-size: 25px;
                grid-row: 1;
                height: auto;
                margin: 0;
                padding: 0.2rem;
                text-align: center;
                transition: all 0.2s ease-out;
                width: auto;
            }

            & input:after {
                content: "\2606";
            }

            & input:hover:after {
                color: var(--star-rating-star-color-hover);
                content: "\2605";
            }

            & input:checked:after {
                color: var(--star-rating-star-color-selected);
                content: "\2605";
            }

            & input:has(~ input:hover):after,
            & input:has(~ input:checked):after,
            & input:has(~ input:focus):after {
                color: var(--star-rating-star-color-selected);
                content: "\2605";
            }

            & input:hover~input:after {
                color: var(--star-rating-star-color);
                content: "\2606";
            }

            @media (hover) {
                & input:hover {
                    transform: scale(var(--star-rating-star-scale-hover));
                }

                & input:active {
                    transform: scale(calc(var(--star-rating-star-scale-hover) + 0.3));
                }

                & input:active:after {
                    animation: 0.1s linear 0s forwards star-rating-active-anim;
                }
            }
        }

        @keyframes star-rating-active-anim {
            from {
                color: var(--star-rating-star-color-hover);
            }

            to {
                color: var(--star-rating-star-color-active);
            }
        }

        star-rating[showlabels] {
            & label {
                display: inline;
            }

            & input {
                grid-row: 2;
            }
        }

        star-rating[disabled] {

            & label,
            & input {
                pointer-events: none;
            }

            & label,
            & input:after,
            & input:has(~ input:hover):after,
            & input:has(~ input:checked):after,
            & input:has(~ input:focus):after {
                color: var(--star-rating-star-color-disabled);
            }
        }
    </style>
@endpush
@section('content')
    <div class="m-4">
        <div id="batch-header">
            <div>
                <div class="icon">
                    <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title"> {{ $student['training_batch']['batchCode'] ?? '' }}
                    </div>
                    <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                </div>
                <div class="item">
                    <div class="title">
                        {{ $student['training_batch']['GEOLocation'] ?? '' }}</div>
                    <div class="tag">Location #</div>
                </div>
                <div class="item">
                    <div class="title">{{ $student['profile']['KnownAsBangla'] ?? '' }}</div>
                    <div class="tag">{{ 'Student Name' }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $student['profile']['KnownAsBangla'] ?? '' }}</div>
                    <div class="tag">Fathers Name</div>
                </div>
            </div>
        </div>
        <!--begin::Content-->
        <div id="class-days">
            <div class="m-0">
                <form id="formSubmit" method="POST"
                    action="{{ route('trainer-schedule-details.store-student-evaluation', $student['id']) }}">
                    @csrf
                    <input type="hidden" name="schedule_detail_id" value="" />

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="students">

                        @foreach ($heads as $question)
                            <div class="student">
                                <div class="row row-cols-3 align-items-center">
                                    <div>
                                        <div class="label">সিরিয়াল #</div>
                                        <div class="text">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                    <div>
                                        <label for="student{{ $loop->iteration }}" class="">
                                            <div class="label">মূল্যায়ন প্রশ্ন</div>
                                            <div class="text">{{ $question['title'] }}</div>
                                        </label>
                                    </div>
                                    <div>

                                        @if ($question['is_bool'] == 1)
                                            <label class="">
                                                <div class="label">হ্যাঁ/না</div>
                                                <div class="form-check form-switch my-4">

                                                    <div class="text"><input name="heads[{{ $question['id'] }}]"
                                                            class="form-check-input" type="checkbox" role="switch"
                                                            id="student{{ $loop->iteration }}"
                                                            value="{{ $question['mark'] }}">
                                                    </div>
                                                </div>

                                            </label>
                                        @else
                                            <label class="">
                                                <div class="label">মূল্যনির্ধারণ</div>
                                                <star-rating>
                                                    @foreach (range(1, $question['max_value']) as $max_val)
                                                        <label style="font-size: 14px;"
                                                            for="{{ $question['id'] . $loop->iteration }}">{{ $max_val }}</label>
                                                        <input type="radio" id="{{ $question['id'] . $loop->iteration }}"
                                                            name="heads[{{ $question['id'] }}]"
                                                            value="{{ $max_val }}" />
                                                    @endforeach
                                                </star-rating>

                                            </label>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-2 mt-10 m-auto">
                            <div id="attendance-bottom">
                                <div class="right">
                                    <button class="btn btn-attendance submit" name="submit" id="submit"
                                        value="attendance">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
