<!--	Copyright © 2015 - sayitagain.pw 
 	Author - Dmitry Kuznetsov		-->
<?php
  $f = fopen("countries.csv", "r");
  echo "<select class=\"form-control lang selectpicker\" data-live-search=”true” id=\"location\" name=\"location\" required>\n";
  echo "<option value=\"\"  selected=\"selected\">Select location</option>\n";
  while (!feof($f)) {
    $quote = fgetcsv($f, 512, ',');
    echo "<option value=\"$quote[0]\">$quote[0] - $quote[1]</option>\n";
  }
  echo "</select>";
  fclose($f);
?>