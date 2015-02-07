<html>
    <head>
        <title>Formularios</title>
    </head>
    <body>
        <!--<form name ="formulario" action="procesar.php" method="post">
            Primer numero: &nbsp;&nbsp;&nbsp;<input type="text" name="c1"/></br></br>
            Segundo numero:  <input type="text" name ="c2"/></br></br>
            <label>Selecciona una opcion:</label>
            <select name="lista">
                <option value="suma">Sumar</option>
                <option value="resta">Restar</option>
                <option value="multi">Multiplicar</option>
                <option value="div">Dividir</option>
            </select></br>
            <input type="submit" value="enviar"/>
        </form>-->
        
        <form name="form" method="post" action="File.php">
            <label>Insertar datos en archivo de texto</label>
            <br><br>
            <input type="text" name="nombre"/><br><br>
            <textarea name="area"></textarea><br><br>
            <input type="submit" value="Guardar"/>
        </form>
    </body>
</html>

