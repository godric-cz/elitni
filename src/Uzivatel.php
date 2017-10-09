<?php

class Uzivatel extends DbObject {

    private $aktivity;
    private $organizovaneAktivity;

    protected static $tabulka = 'uzivatel';

    private function aktivity(): array {
        if(!$this->aktivity) {
            $q = $this->db->query(
                'SELECT GROUP_CONCAT(aktivita_id) FROM prihlasen WHERE uzivatel_id = ?',
                $this->id()
            );
            $ids = mysqli_fetch_row($q)[0];
            $this->aktivity = Aktivita::zIds($ids);
        }
        return $this->aktivity;
    }

    function maVolnoNa(Aktivita $a): bool {
        foreach($this->aktivity() as $stavajiciAktivita) {
            if($stavajiciAktivita->kryjeSe($a)) return false;
        }
        foreach($this->organizovaneAktivity() as $organizovanaAktivita) {
            if($organizovanaAktivita->kryjeSe($a)) return false;
        }
        return true;
    }

    private function organizovaneAktivity(): array {
        if(!$this->organizovaneAktivity) {
            $q = $this->db->query(
                'SELECT GROUP_CONCAT(aktivita_id) FROM organizuje WHERE uzivatel_id = ?',
                $this->id()
            );
            $ids = mysqli_fetch_row($q)[0];
            $this->organizovaneAktivity = Aktivita::zIds($ids);
        }
        return $this->organizovaneAktivity;
    }

    function organizuje(Aktivita $a): bool {
        return in_array($a, $this->organizovaneAktivity());
    }

    function pohlavi(): string {
        return $this->r['pohlavi'];
    }

    function prihlasenNa(Aktivita $a): bool {
        return in_array($a, $this->aktivity()); // TODO objekt aktivita bude mít asi dvě identity, nějak pořešit
    }

    static function zMailu(string $mail) {
        return self::zWhereRadek('mail = ?', $mail);
    }

}
