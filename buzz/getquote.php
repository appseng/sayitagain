 <?php
	    $r = rand(1,49);
	    $f = fopen("quotes.txt", "r");
	    for ($k=1; $k<$r; $k++)
	      fgetcsv($f, 512, '%');
	    
	    $quote = fgetcsv($f, 512, '%');
	    fclose($f);
			$res = [
				"quote",
				[
					'blockquote' => "$quote[0]",
					'footer' => "$quote[1]"
				]
			];
			echo json_encode($res);
	
?>