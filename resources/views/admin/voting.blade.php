<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wheel of Fortune - Voting App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
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
            background: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav {
            width: 100%;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            font-weight: 800;
            font-size: 20px;
            color: #a78bfa;
            text-decoration: none;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            width: 100%;
        }

        .wheel-wrapper {
            position: relative;
            width: 500px;
            height: 500px;
            margin-bottom: 40px;
        }

        #wheel {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 10px solid #1e293b;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5), 0 0 0 4px rgba(167, 139, 250, 0.2);
            transition: transform 5s cubic-bezier(0.15, 0, 0.15, 1);
        }

        .pointer {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: #a78bfa;
            clip-path: polygon(50% 100%, 0 0, 100% 0);
            z-index: 5;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.5));
        }

        .center-dot {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: #1e293b;
            border: 4px solid #a78bfa;
            border-radius: 50%;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .center-dot::after {
            content: '⚡';
            font-size: 24px;
        }

        .controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .btn-spin {
            padding: 16px 48px;
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            border: none;
            border-radius: 100px;
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.4);
            transition: 0.2s;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .btn-spin:hover:not(:disabled) {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 15px 40px rgba(124, 58, 237, 0.6);
        }

        .btn-spin:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        #winner-display {
            margin-top: 20px;
            font-size: 24px;
            font-weight: 700;
            color: #a78bfa;
            min-height: 36px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.5s;
        }

        #winner-display.show {
            opacity: 1;
        }

        .participant-count {
            margin-bottom: 20px;
            font-size: 14px;
            color: #94a3b8;
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="logo">VotingAdmin</a>
        <a href="{{ route('admin.dashboard') }}" style="color: #94a3b8; text-decoration: none; font-size: 14px;">←
            Kembali ke Dashboard</a>
    </nav>

    <div class="container">
        <div class="participant-count">
            Total Peserta di Wheel: <strong>{{ count($participants) }}</strong>
        </div>

        <div class="wheel-wrapper">
            <div class="pointer"></div>
            <div class="center-dot"></div>
            <canvas id="wheel" width="500" height="500"></canvas>
        </div>

        <div class="controls">
            <button id="spin-btn" class="btn-spin">SPIN WHEEL!</button>
            <div id="winner-display">Pemenang: <span id="winner-name"></span></div>
        </div>
    </div>

    <script>
        const participants = @json($participants);
        const canvas = document.getElementById('wheel');
        const ctx = canvas.getContext('2d');
        const spinBtn = document.getElementById('spin-btn');
        const winnerDisplay = document.getElementById('winner-display');
        const winnerName = document.getElementById('winner-name');

        let currentRotation = 0;
        let isSpinning = false;

        const colors = [
            '#7c3aed', '#a855f7', '#6366f1', '#4f46e5',
            '#2563eb', '#0891b2', '#0d9488', '#059669'
        ];

        function drawWheel() {
            const numSegments = Math.max(participants.length, 1);
            const arcSize = (2 * Math.PI) / numSegments;

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            if (participants.length === 0) {
                ctx.fillStyle = '#1e293b';
                ctx.beginPath();
                ctx.moveTo(250, 250);
                ctx.arc(250, 250, 240, 0, 2 * Math.PI);
                ctx.fill();
                ctx.fillStyle = '#94a3b8';
                ctx.textAlign = 'center';
                ctx.font = '16px Inter';
                ctx.fillText('Belum ada peserta', 250, 255);
                return;
            }

            participants.forEach((p, i) => {
                const angle = i * arcSize;

                // Draw segment
                ctx.fillStyle = colors[i % colors.length];
                ctx.beginPath();
                ctx.moveTo(250, 250);
                ctx.arc(250, 250, 240, angle, angle + arcSize);
                ctx.fill();

                // Draw text
                ctx.save();
                ctx.translate(250, 250);
                ctx.rotate(angle + arcSize / 2);
                ctx.textAlign = 'right';
                ctx.fillStyle = '#ffffff';
                ctx.font = 'bold 14px Inter';

                // Truncate name if too long
                const name = p.nama.length > 15 ? p.nama.substring(0, 12) + '...' : p.nama;
                ctx.fillText(name, 230, 5);
                ctx.restore();
            });
        }

        spinBtn.addEventListener('click', () => {
            if (isSpinning || participants.length === 0) return;

            isSpinning = true;
            spinBtn.disabled = true;
            winnerDisplay.classList.remove('show');

            const numSegments = participants.length;
            const extraSpins = 5 + Math.random() * 5; // 5 to 10 full rotations
            const randomAngle = Math.random() * (2 * Math.PI);

            const totalRotation = extraSpins * 2 * Math.PI + randomAngle;
            currentRotation += totalRotation;

            canvas.style.transform = `rotate(${currentRotation}rad)`;

            // Calculate winner after animation
            setTimeout(() => {
                isSpinning = false;
                spinBtn.disabled = false;

                // The pointer is at the top (-90 degrees or -Math.PI / 2)
                // We need to account for current total rotation
                const normalizedRotation = currentRotation % (2 * Math.PI);
                const arcSize = (2 * Math.PI) / numSegments;

                // Math is: (Top position - total rotation) / arcSize
                // Since canvas rotates clockwise, we subtract rotation from the top index
                let winnerIndex = Math.floor(((3 * Math.PI / 2) - normalizedRotation) / arcSize) %
                    numSegments;
                if (winnerIndex < 0) winnerIndex += numSegments;

                const winner = participants[winnerIndex];
                winnerName.textContent = winner.nama;
                winnerDisplay.classList.add('show');

                // Confetti!
                confetti({
                    particleCount: 150,
                    spread: 70,
                    origin: {
                        y: 0.6
                    },
                    colors: ['#a78bfa', '#f472b6', '#60a5fa']
                });
            }, 5000);
        });

        drawWheel();
    </script>
</body>

</html>
