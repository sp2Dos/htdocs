<?php

$fi = fopen("archivo", "a")
        or die("No se pudo guardar");
if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['area']) && !empty($_POST['area']))
{
    fwrite($fi, "Datos:");
    fwrite($fi, $_POST['nombre']);
    fwrite($fi, $_POST['area']);
    fwrite($fi, "-----------------------");

    fclose($fi);

    echo "Datos guardados con exito, verifique el archivo";
}
else
    echo "Campos vacios, no se ha guardado los datos";

?>

