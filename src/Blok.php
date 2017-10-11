<?php

class Blok {

    private
        $konec,
        $zacatek;

    function __construct(DateTimeImmutable $zacatek, DateTimeImmutable $konec) {
        $this->zacatek = $zacatek;
        $this->konec = $konec;
    }

    function konec(): DateTimeImmutable {
        return $this->konec;
    }

    function zacatek(): DateTimeImmutable {
        return $this->zacatek;
    }

    static function zRetezcu(string $zacatek, string $konec): self {
        return new self(
            new DateTimeImmutable($zacatek),
            new DateTimeImmutable($konec)
        );
    }

}
