<?php
$n1 = $_POST['c1'];
$n2 = $_POST['c2'];
$op = $_POST['lista'];

if(isset($n1) && !empty($n1) && isset($n2) && !empty($n2))
{
        switch ($op)
    {
        case suma:
            echo "El resultado es: ". ($n1 + $n2) ;
            break;

        case resta:
            echo "El resultado es: ". ($n1 - $n2) ;
            break;

         case multi:
            echo "El resultado es: ". ($n1 * $n2) ;
            break;

        case div:
            echo "El resultado es: ". @($n1 / $n2) ;
            break;
    }
}
else
{
    echo "Campos vacios!!";
}


?>
