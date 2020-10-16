<div class="tab-pane" id="lsa">
	<h2>Latent Semantic Analysis</h2><hr><br>
	<?php
		//matrix A
		echo "<pre><h3>TFIDF</h3>";
		$matrix = matrixTranspose($table2);
		print_r($matrix);
		echo "</pre>";
        //matrik SVD
	if (!empty($matrix)) {
		$svd = SVD($matrix);
		// hitung up, sp, vtp untuk SVD Reduksi
		$ini_k = 17;
		$svd_red = array();
		$svd_red['up'] = matrixConstruct($svd['U'], count($svd['U']), $ini_k);
		$svd_red['sp'] = matrixConstruct($svd['S'], $ini_k, $ini_k);
		$svd_red['vtp'] = matrixConstruct(matrixTranspose($svd['V']), $ini_k, count($svd['V']));
   	}
   		echo "<pre><h3>SVD</h3>";
   		print_r($svd);
   		echo "</pre>";
   		echo "<pre><h3>SVD Reduksi</h3>";
   		print_r($svd_red);
   		echo "</pre>";
   		//q^T (Transpose Query/kata kunci)
		$df_q = query($hasilStemQuery[0], $table1);
  		$query = array($df_q);
  		echo "<pre><h3>q^T</h3>";
   		print_r($query);
   		echo "</pre>";
  		// Sp^-1 ( Sp invers)
		$spinvers = invert($svd_red['sp']);
		echo "<pre><h3>Sp^-1</h3>";
   		print_r($spinvers);
   		echo "</pre>";
   		//q = q^T*U*S^-1
   		$qt_u = perkalian_matrix($query,$svd_red['up']);
		$qt_u_sinv = perkalian_matrix($qt_u,$spinvers);
		echo "<pre><h3>q^T*U</h3>";
   		print_r($qt_u);
		echo "<h3>q^T*U*S^-1</h3>";
   		print_r($qt_u_sinv);
   		echo "</pre>";
		// hitung hasil query dengan svd_red dengan Cosine Similarity
		$nilaicossim = cosinesimilarity($qt_u_sinv,$svd_red['vtp']);
		echo "<pre><h3>Cosine Similarity</h3>";
   		print_r($nilaicossim);
   		echo "</pre>";
   		//pengurutan nilai cosine
   		$sorted = $nilaicossim[0];
		arsort($sorted, SORT_NUMERIC);
		$kalimatHasil = array_replace($sorted, $pisahKalimat);
		echo "<pre><h3>Pengurutan Cosine Similarity</h3>";
   		print_r($sorted);
   		print_r($kalimatHasil);
   		echo "</pre>";
	?>
</div>
