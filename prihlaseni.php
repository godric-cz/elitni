<?php

require 'src/_zavadec.php';

require 'casti/admin-form.php';

$q = $db->query("
    SELECT
        uzivatel.prihlaska,
        GROUP_CONCAT(aktivita.nazev SEPARATOR ', ') AS aktivity,
        SUM(aktivita.cena) AS cena
    FROM uzivatel
    LEFT JOIN prihlasen ON prihlasen.uzivatel_id = uzivatel.id
    LEFT JOIN aktivita ON aktivita.id = prihlasen.aktivita_id
    GROUP BY uzivatel.id
");

$r = $q->fetch_assoc();
$hlavicky = array_keys(json_decode($r['prihlaska'], true));

ob_start();
foreach($q as $r) {
    echo '<tr>';
    $prihlaska = json_decode($r['prihlaska'], true);
    foreach($hlavicky as $sloupec) {
        echo '<td>' . ($prihlaska[$sloupec] ?? '') . '</td>';
    }
    $cena = $r['cena'];
    if($prihlaska['Tričko'] == 'ano')       $cena += 150;
    if($prihlaska['Ubytování'] == 'ano')    $cena += 50;
    echo '<td>' . $r['aktivity'] . '</td>';
    echo '<td>' . $cena . '</td>';
    echo '</tr>';
}
$tabulka = ob_get_clean();

?>

<style type="text/css">
    table { border-collapse: collapse; }
    td, th { border: solid 1px; padding: 0.1em 0.3em; }
</style>

<table>
    <tr>
        <th><?=implode('</th><th>', $hlavicky)?></th>
        <th>Aktivity</th>
        <th>Platba</th>
    </tr>
    <?=$tabulka?>
</table>
