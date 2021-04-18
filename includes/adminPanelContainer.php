<div class="container-principal-admin">
    <div class="header-panel-admin">
        <a class="cerrar-sesion" href="./includes/cerrarSesion.php"><i class=" iconos-admin-login fas fa-sign-out-alt"></i> Cerrar sesión</a>
        <img class="logo-panel-admin" src="./img/logoGym.png" alt="logo">
    </div>
    <div class="header-derecho-panel-admin">
        <a href="./registro.php"><i class="iconos-admin-login fas fa-user-plus"></i> Añadir usuario</a>
    </div>
    <div class="usuarios">
        <!-- tabla donde se muestran los usuarios registrados en la base de datos -->
        <table class="usuarios-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>foto</th>
                    <th>nombres</th>
                    <th>apellidos</th>
                    <th>cedula</th>
                    <th>email</th>
                    <th>telefono</th>
                    <th>planes</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- iterar sobre lo tabla de usuarios y muestra los valores en el html -->
                <?php while ($usuarios = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                    <tr>
                        <td><?php echo $usuarios['id'] ?></td>
                        <td><a target="_black" href="./fotosUsuarios/<?php echo $usuarios['foto'] ?>"><img src="./fotosUsuarios/<?php echo $usuarios['foto'] ?>" alt=""></a></td>
                        <td><?php echo $usuarios['nombres'] ?></td>
                        <td><?php echo $usuarios['apellidos'] ?></td>
                        <td><?php echo $usuarios['cedula'] ?></td>
                        <td><?php echo $usuarios['email'] ?></td>
                        <td><?php echo $usuarios['telefono'] ?></td>
                        <td><?php echo $usuarios['plan'] ?></td>
                        <td class="acciones">
                            <a class="actualizar" href="./actualizar.php?id=<?php echo $usuarios['id'] ?>">Actualizar</a>
                            <form method="POST" action="./adminpanel.php">
                                <input type="hidden" name="id" value="<?php echo $usuarios['id']; ?>">
                                <input class="borrar" type="submit" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>