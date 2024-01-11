<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (unchanged) ... -->
    <style>
      body {font-family: 'bangla', sans-serif;}

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6; /* Bootstrap table border */
        }

        .rotated-header {
    writing-mode: vertical-lr; /* Vertical text, from left to right */
    transform: rotate(180deg); /* For browsers that support transform property */
}

        .auto-height {
            height: auto !important;
        }

        .percentage-row {
            font-weight: bold;
        }

        .container {
            margin-top: 50px;
        }

        .reset-pm .col {
            padding: 0em;
            margin: 5px;
            text-align: center;
        }

        /* Custom styles for the table borders */
        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6; /* Bootstrap table border */
            padding: 8px; /* Adjust as needed */
        }

        .box {
            border: 1px solid #dee2e6; /* Bootstrap table border */
            padding: 10px;
            margin-bottom: 10px;
        }

        /* Added style to prevent line breaks in student names */
        .nowrap {
            white-space: nowrap;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-md-8 {
            width: 66.66%;
            float: left;
        }

        .col-md-4 {
            width: 33.33%;
            float: left;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

  <table style="border-collapse: collapse;" >
    <tr>
        <!-- First Column -->
        <td style="width: 80%; padding: 10px; vertical-align: top;">
            <h3>মাসিক উপস্থিতি রিপোর্ট</h3>
            <p>This is the content of the first column.</p>
        </td>

        <!-- Second Column -->
        <td style="width: 30%; vertical-align: top;">

            <!-- Nested Table (4 Columns) -->
            <table style="width:100%; border-collapse: collapse; pading:0">
                <tr>
                    <td >
                    </td>
                    <td style="width: 50%; padding: 5px; text-align: right;">
                        <img src="img/attendance/logo.png" >
                    </td>
                    <td style="width: 10%; padding: 5px; text-align: right;">
                        <img src="img/attendance/gov.png">
                    </td>
                    <td style="width:20%; padding: 5px; text-align: right;">
                        <img src="img/attendance/ict.png">
                    </td>
                    <td style="width: 20%; padding: 5px; ">
                        <img src="img/attendance/doict.png">
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
<br>
<div style="border: 1px solid #E5E5E5; padding:10px">
    <table style="width:100%; border-collapse: collapse;">
        <tr>
             <td>
                 <p>মাস</p>
                 <b>নভেম্বর ২০২৩</b>
             </td>
             <td>
                 <p>ব্যাচ কোড #</p>
                 <b>নভেম্বর ২০২৩</b>
             </td>
             <td>
                 <p>কোর্সের নাম</p>
                 <b>নভেম্বর ২০২৩</b>
             </td>
             <td>
                 <p>ঠিকানা</p>
                 <b>4</b>
             </td>
             <td>
                 <p>সময়সূচী</p>
                 <b>5</b>
             </td>
             <td>
                 <p>প্রশিক্ষণার্থী</p>
                 <b>20</b>
             </td>
             <td>
                 <p>মোট ক্লাস</p>
                 <b>100</b>
             </td>
             <td>
                 <p>উপস্থিতি</p>
                 <b>0%</b>
             </td>
           </tr>
         </table>
       
</div>
<br>
  <table style="width:100%; border-collapse: collapse;" class="table table-bordered mt-1 table-bordered">
    <thead>
    <tr>
        <th class="auto-height">Student</th>
        <?php for ($day = 1; $day <= 20; $day++): ?>
            <th class="rotated-header auto-height"  style="text-rotate: 90; font-size:12px">
                <span style="white-space: nowrap;position:absolute;">
                    <?= now()->addDays($day)->format('d-m-Y') ?></span>
            </th>
        <?php endfor; ?>
        <th class="auto-height">Monthly %</th>
        <th class="auto-height">Present <br>Absent</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i = 1; $i <= 30; $i++):
        $studentName = 'Student Student Student ' . $i;
        $presentCount = 0;
        ?>
        <tr>
            <td class="nowrap"><?= $studentName ?></td>
            <?php for ($day = 1; $day <= 20; $day++): ?>
                <?php
                $attendanceStatus = rand(0, 1) == 1 ? 'P' : '';
                $presentCount += $attendanceStatus === 'P' ? 1 : 0;
                ?>
                <td><?= $attendanceStatus ?></td>
            <?php endfor; ?>
            <?php
            $monthlyPercentage = ($presentCount / 20) * 100;
            $absentCount = 20 - $presentCount;
            ?>
            <td><?= round($monthlyPercentage, 2) ?>%</td>
            <td><?= $presentCount ?> / <?= $absentCount ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>

</body>
</html>
