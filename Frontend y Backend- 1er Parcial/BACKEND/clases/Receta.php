<?php

include "IParte1.php";
include "IParte2.php";
include "IParte3.php";

class Receta implements IParte1,IParte2,IParte3
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

            //$objPDO->execute();   

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

    public function Eliminar()
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
            echo "Conexion Exitosa" . "<br />";
        
            $nombre = $this->nombre;
            $tipo = $this->tipo;                  

            $objPDO = $conn->prepare("DELETE FROM recetas WHERE NOMBRE = :nombre AND TIPO = :tipo");

            $objPDO->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $objPDO->bindValue(':tipo', $tipo, PDO::PARAM_STR);
    
            $objPDO->execute();

            $retorno = true;
        }
        catch(PDOException $e)
        {
            echo "Fallo la conexion: " . $e->getMessage();
        }    

        return $retorno;
    }

    public function GuardarEnArchivo()
    {
        $path = "./archivos/recetas_borradas.txt";

        if(file_exists($path))
        {
            $aux = fopen($path,"a");
            $validacion = 0;
            $horario = date('h');
            $horario .= date('i');
            $horario .= date('s');
            $horario = str_replace(":","",$horario);

            //$extension = $this->foto;

            $destinoFoto = "./recetasBorradas/". $this->id . "." . $this->nombre . ".borrado." . $horario . ".png";

            if($this->foto != "null" && $this->foto != null)
            {
                if(strpos($this->foto, "modificado") !== false)
                {
                    rename("./recetasModificadas/". $this->foto,$destinoFoto);
                    //$mensaje .= "<img src='". "./recetasModificadas/" . $array[$i]->foto ."'width='90' height='90'</td></tr>";
                    $validacion = 1;
                } 
                else
                {
                    rename("./recetas/imagenes/" . $this->foto,$destinoFoto);
                    //$mensaje .= "<img src='". "./recetas/imagenes/" . $array[$i]->foto ."'width='90' height='90'</td></tr>";
                    $validacion = 1;
                }
            }

            //move_uploaded_file($this->foto,$destinoFoto);

            $nombreFoto = $this->id . "." . $this->nombre . ".borrado." . $horario . "." . "png";

            $nuevaFoto = $nombreFoto;

            $this->foto = $nuevaFoto;

            $mensaje = $this->id . " ,";
            $mensaje .= $this->nombre . " ,";
            $mensaje .= $this->ingredientes . " ,";
            $mensaje .= $this->tipo . " ,";
            $mensaje .= "./recetasBorradas/". $this->foto;
            $mensaje .= "-";

            file_put_contents($path, $mensaje);

            fclose($aux);
        }
        else
        {
            fopen($path,"w");
        }
    }
}

?>