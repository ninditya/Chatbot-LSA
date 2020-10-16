<div class="tab-pane active" id="tanya">
	<h2>Input Pertanyaan</h2><hr>
	<?php 
	$Query = $_POST['query'];	
	// $Query = $pesan;	
	?>
	<form method="post" action="">
		<label for="tanya">Query Pertanyaan: </label> <input type="text" name="query" placeholder="Query Pertanyaan"				/>
		<input type="submit" value="SIMPAN">
	</form>	
	<?php
	echo "<pre>";
	print_r($Query);
	echo "</pre>";
	$pisahKalimatQuery = pecahkalimat($Query); 
	$caseFoldingQuery = caseFolding($pisahKalimatQuery);
	$tokenizingQuery = tokenizing($caseFoldingQuery);
	$stopwordsRemovedQuery = stopwordsRemoval($stopWords,$tokenizingQuery);
	//count
	$panjangQuery = count($pisahKalimatQuery);
	$banyakKataQuery = count($tokenizingQuery);
	$banyakKataMSQuery = count($stopwordsRemovedQuery);

	for ($i=0; $i < count($stopwordsRemovedQuery) ; $i++) { 
		for ($j=0; $j < count($stopwordsRemovedQuery[$i]) ; $j++) { 
				//Stemming per kalimat
			$stemValQuery = stem_NaziefAndriani($stopwordsRemovedQuery[$i][$j]);
			$hasilStemQuery[$i][] = $stemValQuery;
				//Stemming per kata
			$stemVal2Query = stem_NaziefAndriani($stopwordsRemovedQuery[$i][$j]);
			$hasilStem2Query[$no++] = $stemVal2Query;
		}
	}
	?>
	<h4>Hasil Pecah Kalimat</h4>
	<table class="table table-bordered">
		<tr align="center" class="active">
			<td>Kalimat ke-</td>
			<td>Isi Kalimat</td>
		</tr>
		<?php for ($i=0; $i < $panjangQuery ; $i++) { ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $pisahKalimatQuery[$i]; ?></td>
			</tr>
		<?php } ?>
	</table>
	<h4>Hasil Case Folding</h4>
	<table class="table table-bordered">
		<tr align="center" class="active">
			<td>Kalimat ke-</td>
			<td>Isi Kalimat</td>
		</tr>
		<?php for ($i=0; $i < $panjangQuery ; $i++) { ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $caseFoldingQuery[$i]; ?></td>
			</tr>
		<?php } ?>
	</table>
	<h4>Hasil Tokenizing</h4>
	<table class="table table-bordered">
		<tr align="center" class="active">
			<td>Kalimat ke-</td>
			<td colspan="3">Kata Dalam Kalimat</td>
		</tr>
		<?php for ($i=0; $i < $banyakKataQuery ; $i++) { ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<?php 	
				echo "<td>";
				for ($j=0; $j < count($tokenizingQuery[$i]); $j++) { 
					echo $tokenizingQuery[$i][$j] . " | ";
				}
				echo "</td>";	
				?>
			</tr>
		<?php } ?>
	</table>
	<h4>Hasil Stop Words Removal</h4>
	<table class="table table-bordered">
		<tr align="center" class="active">
			<td>Kalimat ke-</td>
			<td colspan="3">Kata Dalam Kalimat</td>
		</tr>
		<?php for ($i=0; $i < $banyakKataQuery ; $i++) { ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<?php 	
				echo "<td>";
				for ($j=0; $j < count($stopwordsRemovedQuery[$i]); $j++) { 
					echo $stopwordsRemovedQuery[$i][$j] . " | ";
				}
				echo "</td>";	
				?>
			</tr>
		<?php } ?>
	</table>
	<h4>Hasil Stemming</h4>
	<table class="table table-bordered">
		<tr align="center" class="active">
			<td>Kalimat ke-</td>
			<td colspan="3">Kata Dalam Kalimat</td>
		</tr>
		<?php for ($i=0; $i < count($hasilStemQuery) ; $i++) { ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<?php 	
				echo "<td>";
				for ($j=0; $j < count($hasilStemQuery[$i]); $j++) { 
					echo $hasilStemQuery[$i][$j] . " | ";
				}
				echo "</td>";
				?>
			</tr>
		<?php } ?>
	</table>
	<!-- <h4>Hasil Stemming</h4>
	<table class="table table-bordered">
		<tr align="center" class="active">
			<td>Kalimat ke-</td>
			<td colspan="3">Kata Dalam Kalimat</td>
		</tr>
		<?php  
			$nilai_max = max($sorted);
			$id_max = array_search($nilai_max, $sorted);
		?>
		<?php for ($i=0; $i < $panjangQuery ; $i++) { ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $kalimatHasil[$id_max]; ?></td>
			</tr>
		<?php } ?>
	</table> -->
</div>