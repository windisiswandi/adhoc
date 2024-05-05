<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ol type="1">
        @foreach($soals as $soal)
        <li>{{Crypt::decrypt($soal->soal)}}</li>
        <ol type="A">
            <li>{{Crypt::decrypt($soal->pil_a)}}</li>
            <li>{{Crypt::decrypt($soal->pil_b)}}</li>
            <li>{{Crypt::decrypt($soal->pil_c)}}</li>
            <li>{{Crypt::decrypt($soal->pil_d)}}</li>
        </ol>
        <p style="color: red;">Kunci: {{$soal->kunci}}</p>
        @endforeach
    </ol>
</body>
</html>