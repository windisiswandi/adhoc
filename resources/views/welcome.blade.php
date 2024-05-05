<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    @if(isset($change_crypt))
    <div>
        <input type="text" id="encrypt">
        <button id="encrypt">Encrypt</button> <br>
        <textarea id="textToCopy" rows="4" cols="50">Teks yang akan disalin dari textarea.</textarea>
        <button id="copyBtn">Salin Teks</button>
    </div>
    <br>
    <div>
        <input type="text" id="decrypt">
        <button id="decrypt">decrypt</button>
        <br>
        <span id="hasil_decr"></span>
    </div>

    <script>
        $('button#encrypt').click((e) => {
            var input = $("input#encrypt").val()
            $.ajax({
                url: "{{route('get_encrypt')}}", // Ganti URL dengan URL API yang sesuai
                type: "GET",
                data: {input},
                success: function(response) {
                    // Manipulasi dan tampilkan data sesuai kebutuhan Anda
                    $("#textToCopy").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        })

        $('button#decrypt').click((e) => {
            var input = $("input#decrypt").val()
            $.ajax({
                url: "{{route('get_decrypt')}}", // Ganti URL dengan URL API yang sesuai
                type: "GET",
                data: {input},
                success: function(response) {
                    // Manipulasi dan tampilkan data sesuai kebutuhan Anda
                    $("#hasil_decr").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        })

        document.addEventListener("DOMContentLoaded", function() {
            var copyBtn = document.getElementById("copyBtn");
            copyBtn.addEventListener("click", function() {
                var textToCopy = document.getElementById("textToCopy");
                textToCopy.select();
                document.execCommand("copy");
                alert("Teks tersalin");
            });
        });
    </script>
    @else
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
    @endif
</body>
</html>