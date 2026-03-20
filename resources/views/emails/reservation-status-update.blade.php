<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartVoyager - Foglalás státusz változás</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .status-pending { background: #ffc107; color: #856404; }
        .status-confirmed { background: #28a745; color: white; }
        .status-cancelled { background: #dc3545; color: white; }
        .content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
        }
        .admin-notes {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-top: 20px;
            border-radius: 0 8px 8px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🌍 SmartVoyager</h1>
        <h2>Foglalás státusz változás</h2>
    </div>

    <div class="content">
        @if(isset($custom_message))
            <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <strong>🎉 {{ $custom_message }}</strong>
            </div>
        @endif

        <div class="status-badge status-{{ $status }}">
            {{ $status === 'pending' ? 'Függőben' : ($status === 'confirmed' ? 'Megerősítve' : 'Törölve') }}
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Név:</div>
                <div>{{ $full_name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Email:</div>
                <div>{{ $email }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Úti cél:</div>
                <div>{{ $destination_title }}</div>
            </div>
        </div>

        @if($admin_notes)
            <div class="admin-notes">
                <div class="info-label">Admin megjegyzés:</div>
                <div>{!! nl2br(e($admin_notes)) !!}</div>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Ez egy automatikus email a SmartVoyager rendszertől.</p>
        <p>Ha kérdései vannak, kérjük lépjen kapcsolatba velünk!</p>
    </div>
</body>
</html>
