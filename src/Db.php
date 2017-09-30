<?php

class Db {

    function __construct() {
        $this->connection = new mysqli(
            '127.0.0.1',
            'root',
            '',
            'elitni'
        );
    }

    function escape($value) {
        if(is_int($value))
            return $value;
        else
            return "'" . $this->connection->real_escape_string($value) . "'";
    }

    function query(string $query, ...$params) {
        foreach($params as $p) {
            $pos = strpos($query, '?');
            if($pos === false) throw new Exception('more parameters than ? symbols in query pattern');
            $escaped = "'" . $this->connection->real_escape_string($p) . "'";
            $newQuery = substr($query, 0, $pos);
            $newQuery .= $escaped;
            $newQuery .= substr($query, $pos + 1);
            $query = $newQuery;
        }
        $result = $this->connection->query($query);
        if(!$result) {
            throw new Exception($this->connection->error);
        }
        return $result;
    }

}
