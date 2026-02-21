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

        <style>
            .filter-card {
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 20px;
                padding: 24px;
                margin-bottom: 32px;
            }

            .filter-form {
                display: flex;
                gap: 16px;
                align-items: flex-end;
                flex-wrap: wrap;
            }

            .filter-group {
                display: flex;
                flex-direction: column;
                gap: 8px;
                flex: 1;
                min-width: 200px;
            }

            .filter-group label {
                font-size: 13px;
                color: #94a3b8;
                font-weight: 600;
            }

            .filter-group input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                padding: 10px 14px;
                color: #fff;
                outline: none;
                font-size: 14px;
            }

            .filter-group input:focus {
                border-color: #a78bfa;
            }

            .btn-filter {
                background: #a78bfa;
                color: #0f172a;
                padding: 10px 24px;
                border-radius: 100px;
                font-weight: 700;
                border: none;
                cursor: pointer;
                font-size: 14px;
                height: 42px;
            }

            .btn-reset {
                background: transparent;
                color: #94a3b8;
                border: 1px solid #94a3b8;
                padding: 10px 24px;
                border-radius: 100px;
                height: 42px;
                text-decoration: none;
                font-size: 14px;
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>

        <div class="filter-card">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                <div class="filter-group">
                    <label>Cari Nama / No HP</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari...">
                </div>
                <div class="filter-group">
                    <label>Filter Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}">
                </div>
                <button type="submit" class="btn-filter">Filter</button>
                <a href="{{ route('admin.pendaftar.export', request()->query()) }}" class="btn-filter"
                    style="background: #10b981; text-decoration: none; display: flex; align-items: center; justify-content: center;">📊
                    Unduh Excel</a>
                @if (request('search') || request('date'))
                    <a href="{{ route('admin.dashboard') }}" class="btn-reset">Reset</a>
                @endif
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Waktu Mendaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <div style="font-weight: 600;">{{ $p->created_at->format('d M Y') }}</div>
                                <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                                    {{ $p->created_at->diffForHumans() }}</div>
                            </td>
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
