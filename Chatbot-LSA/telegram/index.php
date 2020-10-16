<?php
	
error_reporting(0);

// ==== BEGIN / variabel must be adjusted ====

$token = "bot"."1299833329:AAHPzf6fAuvFznSxh6NOtstsETnONk0m_rY";
$proxy = "";
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_dbname = "chatbot";

// ==== END / variabel must be adjusted ====


$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
if(! $conn ) {
  die('Could not connect: ' . mysqli_error());
}

$db_selected = mysqli_select_db($conn,$mysql_dbname);
if (!$db_selected) {
  die ('Can\'t use foo : ' . mysqli_error() .'<br>');
}


$updates = file_get_contents("php://input");

$updates = json_decode($updates,true);
$pesan = $updates[message][text];
$chat_id = $updates[message][chat][id];


include 'routing_pertanyaan.php';
// $pesan = strtoupper($pesan);
// if(strpos($pesan,"AFTAR#")>0){
// 	$datas = explode("#",$pesan);
// 	$nama = $datas[1];
// 	$alamat = $datas[2];
// 	$hp = $datas[3];
// 	$sql = "insert into data_telegram values ('$nama','$alamat','$hp', now())";
// 	if(mysqli_query($conn,$sql)) {
// 		$pesan_balik = "Terima kasih Data Anda sudah kami simpan.";
// 	}
// 	else $pesan_balik = "Data gagal disimpan silahkan coba lagi";
// }
// else $pesan_balik = "Mohon maaf format yang Anda kirim salah, silahkan kirim ulang dengan Format DAFTAR%23[NAMA]%23[ALAMAT]%23[HP] Contoh Monster Mahoni%23Jalan Anggrek No 1 Jakarta%2308581234567";
// if (isset($pesan)) {
// 	$pesan_balik = "nama mu ". $nama . ", alamat mu ". $alamat . ", nomor hp mu ". $hp;
// }
// else{
// 	 $pesan_balik = "halo guys ... id chat mu : " . $chat_id;
// }

$url = "https://api.telegram.org/$token/sendMessage?parse_mode=markdown&chat_id=$chat_id&text=$pesan_balik";

$ch = curl_init();
	
if($proxy==""){
	$optArray = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CAINFO => "C:\cacert.pem"	
	);
}
else{ 
	$optArray = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_PROXY => "$proxy",
		CURLOPT_CAINFO => "C:\cacert.pem"	
	);	
}
	
curl_setopt_array($ch, $optArray);
$result = curl_exec($ch);
	
$err = curl_error($ch);
curl_close($ch);	
	
if($err<>"") echo "Error: $err";
else echo "Pesan Terkirim";

?>