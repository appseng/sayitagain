<!--	Copyright © 2015 - sayitagain.pw 
 	Author - Dmitry Kuznetsov		-->
 <?php
	    $r = rand(1,49);
	    $f = fopen("quotes.txt", "r");
	    for ($k=1; $k<$r; $k++)
	      fgetcsv($f, 512, '%');
	    
	    $quote = fgetcsv($f, 512, '%');
	    fclose($f);
	    echo "<span>A quote for language learners* :</span>";
	    echo "<blockquote>";
	    echo $quote[0];
	    echo "<footer>";
	    echo $quote[1];
	    echo "</footer></blockquote>";
	    echo "<br /><br /><br /><br /><br /><br /><span class=\"mark\">* A quote appears if there are no learners of a chosen language or if you have just visited this web-site. Enjoy it anyway.</span>";
?>