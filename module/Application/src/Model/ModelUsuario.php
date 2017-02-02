<?php namespace Application\Model;


class ModelUsuario extends ModelBuilder {

    public function getUser($mail){
        $select=$this->sql->select();
        $select->from('m_usuarios');
        $select->where($mail);
        $statement= $this->sql->prepareStatementForSqlObject($select);
        $data=$statement->execute();
        return $this->resultset->initialize($data)->toArray();

    }


}