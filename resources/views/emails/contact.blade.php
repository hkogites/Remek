<p><strong>Feladó:</strong> {{ $name ?: 'Nincs megadva' }} ({{ $data['email'] }})</p>
@if(!empty($data['last_name']))
@endif
<p><strong>Üzenet:</strong></p>
<p>{!! nl2br(e($data['message'])) !!}</p>
