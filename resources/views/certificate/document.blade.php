<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .certificate {
            width: 11.69in;
            height: 8.27in;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .certificate-content {
            margin-top: 170px;
            border-width: 4px;
            border-color: #6c3483;
        }

        .certificate-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .certificate-details {
            text-align: center;
            padding: 10px;
        }

        .certificate-details p {
            margin: 0;
        }

        .certificate-signatures {
            width: 100%;
        }

        .signature {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    {{-- clock.png --}}
    {{-- img/certificate/certificate-bg.png --}}
    @isset($certificates)
        @foreach (collect($certificates) as $certificate)
            <div class="certificate"
                style="background-image: url('img/certificate/certificate-bg.png') ; background-size: 100%; background-repeat: no-repeat;">

                <div class="certificate-content">
                    <div class="certificate-details">
                        <h1 class="certificate-title">Certificate of Completion</h1>
                        <h2>{{ $certificate['trainee']['profile']['KnownAs'] }}</h2>
                        <p>son/daughter of {{ $certificate['trainee']['profile']['FatherName'] }}</p>
                        <p>has successfully completed the [Course Duration] course on</p>
                        <h3>"{{ $certificate['trainee']['training_title']['NameEn'] }}"</h3>
                        <p>Conducted by "{{ $certificate['trainee']['training_batch']['provider']['name'] }}" and supported
                            by ict division.</p>
                    </div>
                    <div class="certificate-signatures" style="display: flex;">
                        <div class="signature">
                            <p>[Signatory Title 1]</p>
                        </div>
                        <div class="signature">
                            <p>[Signatory Title 2]</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endisset
</body>

</html>
