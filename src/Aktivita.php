<?php

class Aktivita extends DbObject {

    private $konec;
    private $zacatek;
    private $aktivitaDalsi;
    private $aktivitaPredchozi;

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

    function aktivitaPredchozi(): Aktivita {
        if (!$this->aktivitaPredchozi)
          $this->aktivitaPredchozi = self::zWhereRadek('aktivita.id = (SELECT COALESCE(MAX(id), (SELECT MAX(id) FROM aktivita)) FROM aktivita WHERE id < ?)', $this->id()); //tohle vrací objekt Aktivita
        return $this->aktivitaPredchozi;
    }

    function aktivitaDalsi(): Aktivita {
      if (!$this->aktivitaDalsi)
        $this->aktivitaDalsi = self::zWhereRadek('aktivita.id = (SELECT COALESCE(MIN(id), (SELECT MIN(id) FROM aktivita)) FROM aktivita WHERE id > ?)', $this->id()); //tohle vrací objekt Aktivita
      return $this->aktivitaDalsi;
    }

    function anotace(): string {
        return markdown($this->r['popis']);
    }

    function autor(): string {
        return $this->r['autor'];
    }

    function cena(): string {
        return $this->r['cena'];
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

    function larpdb(): string {
        return $this->r['larpdb'];
    }

    function nazev(): string {
        return $this->r['nazev'];
    }

    function odhlas(Uzivatel $u): void {
        $this->db->query(
            'DELETE FROM prihlasen WHERE uzivatel_id = ? AND aktivita_id = ?',
            $u->id(),
            $this->id()
        );

        // logování
        $this->db->query(
            'INSERT INTO prihlasen_log(ip, aktivita_id, uzivatel_id, operace) VALUES (?, ?, ?, "o")',
            $_SERVER['REMOTE_ADDR'],
            $this->id(),
            $u->id()
        );
    }

    function pocetHracu($typ = null): int {
        if($typ === NULL) {
          return $this->r['kapacita_m'] + $this->r['kapacita_f'] + $this->r['kapacita_u'];
        } elseif($typ == 'm') {
          return $this->r['kapacita_m'];
        } elseif($typ == 'z') {
          return $this->r['kapacita_f'];
        } elseif($typ == 'u') {
          return $this->r['kapacita_u'];
        } else {
          return 0;
        }
    }

    function prihlas(Uzivatel $u): void {
        if(!$this->volnoPro($u))            throw new Plno;
        if(!$u->maVolnoNa($this))           throw new PrekrytiAktivit;
        //if($u->prihlasenoAktivit() >= 2)    throw new PrekrocenPocetAktivit;

        $this->db->query(
            'INSERT INTO prihlasen(uzivatel_id, aktivita_id) VALUES (?, ?)',
            $u->id(),
            $this->id()
        );

        // logování
        $this->db->query(
            'INSERT INTO prihlasen_log(ip, aktivita_id, uzivatel_id, operace) VALUES (?, ?, ?, "p")',
            $_SERVER['REMOTE_ADDR'],
            $this->id(),
            $u->id()
        );
    }

    function uvadec(): string {
        return $this->r['uvadec'];
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

class ChybaPrihlasovani extends Exception {}
class PrekrytiAktivit extends ChybaPrihlasovani {}
class Plno extends ChybaPrihlasovani {}
class PrekrocenPocetAktivit extends ChybaPrihlasovani {}
