<?php

require 'src/_zavadec.php';

require 'casti/admin-form.php';

AdminTabulka::zobraz($db, '
    SELECT
        prihlasen_log.cas as Čas,
        "#Jméno",
        aktivita.nazev as Hra,
        uzivatel.prihlaska
    FROM prihlasen_log
    LEFT JOIN prihlasen ON
        prihlasen.uzivatel_id = prihlasen_log.uzivatel_id AND
        prihlasen.aktivita_id = prihlasen_log.aktivita_id
    LEFT JOIN uzivatel ON uzivatel.id = prihlasen_log.uzivatel_id
    LEFT JOIN aktivita ON aktivita.id = prihlasen_log.aktivita_id
    WHERE
        cas > (now() - interval 7 day) AND
        operace = "o" AND
        prihlasen.aktivita_id IS NULL
');
