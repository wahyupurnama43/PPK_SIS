<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Miskin</title>
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

    <img src="{{ public_path('kop-surat.png') }}" alt="" style="width: 100%; height: 200px">

    <hr style="height: 4px; background:#333;">
    <center>
        <h1 style="text-decoration: underline; font-size:25px;margin-bottom:0">SURAT KETERANGAN DOMISILI</h1>
        <h5 style="margin:0; margin-top:3px">Nomor :
            @if ($surat !== 'preview')
                {{ $no_surat->kode . '-SID/' . $no_surat->urutan . '/' . $no_surat->bulan . '/' . $no_surat->tahun }}
            @endif
        </h5>
    </center>

    <p>Yang bertanda tangan dibawah ini :</p>

    <table>
        <tr>
            <td width="100px">Nama &nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td>{{ $kelian_banjar->nama }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ Str::title($kelian_banjar->jabatan->nama) . ' '. Str::title($kelian_banjar->dusun)}}</td>
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
            <td>{{ Str::title($penduduk->keluarga->alamat) . ', ' . Str::title($penduduk->keluarga->dusun) . ', ' . Str::title($penduduk->keluarga->desa) . ', ' . Str::title($penduduk->keluarga->kecamatan) }}
            </td>
        </tr>
    </table>

    <p style="text-indent: 50px">
        @if ($surat !== 'preview')
            {{ $surat->deskripsi }} {{ Str::title($penduduk->keluarga->alamat) . ', ' . Str::title($penduduk->keluarga->dusun) . ', ' . Str::title($penduduk->keluarga->desa) . ', ' . Str::title($penduduk->keluarga->kecamatan) }}
        @endif
    </p>

    <p style="text-indent: 50px">
        Demikian surat keterangan ini kami buat dengan sebenarnya, agar dapat dipergunakan sebagaimana
    </p>

    <div style="text-align: right">
        @php
            use Carbon\Carbon;
            
            Carbon::setLocale('id');
            
            $date = Carbon::now(); // Objek Carbon saat ini (atau sesuaikan dengan tanggal yang diinginkan)
            
            // Format tanggal dalam bahasa Indonesia
            $formattedDate = $date->isoFormat('D MMMM YYYY');
        @endphp
        <p style="margin:0;margin-top:5px; ">{{ Str::title($surat->verif_kadus->dusun) }}, {{ $formattedDate }}</p>
        @if ($surat !== 'preview')
            <div>
                <div style="float: right; width: 45%; height: auto; border:1px solid #333;">
                    <p style="text-align: left;padding:0 10px;">
                        Surat ini telah Ditandatangani dan disahkan secara digital oleh pemerintahan Desa Batur Tengah. {{ $surat->verif_kadus->jabatan->nama }} {{ $surat->verif_kadus->dusun }},{{ $surat->verif_kadus->nama }} dan {{ $surat->verif_staff->jabatan->nama }} {{ $surat->verif_staff->dusun }},{{ $surat->verif_staff->nama }}
                    </p>
                    <p style="text-align: left;padding:0 10px;">
                        ID : {{ $no_surat->kode . '-SID/' . $no_surat->urutan . '/' . $no_surat->bulan . '/' . $no_surat->tahun }}
                    </p>
                    <p style="text-align: left;padding:0 10px;">
                        Berlaku sampai : {{ Carbon::now()->addMonth()->isoFormat('D MMMM YYYY'); }}
                    </p>
                </div>
                <div style="float: right;margin-right: 10px; width: 25%; height: auto;">
                    <img src="{{ public_path($surat->barcode) }}" alt="">
                </div>
            </div>
        @endif
    </div>



</body>

</html>
