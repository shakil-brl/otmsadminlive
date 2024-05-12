@extends('verify.master')

@section('content')
    <div class="py-4">
        <div class="text-center mb-3">
            <a href="{{ url('verify') }}" class="btn rounded-pill" style="background-color: #2c004e; color:white">Search Again</a>
        </div>

        <div class="text-center">
            <div class="badge-success">
                <img src="{{ asset('img/icon/verified.png') }}" alt="" class="text-center badge-img">
                Varified
            </div>
        </div>

        <div class="text-center">
            <h3 style="" class="mt-3 font-weight-bold">
                {{ $member['trainee']['profile']['KnownAs'] ?? '' }}
            </h3>
        </div>
        <div class="px-5">
            <table class="search-data table-sm table table-striped">
                <tr>
                    <td class="text-right">Certificate No</td>
                    <td>:</td>
                    <td>
                        {{ $id }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Father Name</td>
                    <td>:</td>
                    <td>
                        {{ $member['trainee']['profile']['FatherName'] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Mother Name</td>
                    <td>:</td>
                    <td>
                        {{ $member['trainee']['profile']['MotherName'] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Training Title </td>
                    <td>:</td>
                    <td>
                        {{ $member['trainee']['training_batch']['training']['title']['NameEn'] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Batch Code</td>
                    <td>:</td>
                    <td>
                        {{ $member['trainee']['training_batch']['batchCode'] ?? '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
