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
            background-image: url('img/uploads/certificate-bg.png');
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
        @php
            $student_name = ucwords(strtolower($certificate['trainee']['profile']['KnownAs']));
            $fathers_name = ucwords(strtolower($certificate['trainee']['profile']['FatherName']));
            $mothers_name = ucwords(strtolower($certificate['trainee']['profile']['MotherName']));
            $provider_name = ucwords(strtolower($certificate['trainee']['training_batch']['provider']['name']));

            $main_array = ['#name#', '#father#', '#mother#', '#vendor#'];
            $replace_array = [$student_name, $fathers_name, $mothers_name, $provider_name];

            foreach ($setting_configs as $key => $setting_config) {
                $setting_configs[$key] = str_replace($main_array, $replace_array, $setting_config);
            }
        @endphp

        <div class="certificate" style="@if (!$loop->last) page-break-after: always; @endif">
            <div style="font-size: 27pt; padding-top: 200px;">
                @isset($setting_configs['certificate_title'])
                    {{ $setting_configs['certificate_title'] }}
                @endisset
            </div>
            <div style="font-size: 12pt; padding-top: 40px; ">
                @isset($setting_configs['certificate_sub_title'])
                    {{ $setting_configs['certificate_sub_title'] }}
                @endisset
            </div>
            <div style="font-size: 27pt; padding-top: 14px; font-family: 'dflix'">
                @isset($certificate['trainee']['profile']['KnownAs'])
                    {{ ucwords(strtolower($certificate['trainee']['profile']['KnownAs'])) }}
                @endisset
            </div>
            <div style="font-size: 12pt; padding-top: 32px;line-height: 1.5  ">
                @isset($setting_configs['description_line_1'])
                    {{ $setting_configs['description_line_1'] }}
                @endisset
            </div>
            <div style="font-size: 12pt; line-height: 1.5;">
                @isset($setting_configs['description_line_2'])
                    {{ $setting_configs['description_line_2'] }}
                @endisset
            </div>
            <div style="font-size: 23pt; padding-top: 15px;">
                @isset($certificate['trainee']['training_title']['NameEn'])
                    {{ ucwords(strtolower($certificate['trainee']['training_title']['NameEn'])) }}
                @endisset
            </div>
            <div style="font-size: 12pt; padding-top: 10px; padding-bottom: 30px; line-height: 1.5;  ">

                @isset($setting_configs['description_line_3'])
                    {{ $setting_configs['description_line_3'] }}
                @endisset
                {{-- conducted by
                @isset($certificate['trainee']['training_batch']['provider']['name'])
                    {{ ucwords(strtolower($certificate['trainee']['training_batch']['provider']['name'])) }}
                @endisset
                and supported by ict division. --}}
            </div>
            <table style="width: 100%;">
                <tr valign="top">
                    <td
                        style="font-size: 8pt; line-height: 1.15; text-align: center;font-family: 'flex';  width: 260px; ">
                        <img width="90" src="img/uploads/sign1.png" alt="">
                        <hr>
                        @isset($setting_configs['sign_description_left'])
                            {!! $setting_configs['sign_description_left'] !!}
                        @endisset
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
                        style="font-size: 8pt; line-height: 1.15; text-align: center; font-family: 'flex'; width: 260px; ">
                        <img width="90" src="img/uploads/sign2.png" alt="">
                        <hr>
                        @isset($setting_configs['sign_description_right'])
                            {!! $setting_configs['sign_description_right'] !!}
                        @endisset
                    </td>
                </tr>
            </table>
        </div>
    @endforeach

</body>

</html>
