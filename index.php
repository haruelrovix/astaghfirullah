<?php
  $image = 'https://i.ytimg.com/vi/PDBxPlWl3k4/maxresdefault.jpg';
  $imageData = base64_encode(file_get_contents($image));
  echo '<img width="75%" src="data:image/jpeg;base64,'.$imageData.'">';
?>