<?php

abstract class Persona
{
    private string $_apellido;
    private int $_dni;
    private string $_nombre;
    private $_sexo;

    public function __construct(string $nombre,string $apellido,int $dni,$sexo)
    {
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_dni = $dni;
        $this->_sexo = $sexo;
    }

    public function GetApellido()
    {
        return $this->_apellido;
    }
    public function GetDni()
    {
        return $this->_dni;
    }
    public function GetNombre()
    {
        return $this->_nombre;
    }
    public function GetSexo()
    {
        return $this->_sexo;
    }

    public abstract function Hablar($tipos);

    public function ToString()
    {
        $texto = "Nombre: ".$this->GetNombre() . " - Apellido: ". $this->GetApellido() . " - Dni: " . $this->GetDni() . " - Sexo: " . $this->GetSexo();

        return $texto;
    }
}

?>

