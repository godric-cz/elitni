<?php

class Url {

    private
        $casti;

    private static $povoleneVUrl = '/^[a-z0-9]+$/';

    private function __construct(string $cesta) {
        $casti = explode('/', $cesta);
        if($casti !== ['']) {
            foreach($casti as $i => $cast) {
                if(!preg_match(self::$povoleneVUrl, $cast)) {
                    throw new NepovolenaUrl;
                }
            }
        }

        $this->casti = $casti;
    }

    function cast(int $i): string {
        if(!isset($this->casti[$i])) throw new NeexistujiciCastUrl;
        return $this->casti[$i];
    }

    function stranka(): string {
        return $this->casti[0];
    }

    function zanoreni(): int {
        return count($this->casti) - 1;
    }

    static function zCesty(string $cesta): self {
        return new self($cesta);
    }

}

class NepovolenaUrl extends Exception {}
class NeexistujiciCastUrl extends Exception {}
