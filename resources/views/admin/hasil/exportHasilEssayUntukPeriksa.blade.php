<!DOCTYPE html>
<html>
<head>
    <style media="screen">
                  *{
        margin: 0px;
        padding: 0px;
    }
        body {
            font-family: 'Segoe UI','Microsoft Sans Serif',sans-serif;
            font-size:11px;
            margin-right: 0px;
            margin-left: 0px;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        header:before, header:after {
            content: " ";
            display: table;
        }

        header:after {
            clear: both;
        }

        .invoiceNbr {
            font-size: 15px;
            margin-right: 0px;
            margin-left: 0px;
            margin-top: 5px;
            margin-bottom: 0px;
        }

        /* .logo {
            float: left;
        } */

        .from {
            float: left;
        }

        .to {
            float: right;
        }

        .fromto {
            border-style: solid;
            border-width: 1px;
            border-color: #e8e5e5;
            border-radius: 5px;
            margin: 20px;
            min-width: 200px;
        }

        .fromEssay {
            border-style: solid;
            border-width: 1px;
            border-color: #e8e5e5;
            border-radius: 5px;
            margin-right: 20px;
            margin-left: 20px;
            margin-top: 5px;
            margin-bottom: 0px;
            /* margin: 20px; */
            /* min-width: 200px; */
        }
        .panelEssay {
            background-color: #e8e5e5;
            padding: 2px;
        }

        .fromtocontent {
            margin: 10px;
            margin-right: 15px;
        }

        .panel {
            background-color: #e8e5e5;
            padding: 7px;
        }

        .items {
            clear: both;
            display: table;
            padding: 20px;
        }

        /* Factor out common styles for all of the "col-" classes.*/
        div[class^="col-"] {
            display: table-cell;
            padding: 7px;
        }

        /*for clarity name column styles by the percentage of width */
        .col-1-10 {
            width: 10%;
        }

        .col-1-52 {
            width: 52%;
        }

        .row {
            display: table-row;
            page-break-inside: avoid;
        }

    </style>

<style>
    .page-break {
        page-break-after: always;
    }
    </style>

</head>
<body>
    @foreach ($hasil as $item)
    {{-- <header>
        <div class="fromto from">
            <div class="panel"><b>Hasil Jawaban Essay</b></div>
        </div>
    </header> --}}

    <div class="fromto from">
        <div class="panel"><b>Data Peserta</b></div>
        <div class="fromtocontent">
            <span>No :  {{ $loop->iteration }}</span> <br>
            <span>No Pendaftaran : {{ $item->no_pendaftaran }}</span><br />
            <span>Nama : {{ $item->nama_peserta }}</span><br />
            <span>Kelas : {{ $item->nama_kelas }}</span><br />
            <span>Wilayah : {{ $item->wilayah }}</span><br />
        </div>
    </div>
    <div class="fromto to">
        <div class="panel"><b>Total Nilai</b></div>
        <div class="fromtocontent">
            <span></span><br />
            <span></span><br />
        </div>
    </div>
    </br></br></br></br></br></br></br></br> <br> <br><br>


    @dump($item->ujian)

        <div class="fromEssay">
            <div class="panelEssay"></div>
            <div class="fromtocontent">


                                <div >
                    <div >
                        {{-- {!! $essay->jawaban !!} --}}
                    </div>
                </div>


            </div>
        </div>



        <div class="page-break"></div>

    @endforeach
</body>
</html>
