<?php

class BusquedaInteligenteModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    // Funcion select_all

    public function getDataTerminologias(int $libro_id)
    {
        $sql = 'SELECT * FROM detalle_conocimiento As dc
        INNER JOIN detalle_niveles AS dn ON dc.detalle_niveles_id = dn.detalle_niveles_id
        INNER JOIN conocimiento AS c ON dc.conocimiento_id = c.conocimiento_id
        INNER JOIN detalle_terminologia_conocimiento AS dtc ON dtc.conocimiento_id = c.conocimiento_id
        INNER JOIN terminologias AS t ON dtc.terminologias_id = t.terminologias_id
        WHERE dn.libro_id = :libro_id AND t.terminologias_orden = 1
        ORDER BY detalle_niveles_orden ASC, parrafos_id ASC, detalle_conocimiento_orden ASC';
        $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
        return $result;
    }

    public function baseConocimiento()
    {
        $sql = 'SELECT * FROM detalle_terminologia_conocimiento As dtc
        INNER JOIN terminologias AS t ON dtc.terminologias_id = t.terminologias_id
        INNER JOIN conocimiento AS c ON dtc.conocimiento_id = c.conocimiento_id
        ORDER BY c.conocimiento_descripcion ASC';
        $result = $this->select_all($sql, array(), DB_BIB);

        return $result;
    }

    public function libroConceptos()
    {
        $sql = 'SELECT * FROM detalle_conocimiento As dc
        INNER JOIN detalle_niveles AS dn ON dc.detalle_niveles_id = dn.detalle_niveles_id
        INNER JOIN libro AS l ON dn.libro_id = l.libro_id
        ORDER BY l.libro_titulo ASC';
        $result = $this->select_all($sql, array(), DB_BIB);

        return $result;
    }

    public function selectTitulosLibroById(int $libro_id)
    {
        $sql = 'SELECT * FROM detalle_niveles
        INNER JOIN niveles ON detalle_niveles.niveles_id = niveles.niveles_id
        WHERE detalle_niveles.libro_id = :libro_id
        ORDER BY niveles.niveles_orden ASC, detalle_niveles.detalle_niveles_orden ASC';
        $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
        return $result;
    }

    public function selectConocimientosTitulos(int $libro_id)
    {
        $sql = 'SELECT * FROM detalle_conocimiento
        INNER JOIN detalle_niveles ON detalle_conocimiento.detalle_niveles_id = detalle_niveles.detalle_niveles_id
        INNER JOIN parrafos ON detalle_conocimiento.parrafos_id = parrafos.parrafos_id
        INNER JOIN conocimiento ON detalle_conocimiento.conocimiento_id = conocimiento.conocimiento_id
        -- LEFT JOIN terminologias ON detalle_conocimiento.terminologias_id = terminologias.terminologias_id
        WHERE detalle_niveles.libro_id = :libro_id
        ORDER BY detalle_niveles.niveles_id ASC, parrafos.parrafos_orden ASC, detalle_conocimiento.detalle_conocimiento_orden ASC';
        $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
        return $result;
    }

    public function selectLibroById(int $libro_id)
    {
        $sql = 'SELECT * FROM libro
        INNER JOIN categorias ON libro.categorias_id = categorias.categorias_id
        LEFT JOIN detalle_autor ON detalle_autor.libro_id = libro.libro_id
        LEFT JOIN autores ON detalle_autor.autores_id = autores.autores_id
        WHERE libro.libro_id = :libro_id';
        $result = $this->select_all($sql, array('libro_id' => $libro_id), DB_BIB);
        return $result;
    }

    // Funcion select

    public function selectEditorial(int $editoriales_id)
    {
        $sql = 'SELECT * FROM editoriales
        WHERE editoriales_id = :editoriales_id';
        $result = $this->select($sql, array('editoriales_id' => $editoriales_id), DB_BIB);
        return $result;
    }

    // Funcion insert
    // Funcion update
    // Funcion delete
}
