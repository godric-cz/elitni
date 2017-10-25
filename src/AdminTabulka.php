<?php

class AdminTabulka {

    private static $styl = '
        <style type="text/css">
            table { border-collapse: collapse; }
            td, th { border: solid 1px; padding: 0.1em 0.3em; }
        </style>
    ';

    static function zobraz(Db $db, string $dotaz): void {
        $q = $db->query($dotaz);

        echo self::$styl;
        echo '<table>';

        // hlavičky
        $r = $q->fetch_assoc();
        unset($r['prihlaska']);
        $hlavicky = array_keys($r);
        echo "<tr>";
        foreach($hlavicky as $hlavicka) {
            $hlavicka = strtr($hlavicka, ['#' => '']);
            echo "<th>$hlavicka</th>";
        }
        echo "</tr>";

        // řádky tabulky
        foreach($q as $r) {
            echo '<tr>';
            if(isset($r['prihlaska'])) {
                $prihlaska = json_decode($r['prihlaska'], true);
                unset($r['prihlaska']);
            }
            foreach($r as $p) {
                if($p[0] == '#') {
                    $p = $prihlaska[substr($p, 1)];
                }
                echo "<td>$p</td>";
            }
            echo '</tr>';
        }

        echo '</table>';
    }

}
