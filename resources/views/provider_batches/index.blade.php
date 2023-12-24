@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="container-fluid">
        <div class="row mt-8">
            <h2 class="mb-5 mb-3 text-center">Report</h2>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" placeholder="search" class="form-control form-select-lg mb-3">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <select id="division" class="form-select form-select-lg mb-3" aria-label=".form-select-lg"
                        data-control="select2">
                        <option value="">Select Division</option>
                        <option value="30">Dhaka</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select id="district" class="form-select form-select-lg mb-3" aria-label=".form-select-lg"
                        data-control="select2">
                        <option value="">Select District</option>
                        <option value="30">Dhaka</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select id="upazila" class="form-select form-select-lg mb-3" aria-label=".form-select-lg"
                        data-control="select2">
                        <option value="">Select Upazila</option>
                        <option value="30">Dhaka</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Search</button>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col py-3 ">
                <table class="table table-bordered table-responsive bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>S/N</th>
                            <th>Vendor Name</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Upazila</th>
                            <th>Course Name</th>
                            <th>Running Batch</th>
                            <th>Trainee</th>
                            <th>Dropout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="strip-color">
                            <td>1</td>
                            <td> Oceanize </td>
                            <td>
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td>বরিশাল</td>
                                    </tr>
                                    <tr>
                                        <td>চট্টগ্রাম</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকা</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td>চট্টগ্রাম</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকা</td>
                                    </tr>
                                    <tr>
                                        <td>বরিশাল</td>
                                    </tr>
                                    <tr>
                                        <td>খুলনা</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td>আমতলী</td>
                                    </tr>
                                    <tr>
                                        <td>বরগুনা সদর</td>
                                    </tr>
                                    <tr>
                                        <td>বেতাগী</td>
                                    </tr>
                                    <tr>
                                        <td>পাথরঘাটা</td>
                                    </tr>
                                    <tr>
                                        <td>তালতলি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>Graphis Design</td>
                            <td>Running batch 25 out of 35</td>
                            <td>Total 200 trainee out of 250</td>
                            <td>4</td>
                        </tr>
                        <tr class="strip-color">
                            <td>2</td>
                            <td>Cybridge</td>
                            <td>
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td>বরিশাল</td>
                                    </tr>
                                    <tr>
                                        <td>চট্টগ্রাম</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকা</td>
                                    </tr>
                                    <tr>
                                        <td>রাজশাহী</td>
                                    </tr>
                                    <tr>
                                        <td>সিলেট</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td>চট্টগ্রাম</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকা</td>
                                    </tr>
                                    <tr>
                                        <td>বরিশাল</td>
                                    </tr>
                                    <tr>
                                        <td>খুলনা</td>
                                    </tr>
                                    <tr>
                                        <td>বরগুনা</td>
                                    </tr>
                                    <tr>
                                        <td>ভোলা</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td>আমতলী</td>
                                    </tr>
                                    <tr>
                                        <td>বরগুনা সদর</td>
                                    </tr>
                                    <tr>
                                        <td>বেতাগী</td>
                                    </tr>
                                    <tr>
                                        <td>পাথরঘাটা</td>
                                    </tr>
                                    <tr>
                                        <td>তালতলি</td>
                                    </tr>
                                    <tr>
                                        <td>আমতলী</td>
                                    </tr>
                                    <tr>
                                        <td>বরগুনা সদর</td>
                                    </tr>
                                    <tr>
                                        <td>বেতাগী</td>
                                    </tr>
                                    <tr>
                                        <td>পাথরঘাটা</td>
                                    </tr>
                                    <tr>
                                        <td>তালতলি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>Basic Programming</td>
                            <td>Running batch 23 out of 30</td>
                            <td>Total 200 trainee out of 250</td>
                            <td>9</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
