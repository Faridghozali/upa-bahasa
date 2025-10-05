<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Peserta Tes</title>
    <style>
        body {
            font-family: "Arial Black", Tahoma, sans-serif;
            margin: 40px;
            font-size: 14px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .token {
            border: 1px solid black;
            padding: 5px 10px;
            font-weight: bold;
            display: inline-block;
        }

        .foto-box {
            width: 120px;
            height: 160px;
            border: 2px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .foto-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .rules {
            border-top: 2px solid black;
            margin-top: 20px;
            padding-top: 10px;
            font-size: 13px;
        }

        .small-text {
            font-size: 13px;
            margin: 2px 0;
        }

        .info-table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            margin-top: 5px;
        }

        .info-table td {
            border: 1px solid black;
            padding: 5px 10px;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="header">
        TRUNOJOYO PROFICIENCY TEST (TPT)
    </div>

    <table>
        <tr>
            <!-- Foto -->
            <td style="width: 25%; vertical-align: top;">
                <div class="foto-box">
                    <img src="{{ $user->student && $user->student->photo_path
    ? public_path('storage/' . $user->student->photo_path)
    : public_path('assets/images/user_icon.png') }}" alt="user avatar">
                </div>
            </td>

            <!-- Identitas -->
            <td style="width: 75%; padding-left: 12px; vertical-align: top;">
                <div class="section-title">KARTU PESERTA TES</div>
                <p class="small-text"><b>Email :</b> {{ $user->email }}</p>
                <p class="small-text"><b>Nama Lengkap :</b> {{ $user->name }}</p>

                <table class="info-table">
                    <tr>
                        <td><b>Tanggal Tes</b></td>
                        <td><b>Jam</b></td>
                        <td><b>Ruang</b></td>
                    </tr>
                    <tr>
                        <td height="35">{{ $exam->schedule->date }}</td>
                        <td>{{ $exam->schedule->test_time }}</td>
                        <td>{{ $exam->schedule->room->name }}</td>
                    </tr>
                </table>

                <p style="text-align:right; font-weight:700; margin-top:10px;">Paraf Pengawas</p>
            </td>
        </tr>
    </table>

    <!-- Token -->
    <table style="margin-top: 20px;">
        <tr>
            <td align="right">
                <b>Token Ujian</b><br>
                <span class="token">{{ $transaction->voucher_token }}</span>
            </td>
        </tr>
    </table>

    <!-- Aturan -->
    <div class="rules">
        <b>HAL-HAL YANG PERLU DIPERHATIKAN</b>
        <ol>
            <li>Peserta wajib membawa kartu tanda peserta pada pelaksanaan tes.</li>
            <li>Peserta diwajibkan datang 15 menit sebelum tes dimulai.</li>
            <li>Peserta yang terlambat tidak diperkenankan masuk ke dalam ruangan tes, dan dinyatakan gugur.</li>
            <li>Peserta diwajibkan mengikuti seluruh sesi tes.</li>
        </ol>
    </div>

</body>

</html>