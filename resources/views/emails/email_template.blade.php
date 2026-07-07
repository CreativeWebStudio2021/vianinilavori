@php
    $color1 = config('app.color1');
@endphp

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Email</title>
</head>
<body style="margin:0; padding:0; font-family:Arial, sans-serif; background:#f7f7f7; color:#333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:30px auto; background:#fff; border:1px solid #ddd; border-radius:8px; overflow:hidden;">
        <tr style="background: {{ $color1 }};">
            <td style="padding:20px; text-align:center;">
                <img src="{{ config('app.url') . '/' . config('app.logo_email') }}" alt="Logo {{ config('app.name') }}" style="width:150px;">
            </td>
        </tr>
        <tr>
            <td style="padding:30px;">
                {!! $contenuto !!}
            </td>
        </tr>
        <tr>
            <td style="padding:30px; background:#f2f2f2;">
                <p style="margin: 0 0 5px;"><strong>{{ config('app.rag_sociale') }}</strong></p>
                <p style="margin: 0;">{{ config('app.indirizzo') }}</p>
                <p style="margin: 0;">Email: <a href="mailto:{{ config('app.email_def') }}">{{ config('app.email_def') }}</a></p>
                <p style="margin: 0;">Telefono: {{ config('app.telefono') }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding:15px; text-align:left;  color:#777;">
                <small>Avviso di riservatezza - Questa email &egrave; confidenziale e la sua riservatezza &egrave; tutelata dal GDPR 679/16. Se hai ricevuto questo messaggio per errore, ti preghiamo di eliminarlo.</small>
            </td>
        </tr>
    </table>

</body>
</html>
