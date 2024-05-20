@extends('front.master')

@section('content')
    <div class="py-4">
        <div class="text-center mb-3">
            <a href="{{ url('verify') }}" class="btn btn-primary rounded-pill">Search Again</a>
        </div>
        <div class="text-center user-img">
            @php
                if (file_exists($member->photo)) {
                    $img = $member->photo;
                } else {
                    $img = 'img/avater.svg';
                }
            @endphp
            <img alt="Photo" class="rounded-circle" height="150" width="150" src="{{ asset($img) }}">
        </div>
        <div class="text-center">
            <h3 style="" class="mt-3 font-weight-bold">
                {{ $member->name ?? '' }}
            </h3>
        </div>
        <div>
            <table class="search-data table-sm table table-striped">
                <tr>
                    <td class="text-right">ID No</td>
                    <td>:</td>
                    <td>
                        {{ $member->id_no ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right w-50">Full Name</td>
                    <td>:</td>
                    <td class="w-50">
                        {{ $member->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Father</td>
                    <td>:</td>
                    <td>
                        {{ $member->father ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Mother</td>
                    <td>:</td>
                    <td>
                        {{ $member->mother ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Degree Name </td>
                    <td>:</td>
                    <td>
                        {{ $member->degree ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Earned Credit</td>
                    <td>:</td>
                    <td>
                        {{ $member->credit ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">CGPA</td>
                    <td>:</td>
                    <td>
                        {{ $member->cgpa ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Completion Semester </td>
                    <td>:</td>
                    <td>
                        {{ $member->completion_semester ?? '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
