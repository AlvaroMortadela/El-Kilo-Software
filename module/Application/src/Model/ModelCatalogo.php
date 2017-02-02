<?php namespace Application\Model;


use Zend\Db\Sql\Select;
use Zend\Db\Sql\Predicate\Expression;

class ModelCatalogo extends ModelBuilder {

    public function getTiendaCatalogo($id_tienda){

        // Se pueden usar estilos de consulta clásicos con fin de aprovechamiento del performance
        $adapter=$this->db;
        $query="SELECT
m_productos.id_producto,
m_productos.clave_producto,
m_productos.id_tienda,
m_productos.existencias,
m_tiendas.id_tienda,
m_tiendas.nombre_tienda,
m_tiendas.ubicacion_tienda,
m_tiendas.telefono_tienda,
m_tiendas.`numero_de _empleados`,
m_tiendas.matriz,
c_productos.id_datos_productos,
c_productos.clave_producto,
c_productos.nombre_producto,
c_productos.precio_producto,
c_productos.datos_producto,
c_productos.imagen_producto
FROM
m_productos
INNER JOIN m_tiendas ON m_productos.id_tienda = m_tiendas.id_tienda
INNER JOIN c_productos ON m_productos.clave_producto = c_productos.clave_producto
WHERE
m_productos.id_tienda = $id_tienda";
        return $this->db->query($query,$adapter::QUERY_MODE_EXECUTE)
            ->toArray();
/********** Se pueden utilizar las herramientas de los frameworks para obtener resultados************
        $select=$this->sql->select();
        $select->from(array('a' => 'm_productos'))

            ->join(array('b'=>'c_productos'), 'a.clave_producto=b.clave_producto')
            ->join(array('c'=>'m_tiendas'), 'a.id_tienda=c.id_tienda')
        ->where('a.id_tienda'===    2);
        $statement= $this->sql->prepareStatementForSqlObject($select);
        $data=$statement->execute();
        return $this->resultset->initialize($data)->toArray();
*****************************************************************************************************/

    }
public function insertarProducto($data){
        unset($data['existencias']);
        $insert=$this->sql->insert('c_productos');
        $insert->values($data);
    $statement= $this->sql->prepareStatementForSqlObject($insert);
    $statement->execute();

}
public function insertarExistencia($datos){

    $insert=$this->sql->insert('m_productos');
    $insert->values(array('id_tienda'=>$datos['id_tienda'],'clave_producto'=>$datos['clave_producto'],'existencias'=>$datos['existencias']));
    $statement= $this->sql->prepareStatementForSqlObject($insert);
    $statement->execute();

}
public function obtenerProductos($clave){
    $adapter = $this->db;
    $query = "SELECT * FROM m_productos WHERE clave_producto=$clave";
    return $this->db->query($query, $adapter::QUERY_MODE_EXECUTE)
        ->toArray();
}
    public function obtenerProductosId($id){
        $adapter = $this->db;
        $query = "SELECT * FROM m_productos WHERE id_producto=$id";
        return $this->db->query($query, $adapter::QUERY_MODE_EXECUTE)
            ->toArray();
    }
    public function actalizarExistencia($resultado,$id){
        $adapter = $this->db;
        $query = "UPDATE m_productos SET existencias=$resultado WHERE id_producto=$id";
        return $this->db->query($query, $adapter::QUERY_MODE_EXECUTE);
    }

public function getTiendaTotal($id_tienda)
{
    $adapter = $this->db;
    $query = "SELECT
m_productos.id_producto,
m_productos.clave_producto,
m_productos.id_tienda,
m_productos.existencias,
m_tiendas.id_tienda,
m_tiendas.nombre_tienda,
m_tiendas.ubicacion_tienda,
m_tiendas.telefono_tienda,
m_tiendas.`numero_de _empleados`,
m_tiendas.matriz,
c_productos.id_datos_productos,
c_productos.clave_producto,
c_productos.nombre_producto,
c_productos.precio_producto,
c_productos.datos_producto,
c_productos.imagen_producto
FROM
m_productos
INNER JOIN m_tiendas ON m_productos.id_tienda = m_tiendas.id_tienda
INNER JOIN c_productos ON m_productos.clave_producto = c_productos.clave_producto
WHERE
m_productos.id_tienda <> $id_tienda";
    return $this->db->query($query, $adapter::QUERY_MODE_EXECUTE)
        ->toArray();
}
}