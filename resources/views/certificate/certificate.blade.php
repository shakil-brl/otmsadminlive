<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
        }

        .certificate {
            width: 11.69in;
            height: 8.27in;
            padding: 0 1in;
            text-align: center;
            background-image: url('img/certificate/certificate-bg.png');
            /* background-image: url('img/certificate/sign2.png'); */
            background-position: left;
            background-size: 100%;
            background-repeat: no-repeat;
            font-family: "flex";
        }
    </style>
</head>

<body>
    @foreach (collect($certificates) as $certificate)
        <div class="certificate" style="@if (!$loop->last) page-break-after: always; @endif">
            <div style="font-size: 27pt; padding-top: 200px;">
                Certificate of Completion
            </div>
            <div style="font-size: 12pt; padding-top: 40px; ">
                This is to certify that
            </div>
            <div style="font-size: 27pt; padding-top: 14px; font-family: 'dflix'">
                @isset($certificate['trainee']['profile']['KnownAs'])
                    {{ ucwords(strtolower($certificate['trainee']['profile']['KnownAs'])) }}
                @endisset
            </div>
            <div style="font-size: 12pt; padding-top: 32px;line-height: 1.5  ">
                Son / Daughter of
                @isset($certificate['trainee']['profile']['FatherName'])
                    {{ $certificate['trainee']['profile']['FatherName'] }}
                @endisset
            </div>
            <div style="font-size: 12pt; line-height: 1.5;">
                has successfully completed the 528 hours course on
            </div>
            <div style="font-size: 23pt; padding-top: 15px;">
                @isset($certificate['trainee']['training_title']['NameEn'])
                    {{ ucwords(strtolower($certificate['trainee']['training_title']['NameEn'])) }}
                @endisset
            </div>
            <div style="font-size: 12pt; padding-top: 10px; padding-bottom: 30px; line-height: 1.5;  ">
                conducted by
                @isset($certificate['trainee']['training_batch']['provider']['name'])
                    {{ ucwords(strtolower($certificate['trainee']['training_batch']['provider']['name'])) }}
                @endisset
                and supported by ict division.
            </div>
            <table style="width: 100%;">
                <tr valign="top">
                    <td
                        style="font-size: 8pt; line-height: 1.15; text-align: center;font-family: 'flex';  width: 250px; ">
                        <img width="90" src="img/certificate/sign1.png" alt="">
                        <hr>
                        Full Name Here <br>
                        Designation <br>
                        Organization Name
                    </td>
                    <td style="text-align: center; ">
                        @php
                            $certificate_no = 'HPP' . str_pad($certificate['id'], 5, '0', STR_PAD_LEFT);
                            $url = url('verify/' . $certificate_no);
                            $qrcode = QrCode::size(120)->style('square')->generate($url);
                            $code = (string) $qrcode;
                        @endphp
                        {!! substr($code, 38) !!}
                        <div>
                            <small>{{ $certificate_no }}</small>
                        </div>
                    </td>
                    <td
                        style="font-size: 8pt; line-height: 1.15; text-align: center; font-family: 'flex'; width: 250px; ">
                        <img width="90" src="img/certificate/sign2.png" alt="">
                        <hr>
                        Full Name Here <br>
                        Designation <br>
                        Organization Name
                    </td>
                </tr>
            </table>
        </div>
    @endforeach

</body>

</html>
