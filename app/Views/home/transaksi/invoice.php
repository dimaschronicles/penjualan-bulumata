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
    <div style="font-size:30px; color:'#dddddd' "><i>Nota Pembelian</i></div>
    <p>
        <i>Bintang Muda Eyelashes</i><br>
        Kutasari, Purbalingga<br>
        021911911
    </p>
    <hr>
    <hr>
    <p>
        Pembeli : <?= $transaksi['nama_lengkap']; ?><br>
        Alamat : <?= $transaksi['alamat']; ?><br>
        No HP/WA : <?= $transaksi['no_hp']; ?><br>
        Transaksi No : TR-<?= $transaksi['id_transaksi']; ?><br>
        Tanggal : <?= $transaksi['time_created']; ?>
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>Kode</strong></th>
            <th><strong>Barang</strong></th>
            <th><strong>Harga Satuan</strong></th>
            <th><strong>Jumlah</strong></th>
            <th><strong>Sub Harga</strong></th>
        </tr>
        <?php foreach ($produk as $p) : ?>
            <tr>
                <td><?= $p['kode_produk']; ?></td>
                <td><?= $p['nama_produk']; ?></td>
                <td>Rp <?= format_rupiah($p['harga_produk']); ?>,00</td>
                <td><?= $p['jumlah']; ?></td>
                <td>Rp <?= format_rupiah(intval($p['harga_produk'] * $p['jumlah'])); ?>,00</td>
            </tr>
        <?php endforeach; ?>
        <tr id="sub-total">
            <th colspan="4">Sub Total</th>
            <td>Rp <?= format_rupiah($total['total_harga']); ?>,00</td>
        </tr>
        <tr>
            <th colspan="4">Ongkir</th>
            <td>Rp <?= format_rupiah($total['ongkir']); ?>,00</td>
        </tr>
        <tr>
            <th colspan="4">Total </th>
            <td>Rp <?= format_rupiah(intval($total['total_harga'] + $total['ongkir'])); ?>,00</td>
        </tr>
    </table>
    <p>
        Silahkan lakukan pembayaran Rp. <?= format_rupiah(intval($total['total_harga'] + $total['ongkir'])); ?>,00 ke <br>
        <strong>BANK BRI 341 102 001 432 921 a/n Bintang Muda Eyelashes</strong> <br>
        <strong>BANK BNI 600 800 1002 a/n Bintang Muda Eyelashes</strong> <br>
        <strong>BANK BCA 8029 1322 11 a/n Bintang Muda Eyelashes</strong>
    </p>
</body>

</html>