<?php

include "persona.php";

class Empleado extends Persona
{
    protected int $_legajo;
    protected $_sueldo;
    protected string $_turno;
    protected string $_pathFoto;

    public function __construct(string $nombre,string $apellido,int $dni,$sexo,int $legajo,$sueldo,string $turno)
    {
        parent ::__construct($nombre,$apellido,$dni,$sexo);
        $this->_legajo = $legajo;
        $this->_sueldo = $sueldo;
        $this->_turno = $turno;
    }

    public function GetLegajo()
    {
        return $this->_legajo;
    }

    public function GetPathFoto()
    {
        return $this->_pathFoto;
    }

    public function GetSueldo()
    {
        return $this->_sueldo;
    }

    public function GetTurno()
    {
        return $this->_turno;
    }

    public function Hablar($idioma) : string
    {
        $aux = parent::GetNombre() . " " . parent::GetApellido() . " maneja el idioma ";

        for($i = 0;$i<count($idioma);$i++)
        {
            if($i == count($idioma) - 1 )
            {
                $auxComa = ".";
            }
            else
            {
                $auxComa = ", ";
            }

            $aux .= $idioma[$i] . $auxComa;
        }
        
        return $aux . "</br></br>";
    }

    public function SetPathFoto(string $foto)
    {
        $this->_pathFoto = $foto;
    }

    public function ToString()
    {
        return parent:: ToString() . " - Legajo: " . $this->GetLegajo() . " - Sueldo: " . $this->GetSueldo() . " - Turno: " . $this->GetTurno() . " - Foto: " . $this->GetPathFoto();
    }

}

?>