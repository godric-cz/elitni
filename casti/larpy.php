<h2>Larpy</h2>
<div class="larpyVypis">
  <?php
  $result=$db->query(
    'SELECT id,nazev FROM aktivita'
  );
  while ($row = $result->fetch_row()) {
    $id=$row[0];
    $nazev=$row[1];
    echo '<a href="hra/'.$id.'"><div class="larpThumb">';
    echo '<img src="soubory/hry/nahledy/'.$id.'.jpg">';
    echo '<div class="larpNazev">'.$nazev.'</div>';
    echo '</div></a>';
  }
  ?>

</div>
