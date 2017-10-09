<?php
$id=$url->cast(1); //url je objekt, nula je nazev stranky, jedna je za dalsim lomitkem
$hra=Aktivita::zId($id);

?>

<div class="pruh obrazekHra" style="height: 300px; background-image: url(soubory/hry/<?=$id?>.jpg);"></div>
<div class="pruh">
  <div class="obsah">
    <div class=hraPredchozi>
      <a href="./hra/<?=$hra->aktivitaPredchozi()->id()?>">
        &laquo Předchozí: <?=$hra->aktivitaPredchozi()->nazev()?>
      </a>
    </div>
    <div class=hraDalsi>
      <a href="./hra/<?=$hra->aktivitaDalsi()->id()?>">
        Další: <?=$hra->aktivitaDalsi()->nazev()?> &raquo
      </a>
    </div>

    <div class=hraDetail>
      <h2><?=$hra->nazev()?></h2>
      <table>
        <tr>
          <td>Autoři:</td>
          <td><?=$hra->autor()?></td>
        </tr>
        <tr>
          <td>Cena:</td>
          <td><?=$hra->cena()?> Kč</td>
        </tr>
        <tr>
          <td>Počet hráčů:</td>
          <td><?=$pocetHracu=$hra->pocetHracu();?> hráčů</td>
        </tr>
      </table>
    </div>

    <div class=hraAnotace>
      <?=$hra->anotace()?>
    </div>

    <div class=hraDetail>
      <table>
        <tr>
          <td>Uvádí:</td>
          <td><?=$hra->uvadec()?></td>
        </tr>
      </table>

      <a href="<?=$hra->larpdb()?>" target="_blank">
        <div class="larpdbLink outer">
          <div class="larpdbLink inner">Larp na larpové databázi</div>
        </div>
      </a>
  </div>
</div>
