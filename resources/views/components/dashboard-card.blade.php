<!-- resources/views/components/total-batches-card.blade.php -->
<a href="{{ $url}}" class="{{ $class }}">
    <div class="icon">
        <img src="{{ asset($icon) }}" alt="">
    </div>
    <div>
        <div class="digit">
            @if (isset($totalBatch))
             {{digitLocale($totalBatch)}}
            @else
             {{digitLocale(0)}}
            @endif
        </div>
        <div class="label">{{ $title }}</div>
    </div>
</a>