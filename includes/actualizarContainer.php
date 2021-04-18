<div class="container-principal">
    <div class="panel-izquierdo">
        <div class="container-panel-izquierdo">
            <img class="logo-principal" src="./img/logoGym.png" alt="logo">
        </div>
    </div>
    <div class="panel-derecho-actualizar">
        <div class="container-actualizar">
            <div class="container-panel-derecho-actualizar ">
                <a class="div-imagen" href="adminpanel.php">
                <img class="imagen-actualizar" src="./fotosUsuarios/<?php echo $usuario['foto']?>" alt="">
                </a>

                <!-- Para evitar la redireccion por la validadicon de la url se elimina el action, al hacerlo los datos se envian al mismo archivo-->
                <form id="registro" method="POST" enctype="multipart/form-data">
                    <label class="planes-label" for="nombres">Nombres</label>
                    <input class="btn-input-registro" type="text" name="nombres" autofocus value="<?php echo $nombres ?>">
                    <label class="planes-label" for="Apellidos">Apellidos</label>
                    <input class="btn-input-registro" type="text" name="apellidos"  value="<?php echo $apellidos ?>">
                    <label class="planes-label" for="cedula">Cedula</label>
                    <input class="btn-input-registro" type="number" name="cedula" value="<?php echo $cedula ?>">
                    <label class="planes-label" for="email">Email</label>
                    <input class="btn-input-registro" type="email" name="email" value="<?php echo $email ?>">
                    <label class="planes-label" for="telefono">Telefono</label>
                    <input class="btn-input-registro" type="number" name="telefono"  value="<?php echo $telefono ?>">
                    <label class="planes-label" for="planes">Planes</label>
                    <select class="btn-input-registro" name="planes" id="planes" value="">
                        <option class="btn-input-registro" value="" name="">--seleccione--</option>
                        <?php while ($row = mysqli_fetch_assoc($planesResultado)) : ?>
                        <option <?php echo $planes === $row['tipodeplan'] ? 'selected' :' ';?> value="<?php echo $row['tipodeplan'];?>"><?php echo $row['tipodeplan'];?></option>
                        <?php endwhile;?>
                    </select>
                    <label class="planes-label" for="foto">Foto</label>
                    
                    <input id="foto" class="btn-input-registro" type="file" name="foto" accept="image/jpeg, image/png">
                    <input class="btn-input-registro" type="submit" name="actualizar" value="Actualizar Usuario">
                </form>
            </div>
        </div>
    </div>
</div>