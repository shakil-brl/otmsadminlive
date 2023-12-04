<!-- resources/views/components/total-batches-card.blade.php -->
<a href="{{ $url}}" class="{{ $class }}">
    <div class="icon">
        <img src="{{ asset($icon) }}" alt="">
    </div>
    <div>
        <div class="digit">{{ $totalBatch ?? 0 }}</div>
        <div class="label">{{ $title }}</div>
    </div>
</a>