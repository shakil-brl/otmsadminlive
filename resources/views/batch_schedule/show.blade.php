@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Schedule</h3>
        <div>
            <h4>Batch Code: Batch 001</h4>
            <div>Course Name: Digital Marketing</div>
            <div>Start Date: 11/11/2023</div>
            <div>Total Class: 55</div>
            <div>Location: মিঠামইন, কিশোরগঞ্জ </div>
        </div>
        <br>
        <table class="table table-bordered bg-white">
            <thead>
                <th>SL</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach (range(1, 10) as $batch)
                    @php
                        $status = rand(1, 0);
                    @endphp
                    <tr>
                        <td>{{ $batch }}</td>
                        <td>{{ fake()->name() }}</td>
                        <td>
                            <input type="checkbox" checked name="" id="">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-between">
            <a href="" class="btn btn-info">Submity Attendance</a>
            <a href="" class="btn btn-danger">End Class</a>
        </div>
    </div>
@endsection
