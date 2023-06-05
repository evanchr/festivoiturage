<?php

namespace DAO;

abstract class DAO {
    protected $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }

    public abstract function connexion(object $obj);
    public abstract function exists(object $obj);
    public abstract function create(object $obj);
    public abstract function update(object $obj, String $oldlog);
    public abstract function delete(object $obj);
}
?>