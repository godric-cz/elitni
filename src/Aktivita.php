<?php

class Aktivita extends DbObject {

    protected static $tabulka = 'aktivita';

    protected static function dotaz($where): string {
        return "
            SELECT
                aktivita.*,
                SUM(IF(uzivatel.pohlavi = 'm', 1, 0)) as prihlaseno_m,
                SUM(IF(uzivatel.pohlavi = 'f', 1, 0)) as prihlaseno_f
            FROM aktivita
            LEFT JOIN prihlasen ON prihlasen.aktivita_id = aktivita.id
            LEFT JOIN uzivatel ON uzivatel.id = prihlasen.uzivatel_id
            WHERE $where
            GROUP BY aktivita.id
        ";
    }

    function kryjeSe(Aktivita $a): bool {
        return !(
            $a->konec() <= $this->zacatek() ||
            $this->konec() <= $a->zacatek()
        );
    }

    function nazev(): string {
        return $this->r['nazev'];
    }

    function prihlas(Uzivatel $u): void {
        if(!$this->volnoPro($u))    throw new Plno;
        if(!$u->maVolnoNa($this))   throw new PrekrytiAktivit;
        throw new Neimplementovano;
    }

    function volnoPro(Uzivatel $u): bool {
        $m  = $this->r['prihlaseno_m'];
        $f  = $this->r['prihlaseno_f'];
        $ku = $this->r['kapacita_u'];
        $km = $this->r['kapacita_m'];
        $kf = $this->r['kapacita_f'];

        if($m + $f >= $ku + $km + $kf)
            return false; // beznadějně plno
        if($u->pohlavi() == 'f' && $m >= $ku + $km)
            return false; // muži zabrali všechna univerzální i mužská místa
        if($u->pohlavi() == 'm' && $f >= $ku + $kf)
            return false; // ženy zabraly všechna univerzální i ženská místa

        return true; // je volno a žádné pohlaví nevyžralo limit míst
    }

}

class PrekrytiAktivit extends Exception {}
class Plno extends Exception {}
