<div>
    <div class="">

        <div class="row g-4">
            <div class="col-3">
                <label for="">Select a Course</label>
                <select wire:model='course_id' class="form-select">
                    <option value="">Select Course</option>
                    @foreach ($courses['data'] ?? [] as $course)
                        <option value="{{ $course['id'] }}">{{ $course['Name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <label for="">Select a Division</label>
                <select wire:model='division_id' class="form-select">
                    <option value="">Select Division</option>
                    @foreach ($divisions['data'] ?? [] as $division)
                        <option value="{{ $division['division_code'] }}">
                            {{ $division['division_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <label for="">Select a District</label>
                <select wire:model='district_id' class="form-select">
                    <option value="">Select District</option>
                    @foreach ($districts['data'] ?? [] as $district)
                        <option value="{{ $district['district_code'] }}">
                            {{ $district['district_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <label for="">Batch</label>
                <input wire:model='batch' type="text" class="form-control">
            </div>
        </div>
    </div>

    <br>
    <div class="row g-4">
        @foreach ($batches['data'] ?? [] as $batch)
            <div>
                <div class="bg-white rounded p-4 d-flex">
                    <div style="width: 33.33%;">
                        <span class="mb-3 d-inline-block bg-gray-200 p-2 rounded">
                            Batch: {{ $batch['batchCode'] ?? '' }}
                        </span> <br>
                        Course Name: <b>{{ $batch['get_training']['title']['Name'] ?? '' }} </b><br>
                        From: <b>{{ $batch['startDate'] ?? '' }}</b> <br>
                        To: 11/11/022 <br>
                        Duration: <b> {{ $batch['duration'] ?? '' }}</b> <br>
                        Vendor Name: <b>{{ $batch['provider']['name'] ?? '' }}</b> <br>
                        Vendor Details: <b>{{ $batch['provider']['mobile'] ?? '' }},
                            {{ $batch['provider']['email'] ?? '' }}</b>
                        <br>
                    </div>
                    <div style="width: 33.33%;">
                        Trainer Details: <br>
                        Name: Abdullah Al Mamun <br>
                        Experience: 3 Years <br>
                        Rating: 5
                    </div>
                    <div style="width: 33.33%;">
                        Training Hour: <b>{{ $batch['get_training']['totalHours'] ?? '' }} </b><br>
                        Number of Class: 40 <br>
                        Remaining Class: 10 <br>
                        Total Students: <b> {{ $batch['totalTrainees'] ?? '' }}</b> <br>
                        Student Present: 500 <br>
                        Student Dropped: 10 <br>
                        Freelancer: 10 <br>
                        Number of Audits: 12 <br>
                        Paid Amount: 1200000 <br>
                        Due Amount: 100000
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
