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

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-logos {}

        .logo {
            display: inline-block;
            margin-right: 10px;
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

    <div class="certificate"
        style="background-image: url('img/certificate/certificate-bg.png') ; background-size: 100%; background-repeat: no-repeat;">

        <div class="certificate-content">
            <div class="certificate-header">
                <div class="top-logos">

                </div>
            </div>
            <div class="certificate-details">
                <h1 class="certificate-title">Certificate of Completion</h1>
                <h2>[Name]</h2>
                <p>son/daughter of [Parent's Name]</p>
                <p>has successfully completed the [Course Duration] course on</p>
                <h3>"Digital Marketing"</h3>
                <p>Conducted by [Institute Name] and supported by [Supporting Organization]</p>
            </div>
            <div class="certificate-signatures" style="">
                <div class="signature" style="display: inline-block">
                    <p>[Signatory Title 1]</p>
                </div>
                <div class="signature" style="display: inline-block">
                    <p>[Signatory Title 2]</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
