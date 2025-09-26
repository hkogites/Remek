<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Foglalás megerősítése</title>
</head>
<body style="font-family: Arial, sans-serif; color:#333;">
  <h2 style="color:#0d6efd;">Foglalás megerősítése</h2>
  <p>Kedves {{ $data['full_name'] }},</p>
  <p>Köszönjük a foglalását a(z) <strong>{{ $data['destination_title'] }}</strong> útra.</p>

  <h3>Foglalás részletei</h3>
  <ul>
    <li><strong>Létszám:</strong> {{ $data['people_count'] }} fő</li>
    <li><strong>Időpont:</strong>
      @if(!empty($data['start_date']) && !empty($data['end_date']))
        {{ $data['start_date'] }} – {{ $data['end_date'] }}
      @else
        Hamarosan egyeztetjük az időpontot.
      @endif
    </li>
    <li><strong>Ár/fő:</strong> {{ number_format($data['price_huf'], 0, ' ', ' ') }} Ft</li>
    <li><strong>Végösszeg:</strong> {{ number_format($data['total_price_huf'], 0, ' ', ' ') }} Ft</li>
  </ul>

  @if(!empty($data['note']))
    <p><strong>Megjegyzés:</strong> {{ $data['note'] }}</p>
  @endif

  <p>Hamarosan további részletekkel jelentkezünk. Kérdés esetén válaszoljon erre az e-mailre.</p>

  <p>Üdvözlettel,<br>
  SmartVoyager csapat</p>
</body>
</html>
