<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Voting App</title>
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
            background: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
        }

        nav {
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
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 24px;
        }

        .stat-label {
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: rgba(255, 255, 255, 0.02);
            padding: 16px 24px;
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
        }

        td {
            padding: 16px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-delete {
            color: #f87171;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 13px;
        }

        .pagination {
            margin-top: 24px;
            display: flex;
            gap: 8px;
        }

        .pagi-link {
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">VotingAdmin</div>
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="{{ route('admin.voting') }}"
                style="color: #a78bfa; text-decoration: none; font-size: 14px; font-weight: 600;">🎡 Buka Wheel
                Voting</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Pendaftar</div>
                <div class="stat-value">{{ $totalParticipants }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Pendaftar Hari Ini</div>
                <div class="stat-value text-purple">{{ $todayParticipants }}</div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->created_at->diffForHumans() }}</td>
                            <td>
                                <form action="{{ route('admin.pendaftar.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">Belum ada
                                pendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $participants->links() }}
        </div>
    </div>
</body>

</html>
