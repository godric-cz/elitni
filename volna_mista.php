<?php

require 'src/_zavadec.php';
$head='<head>
    <title>Volná místa</title>
    <link rel="stylesheet" type="text/css" href="soubory/styl.css?v3">
    <link rel="icon" href="soubory/diamond.png" type="image/png" sizes="16x16">
    <meta property="og:url"             content="http://festivalelitnichlarpu.vip">
    <meta property="og:title"           content="Festival elitních larpů">
    <meta property="og:description"     content="Exkluzivní zážitek. Pouze hry v červených číslech. Larpový galavečer. V.I.P. hosté. Šampaňské a červený koberec. To nejlepší z české larpové scény na Festivalu elitních larpů. V Brně, samozřejmě.">
    <meta property="og:image"           content="http://festivalelitnichlarpu.vip/soubory/fb_logo.jpg">
</head>';

echo $head;
echo '<div class="mista">
        <table>
            <tr>
                <td>Název</td>
                <td>Volná mužská</td>
                <td>Volná ženská</td>
                <td>Volna obojetná</td>
            </tr>
     ';

for ($i=1;$i<=22;$i++) {
    $q1 = $db->query("
    SELECT a.nazev,a.kapacita_m,a.kapacita_f,kapacita_u,COUNT(u.pohlavi) FROM prihlasen p
        RIGHT JOIN uzivatel u
        ON p.uzivatel_id=u.id
        LEFT JOIN aktivita a
        ON p.aktivita_id=a.id
        WHERE p.aktivita_ID IS NOT NULL
        AND u.pohlavi='f'
        AND aktivita_id='$i'
    ");

    $q2 = $db->query("
    SELECT COUNT(u.pohlavi) FROM prihlasen p
        RIGHT JOIN uzivatel u
        ON p.uzivatel_id=u.id
        WHERE p.aktivita_ID IS NOT NULL
        AND u.pohlavi='m'
        AND aktivita_id='$i'
    ");

    $row1 = mysqli_fetch_row($q1);
    $row2 = mysqli_fetch_row($q2);
    $nazev=$row1[0];
    $kapacita_m=$row1[1];
    $kapacita_f=$row1[2];
    $kapacita_u=$row1[3];
    $prihlaseni_f=$row1[4];
    $prihlaseni_m=$row2[0];
    $prihlaseni_u=0;
    $volne_f=$kapacita_f-$prihlaseni_f;
    $volne_m=$kapacita_m-$prihlaseni_m;
    if ($volne_m<0) {
            $prihlaseni_u+=abs($volne_m);
            $volne_m+=abs($volne_m);
    }
    if ($volne_f<0) {
            $prihlaseni_u+=abs($volne_f);
            $volne_f+=abs($volne_f);
    }
    $volne_u=$kapacita_u-$prihlaseni_u;
    if (($i!=1)&&($i!=12)&&($volne_u>0||$volne_m>0||$volne_f>0)) {
        echo '<tr>
                <td>'.$nazev.'</td>
                <td>'.$volne_m.'</td>
                <td>'.$volne_f.'</td>
                <td>'.$volne_u.'</td>
              </tr>';
    }

}

echo '</div>
        </table>';
