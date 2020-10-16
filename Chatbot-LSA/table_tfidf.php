<?php  
include 'tfidf.php';
$data = mysqli_query($connect, "SELECT * FROM pertanyaan");
$input_text= ""; 
while ($d = mysqli_fetch_array($data)) {
	$input_text = $input_text . ' ' . $d['pertanyaan'] ;
}


$con=new tfidf();
$output_txt = $hasilStem2;

$con->proses($input_text,$output_txt);


?>
<div class="tab-pane" id="tfidf">
<h2>Hasil Pembobotan Kata </h2><hr><br>
<?php echo "N atau Jumlah Kalimat = " . count($hasilStem); ?>
<!-- 	<?php 
	echo "<pre>";
	echo "Input <br>";
	print_r($input_text);
	echo "<br>";
	echo "<br>";
	echo "Output <br>";
	print_r($output_txt);
	echo "<br>";
	echo "<br>";
	echo "ini apa yaaaa <br>";
	print_r($con);
	echo "</pre>";
	?> -->
	<table style="margin-top:30px;" class="table table-bordered">
		<thead>
			<tr>
				<th>Q</th>
				<?php
				// session_start();
				$table1=$con->table1;
				$f=0;
				foreach ($hasilStem as $kunci) {
					echo "<th>D".$f."</th>";
					++$f;
				} 
				?>
				<th>df</th>
				<th>D/df</th>
				<th>IDF</th>
			</tr>
		</thead>
		<tbody>
<!-- 			<?php 
			foreach ($w as $key) {
				?>
				<tr>
					<td><?php echo $key; ?></td>
				</tr>

				<?php } ?> -->
				<?php
				$p=0;
				foreach ($table1 as $kunci) {
					echo "<tr>
					<td>".$kunci['term']."</td>";
					foreach ($kunci['dok'] as $key1) {
						echo "<td>".$key1."</td>";
					}

					echo "<td>".$kunci['df']."</td>
					<td>".$kunci['Ddf']."</td>
					<td>".$kunci['idf']."</td>
					</tr>";
					++$p;
				}    
				?>
			</tbody>
		</table>

			<table class="table table-bordered">
				<thead>
					<tr>
						<?php
						$table2=$con->table2;
						$f=1;
						foreach ($table2 as $key) {
							echo "<th>Kalimat ".$f."</th>";
							++$f;
						} ?>
					</tr>
				</thead>
				<tbody>


<!--      <?php
     $counter=count($table2[0]['a']);
    for ($h=0;$h<$counter;++$h) {
        echo "<tr>";
        for ($e=0;$e<count($table2);++$e) {
            echo "<td>".$table2[$e]['a'][$h]."</td>";
        }
        echo "</tr>";
        //  print_r($table2[$q][1]);
    } ?> -->

    <?php
    $counter=count($table2[0]);
    for ($h=0;$h<$counter;++$h) {
    	echo "<tr>";
    	for ($e=0;$e<count($table2);++$e) {
    		echo "<td>".$table2[$e][$h]."</td>";
    	}
    	echo "</tr>";
        //  print_r($table2[$q][1]);
    } ?>
</tbody>
</table>
</div>