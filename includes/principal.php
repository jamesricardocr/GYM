<div class="container-principal">
    <div class="panel-izquierdo">
        <div class="container-panel-izquierdo">
            <img class="logo-principal" src="./img/logoGym.png" alt="">
        </div>
    </div>
    <div class="panel-derecho">
        <div class="container-panel-derecho">
            <div class="container-panel-derecho-sub">
                <div>
             <i class="iconos fas fa-search"></i>
                </div>
                <form action="./identificar.php" method="POST">
                    <label class="label-form" for="cedula">Cedula del usuario</label>
                    <input class="btn-input" type="number" name="cedula" autofocus required>
                    <input class="btn-input  buscar" type="submit" name="indentificar" value="Buscar">
                </form>
                <a class="link" href="./adminlogin.php">Administrar</a>
            </div>
        </div>
    </div>
</div>