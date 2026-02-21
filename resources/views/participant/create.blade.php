<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Voting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative blobs */
        body::before {
            content: '';
            position: fixed;
            width: 450px; height: 450px;
            background: radial-gradient(circle, rgba(120, 80, 255, 0.35) 0%, transparent 70%);
            top: -100px; left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(255, 100, 150, 0.25) 0%, transparent 70%);
            bottom: -80px; right: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 48px 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.4);
            position: relative;
            z-index: 1;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(120, 80, 255, 0.2);
            border: 1px solid rgba(120, 80, 255, 0.4);
            color: #a78bfa;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 36px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.35);
            font-size: 16px;
            pointer-events: none;
        }

        .textarea-icon {
            top: 16px;
            transform: none;
        }

        input, textarea {
            width: 100%;
            padding: 14px 16px 14px 44px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        input:focus, textarea:focus {
            border-color: rgba(120, 80, 255, 0.7);
            background: rgba(255, 255, 255, 0.09);
            box-shadow: 0 0 0 3px rgba(120, 80, 255, 0.15);
        }

        input.is-invalid, textarea.is-invalid {
            border-color: rgba(248, 113, 113, 0.7);
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            padding-top: 14px;
        }

        .error-msg {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #f87171;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 500;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.15s;
            margin-top: 12px;
            letter-spacing: 0.3px;
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.45);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(124, 58, 237, 0.6);
            opacity: 0.95;
        }

        .btn-submit:active {
            transform: translateY(0px);
        }

        .divider {
            height: 1px;
            background: rgba(255,255,255,0.07);
            margin: 28px 0;
        }

        .alert-error {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.3);
            border-radius: 12px;
            padding: 14px 16px;
            color: #fca5a5;
            font-size: 13px;
            margin-bottom: 24px;
        }

        .alert-error strong {
            display: block;
            margin-bottom: 6px;
            color: #f87171;
        }

        .alert-error ul {
            padding-left: 16px;
        }

        .alert-error li {
            margin-bottom: 2px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor">
                <circle cx="5" cy="5" r="5"/>
            </svg>
            Pendaftaran Peserta
        </div>
        <h1>Daftar Sekarang</h1>
        <p class="subtitle">Isi formulir di bawah untuk mendaftarkan diri sebagai peserta voting.</p>

        @if ($errors->any())
            <div class="alert-error">
                <strong>⚠ Terdapat kesalahan pada form:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('participant.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('nama') }}"
                        class="{{ $errors->has('nama') ? 'is-invalid' : '' }}"
                    >
                </div>
                @error('nama')
                    <div class="error-msg">⚠ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_hp">No HP / WhatsApp</label>
                <div class="input-wrapper">
                    <span class="input-icon">📱</span>
                    <input
                        type="tel"
                        id="no_hp"
                        name="no_hp"
                        placeholder="Contoh: 08123456789"
                        value="{{ old('no_hp') }}"
                        class="{{ $errors->has('no_hp') ? 'is-invalid' : '' }}"
                    >
                </div>
                @error('no_hp')
                    <div class="error-msg">⚠ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <div class="input-wrapper">
                    <span class="input-icon textarea-icon">📍</span>
                    <textarea
                        id="alamat"
                        name="alamat"
                        placeholder="Masukkan alamat lengkap"
                        class="{{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                    >{{ old('alamat') }}</textarea>
                </div>
                @error('alamat')
                    <div class="error-msg">⚠ {{ $message }}</div>
                @enderror
            </div>

            <div class="divider"></div>

            <button type="submit" class="btn-submit">
                ✨ Daftarkan Diri Saya
            </button>
        </form>
    </div>
</body>
</html>
