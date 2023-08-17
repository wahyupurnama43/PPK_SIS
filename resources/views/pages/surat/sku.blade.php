<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Usaha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
        integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif !important;
        }

        p,
        td {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <img src="{{ public_path('kop-surat.png') }}" alt="" style="width: 100%; height: 180px">

    <hr style="height: 4px; background:#333;">
    <center>
        <h1 style="text-decoration: underline; font-size:25px;margin-bottom:0">SURAT KETERANGAN USAHA</h1>
        <h5 style="margin:0; margin-top:3px">Nomor :
            @if ($surat !== 'preview')
                {{ $no_surat->kode . '/' . $no_surat->urutan . '/' . $no_surat->bulan . '/' . $no_surat->tahun }}
            @endif
        </h5>
    </center>
    <p>Yang bertanda tangan dibawah ini :</p>

    <table>
        <tr>
            <td width="100px">Nama &nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td>{{ $perbekel->nama }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ Str::title($perbekel->jabatan->nama) . ' '. Str::title($perbekel->dusun)}}</td>
        </tr>
    </table>

    <p>Dengan ini menerangkan bahwa :</p>

    <table>
        <tr>
            <td width="100px">Nama &nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td>{{ Str::title($penduduk->nama_lengkap) }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $penduduk->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki - Laki' }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $penduduk->nik }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl.Lahir</td>
            <td>:</td>
            <td>{{ $penduduk->tempat_lahir . ', ' . date('m/d/Y') }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>
                @if ($penduduk->agama === 'I')
                    Islam
                @elseif ($penduduk->agama === 'H')
                    Hindu
                @elseif ($penduduk->agama === 'P')
                    Protestan
                @elseif ($penduduk->agama === 'KA')
                    Katolik
                @elseif ($penduduk->agama === 'B')
                    Budha
                @elseif ($penduduk->agama === 'Kh')
                    Khonghucu
                @endif

            </td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>:</td>
            <td>
                @if ($surat !== 'preview')
                    {{ $surat->keperluan }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{Str::title($penduduk->keluarga->alamat) . ', ' . Str::title($penduduk->keluarga->dusun) . ', ' . Str::title($penduduk->keluarga->desa) . ', ' . Str::title($penduduk->keluarga->kecamatan) }}, Kabupaten Bangli
            </td>
        </tr>
    </table>
    <p style="text-indent:50px">
        @if ($surat !== 'preview')
            {{ $surat->deskripsi }}
        @endif
    </p>

    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Tanah
        ............................................ Terletak di Desa .......................................
        No.....................,Pipil No. ........................ Persil No. ........................... Kelas
        ...................... Luas .............. M2/ARE/Ha, atas nama ..................... Sesuai SHM / Petok D /
        LetterTinggal di ..................
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.
        Fidusial&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp; alat rumah tangga /
        ......................................................

        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.

    </p>

    <p style="text-indent:50px">
        Demikian surat keterangan ini dibuat agar dapat dipergunakan dimana perlunya, dan apabila dikemudian hari
        Pernyataan orang tersebut tidak sesuai dengan kenyataan yang sebenarnya, maka surat ini tidak berlaku serta
        tidak akan melibatkan Pemerintah Desa Batur Tengah.
    </p>
    <div style="text-align: right">
        @php
            use Carbon\Carbon;
            
            Carbon::setLocale('id');
            
            $date = Carbon::now(); // Objek Carbon saat ini (atau sesuaikan dengan tanggal yang diinginkan)
            
            // Format tanggal dalam bahasa Indonesia
            $formattedDate = $date->isoFormat('D MMMM YYYY');
        @endphp
        <p style="margin:0;margin-top:5px; ">{{ Str::title($perbekel->desa) }}, {{ $formattedDate }}</p>
        <p style="margin:5px 0; ">
            {{ Str::title($perbekel->jabatan->nama) . ' '. Str::title($perbekel->dusun) }}
        </p>
        @if ($surat !== 'preview')
            <img src="{{ public_path($surat->barcode) }}" alt="">
        @endif
        <p style="margin:0;margin-top:5px; ">{{ $perbekel->nama  }}</p>
    </div>

</body>

</html>
