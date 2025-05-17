<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Akun Anda Telah Diverifikasi</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
  <div
    style="max-width: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h2 style="color: #2d3748;">Halo {{ $user->name }},</h2>

    <p>Selamat! Akun Anda telah berhasil <strong>diverifikasi oleh Admin</strong>.</p>

    <p>Anda sekarang dapat menggunakan platform kami.</p>
    <a href="{{ route('login') }}">Masuk</a>

    <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan hubungi tim support kami.</p>

    <br>
    <p>Terima kasih,</p>
    <p><strong>Tim {{ config('app.name') }}</strong></p>
  </div>
</body>

</html>