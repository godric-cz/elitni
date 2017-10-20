<?php

require 'src/_zavadec.php';

require 'casti/admin-form.php';

$q = $db->query('
    SELECT
        aktivita.nazev,
        uzivatel.prihlaska,
        uzivatel.mail
    FROM aktivita
    LEFT JOIN prihlasen ON prihlasen.aktivita_id = aktivita.id
    LEFT JOIN uzivatel ON uzivatel.id = prihlasen.uzivatel_id
    ORDER BY aktivita.nazev
');

ob_start();
foreach($q as $r) {
    $prihlaska = json_decode($r['prihlaska'], true);
    echo '<tr>';
    echo "<td>$r[nazev]</td>";
    echo "<td>" . substr($prihlaska['Jméno'], 0, 50) . "</td>";
    echo "<td>$prihlaska[Telefon]</td>";
    echo "<td>$r[mail]</td>";
    echo "<td>$prihlaska[Oslovení]</td>";
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
        <th>Hra</th>
        <th>Jméno</th>
        <th>Telefon</th>
        <th>E-mail</th>
        <th>Oslovení</th>
    </tr>
    <?=$tabulka?>
</table>
