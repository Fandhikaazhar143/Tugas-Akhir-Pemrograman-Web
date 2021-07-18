<?php 
// koneksikan dengan database
$koneksikan = mysqli_connect("localhost","root","","pweb");


// Tambah Data Barang Baru
if(isset($_POST['tambahbaru'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi  = $_POST['deskripsi'];
    $stock      = $_POST['stock'];

    $tambahbaru = mysqli_query($koneksikan, "INSERT into stock (namabarang, deskripsibarang, jumlahbarang) values('$namabarang','$deskripsi','$stock')");
    if($tambahbaru){
        header('location:index.php');
    } else {
        header('location:index.php');
    }

};

// Menambah Barang Masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $pemasuk  = $_POST['pemasuk'];
    $qty       = $_POST['qty'];

    $cekstocksebelumnya = mysqli_query($koneksikan,"SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya       = mysqli_fetch_array($cekstocksebelumnya);
    $stocksekarang      = $ambildatanya['jumlahbarang'];
    $tambahstockyangada = $stocksekarang+$qty;

    $barangmasuk = mysqli_query($koneksikan,"INSERT into barangmasuk (idbarang, pemasuk, qty) values ('$barangnya', '$pemasuk','$qty')");
    $updatestockmasuk = mysqli_query($koneksikan,"update stock set jumlahbarang='$tambahstockyangada' where idbarang='$barangnya'");
    if($barangmasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }

};


// Menambah Barang Keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima  = $_POST['penerima'];
    $qty       = $_POST['qty'];

    $cekstocksebelumnya = mysqli_query($koneksikan,"SELECT * FROM stock where idbarang='$barangnya'");
    $ambildatanya       = mysqli_fetch_array($cekstocksebelumnya);
    $stocksekarang      = $ambildatanya['jumlahbarang'];
    $tambahstockyangada = $stocksekarang-$qty;

    $barangkeluar = mysqli_query($koneksikan,"INSERT into barangkeluar (idbarang, penerima, qty) values ('$barangnya', '$penerima','$qty')");
    $updatestockkeluar = mysqli_query($koneksikan,"update stock set jumlahbarang='$tambahstockyangada' where idbarang='$barangnya'");
    if($barangkeluar&&$updatestockkeluar){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }

};


 ?>