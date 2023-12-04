<div>

    @if ($design)
    <span class="d-inline-block py-2 px-3 rounded {{ $value ? 'bg-success' : 'bg-danger' }} text-white"> {{ $value ?
        'হ্যাঁ' : 'না' }}</span>
    @else
    {{ $value ? 'হ্যাঁ' : 'না' }}
    @endif

</div>