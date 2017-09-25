<?php

class Uzivatel {

    private function aktivity() {

    }

    function maVolnoNa(Aktivita $a) {
        foreach($this->aktivity() as $stavajiciAktivita) {
            if($stavajiciAktivita->kryjeSe($a)) return false;
        }
        return true;
    }

    static function zMailu(string $mail) {

    }

}
