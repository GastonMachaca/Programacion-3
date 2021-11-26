<u>
<h2>TRABAJO PRACTICO N°1</h2>
</u>  
<body>

    <p><u>
    <i>Lista de empleados</i>:
    </p></u>  
    <?php

        //include "empleado.php";

        include "fabrica.php";

        $empleado1 = new Empleado("Gaston","Machaca",112421561,"M",7453634,123124,"Tarde");

        $empleado2 = new Empleado("Alberto","Fernandez",45315648,"M",34634572,20000000,"Mañana");

        echo $empleado1->ToString();

        echo $empleado2->ToString();

    ?>

    <p><u>
    <i>Idiomas que manejan los empleados</i>:
    </p></u>  
    <?php

        echo $empleado1->Hablar(array("Español","Frances"));

        echo $empleado2->Hablar(array("Español","Ingles","Frances"));

    ?>

    <p><u>
    <i>Agrego empleados a la fabrica y los muestro</i>:
    </p></u>  
    <?php

        $empleado3 = new Empleado("Luciano","Pereira",7894526,"M",88887887,9897897,"Mañana");

        $empleado4 = new Empleado("Manolo","Castillo",4598742,"M",15651234,4587426,"Noche");

        $empleado5 = new Empleado("Martin","Gelvan",7891534,"M",7894512,5687924,"Tarde");

        $fabrica = new Fabrica("Movistar");

        $fabrica->AgregarEmpleado($empleado1);
        $fabrica->AgregarEmpleado($empleado2);
        $fabrica->AgregarEmpleado($empleado3);
        $fabrica->AgregarEmpleado($empleado4);
        $fabrica->AgregarEmpleado($empleado5);


        echo $fabrica->ToString();
        echo "El total que la fabrica abonara en sueldos es : $" . $fabrica->CalcularSueldos();

    ?>

    <p><u>  
    <i>Elimino empleado de la fabrica y muestro los empleados de la fabrica</i>:
    </p></u>  

    <?php

        $fabrica->EliminarEmpleado($empleado5);

        echo $fabrica->ToString();

    ?>

    <p><u>  
    <i>Despues de eliminar un empleado, ingreso un empleado repetido a la fabrica y guardo en txt </i>:
    </p></u>  

    <?php

        $empleado7 = new Empleado("Manolo","Castillo",4598742,"M",15651234,4587426,"Noche");
        
        $fabrica->AgregarEmpleado($empleado7);

        echo $fabrica->ToString();

        $fabrica->GuardarEnArchivo("empleados.txt");

    ?>

</body>