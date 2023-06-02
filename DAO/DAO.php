<?php

namespace DAO;

abstract class DAO {
    protected $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }

    public abstract function exists(object $obj);
    public abstract function create(object $obj);
    public abstract function update(object $obj);
    public abstract function delete(object $obj);
}
?>