<?php

class Db {

    private $connection;

    function escape($value) {
        if(is_int($value))
            return $value;
        else
            return "'" . $this->getConnection()->real_escape_string($value) . "'";
    }

    private function getConnection() {
        if(!$this->connection) {
            $this->connection = new mysqli(
                $GLOBALS['CONFIG']['db']['server'],
                $GLOBALS['CONFIG']['db']['user'],
                $GLOBALS['CONFIG']['db']['password'],
                $GLOBALS['CONFIG']['db']['database']
            );
            $this->connection->query('SET NAMES utf8');
        }
        return $this->connection;
    }

    function query(string $query, ...$params) {
        foreach($params as $p) {
            $pos = strpos($query, '?');
            if($pos === false) throw new Exception('more parameters than ? symbols in query pattern');
            $newQuery = substr($query, 0, $pos);
            $newQuery .= $this->escape($p);
            $newQuery .= substr($query, $pos + 1);
            $query = $newQuery;
        }
        $result = $this->getConnection()->query($query);
        if(!$result) {
            throw new Exception($this->getConnection()->error);
        }
        return $result;
    }

}
