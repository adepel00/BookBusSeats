<!DOCTYPE html> 
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link rel = 'stylesheet' type='text/css' href='styles.css'/>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
      <script type = 'text/javascript' src='logic.js'></script>
    </head>

    <body>
      <h1>Bienvenido a su reserva de billetes</h1>
      
      <center>
        <div id="select_box">
          <h2>¿A dónde le gustaría ir?</h2>
          <select id = "select" onchange = "showForms(this.value)">
            <option>---</option>
          </select>
        </div>
        <div id="chose_asientos">
          <h2>Seleccione asientos</h2>
          <div id = container_asientos>
          </div>
        </div>
        <form class = "form_datos_personales">
          <h2>Introduzca sus datos personales</h2>
          <label>Nombre*</label>
          <input type="text" name="nombre"><br>
          <label>NIF*</label>
          <input type="text" name="nif"><br>
          <label>Email*</label>
          <input type="text" name="email">
          <p><input type="button" class = "buttonReserva" value="Reservar plazas" onclick="reservar()" /></p>
      </form>
      </center>
    </body>
</html>