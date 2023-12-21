@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="container-fluid">
        <div class="row mt-10">
            <div class="">
                <h4>Developer Parter: Babylon Resource Ltd.</h4>
                <div>Email: akash09joarder@gmail.com</div>
                <div>Phone: +8801680525344</div>
                <div>Address: Chashara, Narayanganj </div>
            </div>
        </div>
        <div class="row">
            <div class="col py-3 ">
                <table class="table table-bordered table-responsive bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>S/N</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Upazila</th>
                            <th>Total Trainee</th>
                            <th>Running Batch</th>
                            <th>Dropout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="strip-color">
                            <td>1</td>
                            <td> Dhaka </td>
                            <td>
                                Narayanganj
                            </td>
                            <td>Narayanganj Sadar</td>
                            <td>25</td>
                            <td>35</td>
                            <td>4</td>
                        </tr>
                        <tr class="strip-color">
                            <td>2</td>
                            <td> Dhaka </td>
                            <td>
                                Narayanganj
                            </td>
                            <td>Narayanganj Sadar</td>
                            <td>23</td>
                            <td>35</td>
                            <td>4</td>
                        </tr>
                        <tr class="strip-color">
                            <td>3</td>
                            <td> Dhaka </td>
                            <td>
                                Narayanganj
                            </td>
                            <td>Narayanganj Sadar</td>
                            <td>35</td>
                            <td>35</td>
                            <td>4</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
