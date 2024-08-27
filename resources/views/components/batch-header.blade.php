@if ($batch)
    <div id="batch-header" class="mb-1">
        <div>
            <div class="icon">
                <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
            </div>
        </div>
        <div class="row row-cols-4">
            <div class="item">
                <div class="title"> {{ $batch['batchCode'] ?? '' }}</div>
                <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
            </div>
            <div class="item">
                <div class="title">
                    {{ $batch['get_training']['title']['Name'] ?? '' }}
                </div>
                <div class="tag">{{ __('batch-schedule.course_name') }}</div>
            </div>
            <div class="item">
                <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                <div class="tag">{{ __('batch-schedule.address') }}</div>
            </div>
            <div class="item">
                <div class="title">{{ $batch['duration'] ?? '' }}
                    {{ __('batch-schedule.days') }}</div>
                <div class="tag">{{ __('batch-schedule.total_class_days') }}</div>
            </div>
        </div>
    </div>
@endif
