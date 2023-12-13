@extends('layouts.auth-master')
@push('css')
<link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
@endpush
@section('content')
<div class="m-5">
    <div class="row  row-cols-3 g-4" id="total-count">
        {{-- Item --}}
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'superAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DC' ||
        $userRole == 'dc' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            school
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalBatch ?? 0 }}
                </div>
                <div class="label">
                    Total Batch
                </div>
            </a>
        </div>
        @endif
        {{-- Item --}}
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DC' ||
        $userRole == 'dc' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            directions_run
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $runningBatch ?? 0 }}
                </div>
                <div class="label">
                    Running Batch
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            location_on
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalDistrict ?? 0 }}
                </div>
                <div class="label">
                    Total District
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            location_on
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalUpazila ?? 0 }}
                </div>
                <div class="label">
                    Total Upazila
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            store
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalProvider ?? 0 }}
                </div>
                <div class="label">
                    Total vendor
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DC' ||
        $userRole == 'dc' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            admin_panel_settings
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalCoordinator ?? 0 }}
                </div>
                <div class="label">
                    Total Course coordinator
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            emoji_people
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalTrainer ?? 0 }}
                </div>
                <div class="label">
                    Total Trainer
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DC' ||
        $userRole == 'dc' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            local_library
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalStudent ?? 0 }}
                </div>
                <div class="label">
                    Total Trainee
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DC' ||
        $userRole == 'dc' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            voice_over_off
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    0
                </div>
                <div class="label">
                    Dropout Trainee
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'DC' ||
        $userRole == 'dc' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            currency_exchange
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    0
                </div>
                <div class="label">
                    Successful Freelancer
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <div class="icon">
                        <span class="material-icons">
                            cases
                        </span>
                    </div>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    0
                </div>
                <div class="label">
                    Course material
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'SuperAdmin' ||
        $userRole == 'SuperAdmin' ||
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'UNO' ||
        $userRole == 'uno' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <span class="material-icons">
                        payments
                    </span>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    0 / 0
                </div>
                <div class="label">
                    Trainee allowance (Paid / Remaining)
                </div>
            </a>
        </div>
        @endif
        @if ($userRole == 'Admin' || $userRole == 'admin')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <span class="material-icons">
                        cast_for_education
                    </span>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    Click Here
                </div>
                <div class="label">
                    live Streaming Link
                </div>
            </a>
        </div>
        @endif
        @if (
        $userRole == 'Admin' ||
        $userRole == 'admin' ||
        $userRole == 'Provider' ||
        $userRole == 'provider' ||
        $userRole == 'Trainer' ||
        $userRole == 'prainer' ||
        $userRole == 'DPD' ||
        $userRole == 'DPD')
        {{-- Item --}}
        <div>
            <a href="#" class="item link">
                <div class="top">
                    <span class="material-icons">
                        cast_for_education
                    </span>
                    <div class="arrow">
                        <span class="material-icons">
                            north_east
                        </span>
                    </div>
                </div>
                <div class="digit">
                    {{ $totalPresentToday ?? 0 }}
                </div>
                <div class="label">
                    Present trainee today
                </div>
            </a>
        </div>
        @endif


    </div>
    <div class="row mt-4" id="chart">
        <div class="col-8">
            <div class="trainee-area">
                @if (
                $userRole == 'SuperAdmin' ||
                $userRole == 'SuperAdmin' ||
                $userRole == 'Admin' ||
                $userRole == 'admin' ||
                $userRole == 'DC' ||
                $userRole == 'dc' ||
                $userRole == 'UNO' ||
                $userRole == 'uno' ||
                $userRole == 'DPD' ||
                $userRole == 'DPD')
                <div class="top">
                    <div class="total-trainee-label">Total Trainee</div>
                    <a class="arrow" href="">
                        <span class="material-icons">
                            north_east
                        </span>
                    </a>
                </div>

                <div class="digit">
                    {{ $totalStudent ?? 0 }}
                </div>
                @endif

                <div class="grid-items">
                    @if (
                    $userRole == 'SuperAdmin' ||
                    $userRole == 'SuperAdmin' ||
                    $userRole == 'Admin' ||
                    $userRole == 'admin' ||
                    $userRole == 'DC' ||
                    $userRole == 'dc' ||
                    $userRole == 'UNO' ||
                    $userRole == 'uno' ||
                    $userRole == 'DPD' ||
                    $userRole == 'DPD')
                    <div class="item">
                        <div class="label">Successful Freelancer</div>
                        <div>
                            <div class="progress success" style="width: 77%">
                                0
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (
                    $userRole == 'SuperAdmin' ||
                    $userRole == 'SuperAdmin' ||
                    $userRole == 'Admin' ||
                    $userRole == 'admin' ||
                    $userRole == 'DC' ||
                    $userRole == 'dc' ||
                    $userRole == 'UNO' ||
                    $userRole == 'uno' ||
                    $userRole == 'DPD' ||
                    $userRole == 'DPD')
                    <div class="item">
                        <div class="label">Dropout Trainee</div>
                        <div>
                            <div class="progress danger" style="width: 67%">
                                0
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (
                    $userRole == 'SuperAdmin' ||
                    $userRole == 'SuperAdmin' ||
                    $userRole == 'Admin' ||
                    $userRole == 'admin' ||
                    $userRole == 'DPD' ||
                    $userRole == 'DPD')
                    <div class="item">
                        <div class="label">Total Trainer</div>
                        <div>
                            <div class="progress primary" style="width: 57%">
                                {{ $totalTrainer ?? 0 }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (
                    $userRole == 'Trainee' ||
                    $userRole == 'trainee' ||
                    $userRole == 'Admin' ||
                    $userRole == 'admin' ||
                    $userRole == 'DC' ||
                    $userRole == 'dc' ||
                    $userRole == 'UNO' ||
                    $userRole == 'uno' ||
                    $userRole == 'DPD' ||
                    $userRole == 'DPD')
                    <div class="item">
                        <div class="label">Total Coordinator</div>
                        <div>
                            <div class="progress purple" style="width: 37%">
                                {{ $totalCoordinator ?? 0 }}
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- <div class="item">
                        <div class="label">Total Trainee</div>
                        <div>
                            <div class="progress purple" style="width: 37%">
                                1100
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
            <div class="attendance mt-4">
                <div class="top">
                    <div class="total-trainee-label">Total Present Today</div>
                    <a class="arrow" href="">
                        <span class="material-icons">
                            north_east
                        </span>
                    </a>
                </div>

                <div class="digit">
                    {{ $totalPresentToday ?? 0 }}
                </div>
                <canvas id="attendance"></canvas>
            </div>
        </div>
        <div class="col-4">
            @if (
            $userRole == 'SuperAdmin' ||
            $userRole == 'SuperAdmin' ||
            $userRole == 'Admin' ||
            $userRole == 'admin' ||
            $userRole == 'UNO' ||
            $userRole == 'uno' ||
            $userRole == 'DPD' ||
            $userRole == 'DPD')
            <div class="chart">
                <div class="top">
                    <div class="total-trainee-label">Trainee Allowance</div>
                    <a class="arrow" href="">
                        <span class="material-icons">
                            north_east
                        </span>
                    </a>
                </div>

                <div class="digit">
                    5436540
                </div>
                <canvas id="allownce"></canvas>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('allownce');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    'Due',
                    'Paid',
                ],
                datasets: [{
                    label: 'Trainee Allowance',
                    data: [2238576, 3197964],
                    backgroundColor: [
                        '#F97885',
                        '#4ADE80',
                    ],
                    hoverOffset: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'right', // Set the legend position to the right
                        labels: {
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const value = data.datasets[0].data[i];
                                        return {
                                            text: `${label} : ${value}`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: isNaN(value) || value === 0,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                },
            },
        });




        const ctx2 = document.getElementById('attendance');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [
                    'Due',
                    'Paid',
                ],
                datasets: [{
                    label: 'Trainee Allowance',
                    data: [50, 100, 150, 80, 300, 25, 120, 150, 44],
                    backgroundColor: [
                        '#F97885',
                        '#4ADE80',
                    ],
                    hoverOffset: 0
                }]
            },
            // data: data,

        });
</script>
@endpush
{{--
@section('scripts')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/dist/assets/js/custom/apps/calendar/calendar.js') }}"></script>
@endsection --}}

{{-- @push('js')
<script src="{{ asset('assets/dist') }}/assets/js/widgets.bundle.js"></script>
<script src="{{ asset('assets/dist') }}/assets/js/custom/widgets.js"></script>
<script src="{{ asset('assets/dist') }}/assets/js/custom/apps/chat/chat.js"></script>
<script src="{{ asset('assets/dist') }}/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="{{ asset('assets/dist') }}/assets/js/custom/utilities/modals/users-search.js"></script>
@endpush --}}