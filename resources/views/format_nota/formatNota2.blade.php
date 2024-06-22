<!DOCTYPE html>
<html>

<head>
  <title>Surat Tagihan Retribusi</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      margin: 40px;
    }

    h1 {
      font-size: 20px;
      text-align: center;
    }

    h2 {
      font-size: 18px;
      text-align: center;
    }

    p {
      margin-bottom: 10px;
    }

    /* Specific styles for sections */
    header {
      display: flex;
      text-align: center;
      margin-bottom: 40px;
      justify-content:space-between;
    }

    .address {
      text-align: right;
    }

    .owner-info {
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      margin-bottom: 2%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      border: 1px solid black;
      text-align: left;
    }

    .signature {
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: flex-end;
    }
  </style>

</head>

<body>
  
  <header >
    <img width="70" height="70"
      src="data:image/jpg;base64,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" />

    <div >
      <h1>PEMERINTAH KOTA KOTAMOBAGU</h1>
      <h2>DINAS PERDAGANGAN, KOPERASI DAN UMKM</h2>
      <p>SURAT TAGIHAN RETRIBUSI DAERAH (STRD)</p>
    </div>

  </header>

  <main>
    <div class="address">
      <p>Jl. Kampus, Kel. Mogolaing, Kec. Kotamobagu Barat</p>
    </div>
    @foreach ($data as $item)
      
    <div class="owner-info">
      <p>NAMA PEMILIK : {{ $item['nama_pemilik'] }}</p>
      <p>PASAR: {{ $item['nama_pasar'] }}</p>
      <p>USAHA: {{ $item['nama_usaha'] }} • BLOK: {{ $item['nama_blok'] }}</p>
      <p>PERDA NO:</p>
    </div>

    <table >
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode Rekening</th>
          <th>Jenis Retribusi</th>
          <th>Jumlah Tagihan</th>
          <th>Denda</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>{{ $item['nama_bank'] }} - {{ $item['no_rek'] }} - {{ $item['atas_nama'] }}</td>
          <td>-</td>
          <td>Rp. {{ $item['jlh_pembayaran'] }}</td>
          <td>Rp. {{ $item['denda'] }}</td>
          <td>Rp. {{ $item['total'] }}</td>
        </tr>
      </tbody>
    </table>
    @endforeach


    <div class="signature" >
      <p>KOTAMOBAGU, 22 NOVEMBER 2023</p>
      <p style="margin-bottom: 10%;">BENDAHARA PENERIMA</p>
      <p>NIP. 1345678971613468</p>
    </div>

    <div class="notes">
      <p>KETERANGAN:</p>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
        a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
        Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions
        of Lorem Ipsum.</p>
    </div>
  </main>

</body>

</html>