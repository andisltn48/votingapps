<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(120, 80, 255, 0.35) 0%, transparent 70%);
            top: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(100, 200, 150, 0.25) 0%, transparent 70%);
            bottom: -80px;
            right: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 56px 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.4);
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-wrapper {
            width: 88px;
            height: 88px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(16, 185, 129, 0.2));
            border: 2px solid rgba(34, 197, 94, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
            font-size: 40px;
            animation: popIn 0.5s ease 0.3s both;
        }

        @keyframes popIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
        }

        p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.45);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(124, 58, 237, 0.6);
        }

        .ticket-number {
            margin-top: 24px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon-wrapper">✅</div>
        <h1>Pendaftaran Berhasil!</h1>
        <p>
            Selamat! Data Anda telah berhasil kami terima.<br>
            Pantau terus informasi voting selanjutnya.
        </p>
        <a href="{{ route('participant.create') }}" class="btn-back">
            ← Daftar Lagi
        </a>
    </div>
</body>

</html>
