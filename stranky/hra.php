<div class="pruh">
<?php
$hra=Aktivita::zId(1);
echo '<h2>'.$hra->nazev().'</h2>';
echo '
  <table class="hra">
    <tr>
      <td>Uvádí:</td>
      <td>'.$hra->uvadec().'</td>
    </tr>
    <tr>
      <td>Cena:</td>
      <td>'.$hra->cena().' Kč</td>
    </tr>
    <tr>
      <td>Počet hráčů:</td>
      <td>'.$hra->pocetHracu().' hráčů</td>
    </tr>
  </table>
';
?>
</div>
