<!DOCTYPE html>
<?php 
	error_reporting(0);
	set_time_limit(0);
?>
<html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Otomatisasi Pelayanan Jurusan Teknik Informatika</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/bootstrap.vertical-tabs.css" rel="stylesheet">
</head>
<body>
	<?php
	include "./fungsi.php"; 
	include "./fungsi_svd.php"; 

	//koneksi 1 database ringkas
	$connect = connectDB('chatbot');

	$stopWords = file_get_contents("stopwords_id.txt");

	//init
	$pisahKalimat = [];
	$caseFolding = [];
	$tokenizing = [];
	$stopwordsRemoved = [];
	$hasilStem = [];
	$tf = [];
	$df = [];
	$w = []; //nilai tfidf (weight)
	$daftarKata = [];
	$dummy = [];
	$matrix = [];

	// koneksi 2 database chatbot
	$koneksi = mysqli_connect("localhost","root","","chatbot");

	// Check connection
	if (mysqli_connect_error()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}
	$data = mysqli_query($connect, "SELECT * FROM pertanyaan");
	$content= ""; 
	$content2= array(); 
	while ($d = mysqli_fetch_array($data)) {
		$content = $content . ' ' . $d['pertanyaan'] ;
		array_push($content2, $d['pertanyaan']);
	}
	
	// $input_text = clone $content;
	//$content = getContent();
	$no = 0;
	if (!empty($content2)) {
		// $content = trim($content);
		//panggil fungsi prepos trainning pertanyaan
		$pisahKalimat = pecahkalimat($content); 
		$caseFolding = caseFolding($pisahKalimat);
		$tokenizing = tokenizing($caseFolding);
		$stopwordsRemoved = stopwordsRemoval($stopWords,$tokenizing);
		
		//count
		$panjang = count($pisahKalimat);
		$banyakKata = count($tokenizing);
		$banyakKataMS = count($stopwordsRemoved);
	
		for ($i=0; $i < count($stopwordsRemoved) ; $i++) { 
			for ($j=0; $j < count($stopwordsRemoved[$i]) ; $j++) { 
				//Stemming per kalimat
				$stemVal = stem_NaziefAndriani($stopwordsRemoved[$i][$j]);
				$hasilStem[$i][] = $stemVal;
				//Stemming per kata
				$stemVal2 = stem_NaziefAndriani($stopwordsRemoved[$i][$j]);
				$hasilStem2[$no++] = $stemVal2;
			}
		}
	}
	else
		echo "tes";
	?>
	<!-- navbar -->
	<nav class="navbar navbar-default navbar-static-top">
	    <div class="container">
		    <div class="navbar-header"><a class="navbar-brand" href="index.php">Otomatisasi Pelayanan Jurusan Teknik Informatika</a></div>
	    </div>
	</nav>
	<div class="row">
		<!-- tab -->
		<div class="col-xs-3">
	    <!-- Nav tabs -->
		    <ul class="nav nav-tabs tabs-left">
		      	<li class="active"><a href="#input" data-toggle="tab">Pertanyaan</a></li>
		      	<li><a href="#hasil" data-toggle="tab">Data Latih Pertanyaan</a></li>
		      	<li><a href="#tfidf" data-toggle="tab">Pembobotan Kata</a></li>
		      	<li><a href="#lsa" data-toggle="tab">Latent Semantic Analysis</a></li>
		      	<li><a href="#hasil2" data-toggle="tab">Hasil</a></li>
		    </ul>
		</div>
		<div class="col-xs-9">
		    <!-- Tab panes -->
		    <div class="tab-content">
<!-- .................................pecah kalimat.................................................-->
		      	<div class="tab-pane active" id="input">
		      		<?php include 'tanya.php'; ?>
		      	</div>
<!-- .............................end pemisahan kalimat ..............................................-->
<!-- .................................hasil ringakasan ...............................................-->
		    	<div class="tab-pane" id="hasil">
		      		<?php include 'data_latih.php';	?>
		      	</div>
<!-- .................................end hasil ringakasan .........................................-->
<!-- ........................................ tf idf. ..............................................-->
		    	<div class="tab-pane" id="tfidf">
			    	<?php include 'table_tfidf.php';	?>
		    	</div>
<!-- ........................................ end tfidf. ..............................................-->
<!-- ........................................ stem. ..............................................-->
		      	<div class="tab-pane" id="lsa">
			      	<?php include 'lsa.php';	?>
		      	</div>
<!-- ........................................ end stem. ..............................................-->
		      	<div class="tab-pane" id="hasil2">
		      		<div class="tab-pane active" id="hasil2">
		      			<h4>Hasil Rekomendasi</h4>
		      			<table class="table table-bordered">
		      				<tr align="center" class="active">
		      					<td>Kalimat ke-</td>
		      					<td colspan="3">Kata Dalam Kalimat</td>
		      				</tr>
		      				<?php  
		      				$nilai_max = max($sorted);
		      				echo "Nilai : " . $nilai_max;
		      				echo "<br>";
		      				$id_max = array_search($nilai_max, $sorted);
		      				echo "Id Nilai: " . $id_max;
		      				echo "<br>";
		      				?>
		      				<?php for ($i=0; $i < $panjangQuery ; $i++) { ?>
		      					<tr>
		      						<td><?php echo $i+1; ?></td>
		      						<td><?php echo $kalimatHasil[$id_max]; ?></td>
		      					</tr>
		      				<?php } ?>
		      			</table>
		      			<pre>
		      				<?php print_r($content2); ?>
		      			</pre>
		      		</div>
		      	</div>
		    </div>
		</div> 
	</div>

	<script>
		function printValue(sliderID, textbox) {
	        var x = document.getElementById(textbox);
	        var y = document.getElementById(sliderID);
	        x.value = y.value;
        }
    </script>
	<script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>