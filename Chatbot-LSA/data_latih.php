<div class="tab-pane" id="latih">
	<h2>Data Latih Pertanyaan</h2><hr>
	<div>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#kalimat" aria-controls="kalimat" role="tab" data-toggle="tab">Pemecah kalimat</a></li>
			<li role="presentation"><a href="#case" aria-controls="case" role="tab" data-toggle="tab">Case Folding</a></li>
			<li role="presentation"><a href="#token" aria-controls="token" role="tab" data-toggle="tab">Tokenizing</a></li>
			<li role="presentation"><a href="#stopwords" aria-controls="stopwords" role="tab" data-toggle="tab">Stop Words Removal</a></li>
			<li role="presentation"><a href="#stem" aria-controls="stem" role="tab" data-toggle="tab">Stemming</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		<!-- ................................. pecah kalimat ..........................................-->
		<div role="tabpanel" class="tab-pane active" id="kalimat">
			<h2>Hasil Pecah Kalimat</h2><hr><br>
			<?php //print_r($pisahKalimat); ?>
			<table class="table table-bordered">
				<tr align="center" class="active">
					<td>Kalimat ke-</td>
					<td>Isi Kalimat</td>
				</tr>
				<?php for ($i=0; $i < $panjang ; $i++) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><?php echo $pisahKalimat[$i]; ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<!-- .............................end pemisahan kalimat .......................................-->
		<!-- ................................. case folding ...........................................-->
		<div role="tabpanel" class="tab-pane" id="case">
			<h2>Hasil Case Folding</h2><hr><br>
			<?php //print_r($caseFolding); ?>
			<table align="center" class="table table-bordered">
				<tr align="center" class="active">
					<td>Kalimat ke-</td>
					<td>Isi Kalimat</td>
				</tr>
				<?php for ($i=0; $i < $panjang ; $i++) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><?php echo $caseFolding[$i]; ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<!-- ............................... end case folding .........................................-->
		<!-- .................................. tokenisasi ............................................-->
		<div role="tabpanel" class="tab-pane" id="token">
			<h2>Hasil Tokenizing</h2><hr><br>
			<?php //print_r($tokenizing); ?>
			<table class="table table-bordered">
				<tr class="active" align="center">
					<td>Kalimat ke-</td>
					<td colspan="3">Kata Dalam Kalimat</td>
				</tr>
				<?php for ($i=0; $i < $banyakKata ; $i++) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<?php 	
						echo "<td>";
						for ($j=0; $j < count($tokenizing[$i]); $j++) { 
							echo $tokenizing[$i][$j] . " | ";
						}
						echo "</td>";	
						?>
					</tr>
				<?php } ?>
			</table>
		</div>
		<!-- ...............................end tokenisasi ............................................-->
		<!-- ................................. stop words. ............................................-->
		<div role="tabpanel" class="tab-pane" id="stopwords">
			<h2>Hasil Stop Words Removal</h2><hr><br>
			<?php //print_r($stopwordsRemoved); ?>
			<table class="table table-bordered">
				<tr class="active" align="center">
					<td>Kalimat ke-</td>
					<td colspan="3">Kata Dalam Kalimat</td>
				</tr>
				<?php for ($i=0; $i < $banyakKata ; $i++) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<?php 	
						echo "<td>";
						for ($j=0; $j < count($stopwordsRemoved[$i]); $j++) { 
							echo $stopwordsRemoved[$i][$j] . " | ";
						}
						echo "</td>";	
						?>
					</tr>
				<?php } ?>
			</table>
		</div>
		<!-- ........................................ end stop words. .................................-->
		<!-- ........................................ stem. ...........................................-->
		<div role="tabpanel" class="tab-pane" id="stem">
			<h2>Hasil Stemming</h2><hr><br>
			<?php //print_r($hasilStem); ?>
			<table class="table table-bordered">
				<tr class="active" align="center">
					<td>Kalimat ke-</td>
					<td colspan="3">Kata Dalam Kalimat</td>
				</tr>
				<?php for ($i=0; $i < count($hasilStem) ; $i++) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<?php 	
						echo "<td>";
						for ($j=0; $j < count($hasilStem[$i]); $j++) { 
							echo $hasilStem[$i][$j] . " | ";
						}
						echo "</td>";
						?>
					</tr>
				<?php } ?>
			</table>
		</div>
		<!-- ........................................ end stem ........................................-->
	</div>
</div>
</div>