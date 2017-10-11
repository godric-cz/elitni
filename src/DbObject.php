<?php

/**
 * Abstrakce jednoduché třídy nad tabulkou databáze
 */
abstract class DbObject {

    protected $r; // řádek z databáze

    private static $cache; // cache objektů, aby nevznikal dvakrát objekt s stejným id

    protected static $tabulka;    // název tabulky - odděděná třída _musí_ přepsat
    protected static $pk = 'id';  // název primárního klíče - odděděná třída může přepsat

    public static $sdb; // statický přístup k DB

    /** Vytvoří objekt na základě řádku z databáze */
    protected function __construct($r) {
        $this->r = $r;
        $this->db = self::$sdb;
    }

    /**
     * Vrací dotaz z kterého se načítají objekty. Jako where podmínka se použije
     * parametr $where.
     * Protected, aby odděděná třída mohla v případě nepřepsání použít tuto metodu
     * v static kontextu. Má parametr $where, aby odděděná třída mohla před i za
     * přidávat bižuterii typu join, groupy, řazení, ...
     */
    protected static function dotaz($where) {
        return 'SELECT * FROM '.static::$tabulka.' WHERE '.$where;
    }

    /** Vrátí ID objektu (hodnota primárního klíče) */
    function id() {
        return $this->r[static::$pk];
    }

    /** Načte a vrátí objekt s daným ID nebo null */
    static function zId($id) {
        return self::zWhereRadek(static::$tabulka.'.'.static::$pk.' = '.self::$sdb->escape($id));
    }

    /**
     * Načte a vrátí pole objektů s danými ID (může být prázdné)
     * @param $ids pole čísel nebo řetězec čísel oddělených čárkami
     */
    static function zIds($ids) {
        if(is_array($ids)) {
            if(empty($ids)) return []; // vůbec se nedotazovat DB
            return self::zWhere(static::$tabulka.'.'.static::$pk.' IN ('.dbQa($ids).')');
        } else if(preg_match('@^([0-9]+,)*[0-9]+$@', $ids)) {
            return self::zWhere(static::$tabulka.'.'.static::$pk.' IN ('.$ids.')');
        } else if($ids === '') {
            return [];
        } else if($ids === null) {
            return [];
        } else {
            throw new InvalidArgumentException('Argument musí být pole čísel nebo řetězec čísel oddělených čárkou');
        }
        // TODO co když $ids === null?
    }

    /** Načte a vrátí všechny objekt z databáze */
    static function zVsech() {
        return self::zWhere('1');
    }

    /** Načte a vrátí objekty pomocí dané where klauzule */
    protected static function zWhere($where, ...$params) {
        $o = self::$sdb->query(static::dotaz($where), ...$params); // static aby odděděná třída mohla přepsat dotaz na něco složitějšího

        $a = [];
        $trida = static::class;
        while($r = mysqli_fetch_assoc($o)) {
            $id = $r[static::$pk];
            if(empty(self::$cache[$trida][$id])) { // ukládání do cache, aby se jeden objekt nevytvořil 2x
                self::$cache[$trida][$id] = new static($r); // static aby vznikaly objekty správné třídy
            }
            $a[] = self::$cache[$trida][$id];
            // TODO id jako klíč pole?
        }

        return $a;
    }

    /**
     * Načte a vrátí objekt vyhovující where klauzuli nebo null
     * @throws Exception pokud se načte více řádků
     */
    protected static function zWhereRadek($where, ...$params) {
        $a = self::zWhere($where, ...$params);
        if(count($a) == 1) {
            return $a[0];
        } else if(empty($a)) {
            return null;
        } else {
            throw new Exception('Více jak jeden řádek odpovídá where klauzuli');
            // TODO typ výjimky? Runtime nebo compile time?
        }
    }

}
