<?php namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;

class ModelBuilder{

    public function __construct(){
        $this->db = new Adapter(array(
            'driver' => 'Mysqli',
            'database' => 'aetherdb',
            'username' => 'root',
            'password' => ''
        ));
        $this->sql= new Sql($this->db);
        $this->resultset= new ResultSet();
    }
    public function dataSelect(){
        $select=$this->sql->select();
        $select->from('m_usuarios');
        $statement= $this->sql->prepareStatementForSqlObject($select);
        $data=$statement->execute();
        return $this->resultset->initialize($data)->toArray();
    }



}
