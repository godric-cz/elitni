<?php

class Aktivita {

    function kryjeSe(Aktivita $a) {

    }

    function prihlas(Uzivatel $u) {
        if(!$this->volnoPro($u))    throw new Plno;
        if(!$u->maVolnoNa($this))   throw new PrekrytiAktivit;
    }

    private function volnoPro(Uzivatel $u) {

    }

}

class PrekrytiAktivit extends Exception {}
class Plno extends Exception {}
