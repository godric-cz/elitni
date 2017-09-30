<?php

class Aktivita extends DbObject {

    private $konec;
    private $zacatek;

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

    function konec(): DateTimeImmutable {
        if(!$this->konec) {
            $this->konec = new DateTimeImmutable($this->r['konec']);
        }
        return $this->konec;
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

        $this->db->query(
            'INSERT INTO prihlasen(uzivatel_id, aktivita_id) VALUES (?, ?)',
            $u->id(),
            $this->id()
        );
    }

    function volnoPro(Uzivatel $u): bool {
        $m  = $this->r['prihlaseno_m'];
        $f  = $this->r['prihlaseno_f'];
        $ku = $this->r['kapacita_u'];
        $km = $this->r['kapacita_m'];
        $kf = $this->r['kapacita_f'];

        if($m + $f >= $ku + $km + $kf)
            return false; // beznadějně plno
        if($u->pohlavi() == 'm' && $m >= $ku + $km)
            return false; // muži zabrali všechna univerzální i mužská místa
        if($u->pohlavi() == 'f' && $f >= $ku + $kf)
            return false; // ženy zabraly všechna univerzální i ženská místa

        return true; // je volno a žádné pohlaví nevyžralo limit míst
    }

    function zacatek(): DateTimeImmutable {
        if(!$this->zacatek) {
            $this->zacatek = new DateTimeImmutable($this->r['zacatek']);
        }
        return $this->zacatek;
    }

}

class PrekrytiAktivit extends Exception {}
class Plno extends Exception {}
