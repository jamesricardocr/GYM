<div class="container-principal">
    
    <div class="panel-izquierdo">
        <div class="container-panel-izquierdo">
            <img class="logo-principal" src="./img/logoGym.png" alt="logo">
        </div>
    </div>
    <div class="panel-derecho-actualizar">
        <div class="container-actualizar">
            <div class="container-panel-derecho-identificar ">
                <img class="imagen-identificar" src="./fotosUsuarios/<?php echo $usuario['foto']?>" alt="">
                    <p class="nombre-identificar"><?php echo $usuario['nombres']?></p>
                    <p class="cedula-identificar">C.C <?php echo $usuario['cedula']?></p>
                    <div class="">
                        <!-- <p class="titulo-identificar">Suscripción</p> -->
                        <p class="plan-identificar"><?php echo $usuario['plan']?></p>
                    </div>
            </div>
        </div>
        <a class="cerrar-sesion" href="./"><i class=" iconos-admin-login fas fa-sign-out-alt"></i> Volver</a>

    </div>
</div>