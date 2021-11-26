<?php

include "IParte1.php";
include "IParte2.php";

class Receta implements IParte1,IParte2
{
    public $id;
    public $nombre;
    public $ingredientes;
    public $tipo;
    public $foto;


    public function __construct($nombre = "null",$ingredientes= "null",$tipo= "null",$foto= "null",$id= "null")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ingredientes = $ingredientes;
        $this->tipo = $tipo;
        $this->foto = $foto;
    }

    public function ToJSON()
    {     
        return json_encode($this);
    }

    public function Agregar()
    {

        $retorno = false;
        
        try
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "recetas_bd";

            $conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO recetas (NOMBRE, INGREDIENTES, TIPO, PATH_FOTO) VALUES ('".$this->nombre."', '".$this->ingredientes."', '".$this->tipo."', '".$this->foto."')";

            $conn->exec($sql);

            $retorno = true;
        }
        catch(PDOException $e)
        {
            echo "Fallo la conexion: " . $e->getMessage();
        }    

        return $retorno;
    }

    public function Traer()
    {
        $auxArray = NULL;

        try
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "recetas_bd";

            $conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->query("SELECT * FROM recetas");

            $auxArray = $sql->fetchAll();

            $array = array();

            foreach($auxArray as $lista)
            {
                $aux = new Receta($lista[1],$lista[2],$lista[3],$lista[4],$lista[0]);

                array_push($array,$aux);
            }

            $conn = NULL;

        }
        catch(PDOException $e)
        {
            echo "Fallo la conexion: " . $e->getMessage();
        }    

        return $array;
    }

    public function Existe($receta)
    {
        $retorno = false;

        for($i = 0;$i < count($receta);$i++)
        {
            if($receta[$i]->nombre == $this->nombre && $receta[$i]->tipo == $this->tipo)
            {
                $retorno = true;
            }
        }

        return $retorno;
    }
    public function Modificar()
    {   
        $retorno = false;

        try
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "recetas_bd";

            $conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $id = $this->id;    
            $nombre = $this->nombre;
            $ingredientes = $this->ingredientes;
            $tipo = $this->tipo;
            $foto = $this->foto;

            $objPDO = $conn->prepare("UPDATE recetas SET ID = :id ,NOMBRE = :nombre, INGREDIENTES = :ingredientes, TIPO = :tipo, PATH_FOTO = :foto WHERE id = :id");

            $objPDO->bindValue(':id', $id, PDO::PARAM_INT);
            $objPDO->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $objPDO->bindValue(':ingredientes', $ingredientes, PDO::PARAM_STR);
            $objPDO->bindValue(':tipo', $tipo, PDO::PARAM_STR);
            $objPDO->bindValue(':foto', $foto, PDO::PARAM_STR);
    
            $objPDO->execute();   

            $retorno = true;
        }
        catch(PDOException $e)
        {
            echo "Fallo la conexion: " . $e->getMessage();
        }    

        return $retorno;
    }
}

?>