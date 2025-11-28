<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Laporan' }}</title>
    <style>
        * {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
            color: #1a202c;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f97316;
        }
        .header h1 {
            color: #f97316;
            font-size: 24px;
            margin: 0 0 5px 0;
        }
        .header h2 {
            color: #374151;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }
        .header p {
            color: #6b7280;
            font-size: 11px;
            margin: 0;
        }
        .info-box {
            background: #f3f4f6;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .info-box p {
            margin: 3px 0;
            font-size: 11px;
        }
        .info-box strong {
            color: #111827;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th {
            background: #f97316;
            color: #fff;
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }
        table tr:nth-child(even) {
            background: #f9fafb;
        }
        table tr:hover {
            background: #fff7ed;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
        }
        .page-break { page-break-after: always; }
        .stats-row {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-box {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
        }
        .stat-box .value {
            font-size: 24px;
            font-weight: 700;
            color: #f97316;
        }
        .stat-box .label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>kampuStore</h1>
        <h2>{{ $title ?? 'Laporan' }}</h2>
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }} WIB</p>
    </div>
    
    @yield('content')
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} kampuStore - Marketplace Mahasiswa UNDIP</p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem</p>
    </div>
</body>
</html>
