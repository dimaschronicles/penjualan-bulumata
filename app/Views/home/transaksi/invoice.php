<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
        }
    </style>
    <title>Nota Pembelian</title>
</head>

<body>
    <div style="font-size:38px; color:'#dddddd' "><i>Nota Pembelian</i></div>
    <p>
        <i>Bintang Muda Eyelashes</i><br>
        Kalimanah, Purbalingga<br>
        021911911
    </p>
    <hr>
    <hr>
    <p>
        Pembeli : <?= $transaksi['nama_lengkap']; ?><br>
        Alamat : <?= $transaksi['alamat']; ?><br>
        Transaksi No : TR-<?= $transaksi['id_transaksi']; ?><br>
        Tanggal : <?= $transaksi['time_created']; ?>
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>Barang</strong></th>
            <th><strong>Harga Satuan</strong></th>
            <th><strong>Jumlah</strong></th>
            <th><strong>Sub Harga</strong></th>
        </tr>
        <?php foreach ($produk as $p) : ?>
            <tr>
                <td><?= $p['nama_produk']; ?></td>
                <td>Rp <?= format_rupiah($p['harga_produk']); ?>,00</td>
                <td><?= $p['jumlah']; ?></td>
                <td>Rp <?= format_rupiah(intval($p['harga_produk'] * $p['jumlah'])); ?>,00</td>
            </tr>
        <?php endforeach; ?>
        <tr id="sub-total">
            <th colspan="3">Sub Total</th>
            <td>Rp <?= format_rupiah($total['total_harga']); ?>,00</td>
        </tr>
        <tr>
            <th colspan="3">Ongkir</th>
            <td>Rp <?= format_rupiah($total['ongkir']); ?>,00</td>
        </tr>
        <tr>
            <th colspan="3">Total </th>
            <td>Rp <?= format_rupiah(intval($total['total_harga'] + $total['ongkir'])); ?>,00</td>
        </tr>
    </table>
    <p>
        Silahkan lakukan pembayaran Rp. <?= format_rupiah(intval($total['total_harga'] + $total['ongkir'])); ?>,00 ke <br>
        <strong>BANK MANDIRI 123-111-111 AN Bintang Muda Eyelashes</strong>
    </p>
</body>

</html>