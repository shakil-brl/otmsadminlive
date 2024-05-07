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
            background-size: 100%;
            background-repeat: no-repeat;
            font-family: "flex";
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

    @foreach (range(1, 2) as $item)
        <div class="certificate">
            <div style="font-size: 27pt; padding-top: 200px; ">
                Certificate of Completion
            </div>
            <div style="font-size: 12pt; padding-top: 40px; ">
                This is to certify that
            </div>
            <div style="font-size: 27pt; padding-top: 14px; font-family: 'dflix'">
                Sadia Afreen Sweety
            </div>
            <div style="font-size: 12pt; padding-top: 32px;line-height: 1.5  ">
                Son / Daughter of Md. Selim Hossain
            </div>
            <div style="font-size: 12pt; line-height: 1.5;  ">
                has successfully completed the 528 hours course on
            </div>
            <div style="font-size: 23pt; padding-top: 15px;  ">
                “Digital Marketing”
            </div>
            <div style="font-size: 12pt; padding-top: 10px; padding-bottom: 50px; line-height: 1.5;  ">
                conducted by babylon resources limited and supported by ict division.
            </div>
            <table style="width: 100%; ">
                <tr>
                    <td style="font-size: 8pt; line-height: 1.15; text-align: center;font-family: 'flex'; ">
                        <img width="90" src="img/certificate/sign1.png" alt=""> <br>
                        Md. Mostafa Kamal <br>
                        Establishment of Sheikh Kamal IT Training <br>
                        & Incubation Center project
                    </td>
                    <td style=" ">
                        QR Code
                    </td>
                    <td style="font-size: 8pt; line-height: 1.15; text-align: center; font-family: 'flex';">
                        <img width="90" src="img/certificate/sign2.png" alt=""> <br>
                        Md. Mostafa Kamal <br>
                        Establishment of Sheikh Kamal IT Training <br>
                        & Incubation Center project
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
</body>

</html>
