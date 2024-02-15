<div id="alertMessage">
    @if (session()->has('message'))
        @php
            $alertType = 'warning';
            if (session()->has('type')) {
                if (session('type') == 'Success') {
                    $alertType = 'success';
                } elseif (session('type') == 'Warning') {
                    $alertType = 'warning';
                } elseif (session('type') == 'Danger') {
                    $alertType = 'danger';
                } elseif (session('type') == 'Failed') {
                    $alertType = 'danger';
                } elseif (session('type') == 'Info') {
                    $alertType = 'info';
                }
            }
        @endphp
        <div class="alert close alert-{{ $alertType }} alert-dismissible fade show my-2" role="alert">
            @if (session()->has('type'))
                <strong>{{ session('type') }} : </strong>
            @endif
            @if (is_string(session('message')))
                {{ session('message') ?? '' }}
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
@push('js')
    <script>
        setTimeout(function() {
            $('#alertMessage').fadeOut('slow');
        }, 5000);
    </script>
@endpush
