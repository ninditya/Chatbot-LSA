<?php
$sql = mysqli_query($conn, "SELECT * FROM data_id WHERE id_chat='$chat_id'");
$d = mysqli_fetch_array($sql);
// switch ($d['id_chat']) {
// 	default:
// 	$pesan_balik = 'Selamat datang bla bla bla';
// 	break;
// 	case 1:
// 	$pesan_balik = 'hehe..';
// 	break;

// }
if ($d['NIM'] == 0) {
	$pesan_balik = 'Selamat datang bla bla bla. input nama dan nim dengan format : DAFTAR%23NAMA%23NIM';
	if (mysqli_num_rows($sql) == 0) {
		$sql = mysqli_query($conn,"insert into data_id values ('$chat_id','','1')");
	}
}else{
	if (strpos($pesan,"AFTAR#")>0) {
		$datas = explode("#",$pesan);
		$nama = $datas[1];
		$nim = $datas[2];
		$sql = "UPDATE data_id SET nama='$nama',NIM='$nim' WHERE id_chat='$chat_id'";
		// $sql = mysqli_query($conn,"insert into data_telegram values ('$chat_id','$nama','$nim')");	
		if(mysqli_query($conn,$sql)) {
			$pesan_balik = "Terima kasih Data Anda sudah kami simpan.";
		}
		else $pesan_balik = "Data gagal disimpan silahkan coba lagi";
	}else
	{
		$pesan_balik = 'bentar yaa. kodingannya nyasar';
		// include '../index.php';
		// if (empty($id_max)) {
		// 	$pesan_balik = 'eror';
		// }else{			
		// 	$sql = mysqli_query($conn, "SELECT * FROM `pertanyaan` WHERE `id`='$id_max'");
		// 	$d = mysqli_fetch_array($sql);
		// 	$pesan_balik = 'kamu nanya ' . $d['pertanyaan'] . ' yaaa, hehe ...';
		// }
	}
}
?>