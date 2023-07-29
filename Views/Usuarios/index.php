<?php

include_once "Views/Templates/header.php";

?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
    <div class="col-lg-4 border border-primary">
        <button class="btn btn-primary btn-lg btn-blocks mb-2 p-2" onclick="frmUsuario();" type="button">REGISTRAR</button>

    </div>
</div>
<!-- <?php print_r($data);?> -->
<table class="table table-dark" id="tblUsuarios">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Telefono</th>
            <th>Acciones</th>


        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Agregar Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="form-group">
                        <label for="newUser">Usuario</label>
                        <input type="hidden" id="id" name="id">
                        <input id="newUser" class="form-control" type="text" name="newUser" placeholder="Ingrese Usuario">
                    </div>
                    <div class="form-group">
                        <label for="newNombre">Nombre</label>
                        <input id="newNombre" class="form-control" type="text" name="newNombre" placeholder="Ingrese Nombre">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="newPassword">Password</label>
                                <input id="newPassword" class="form-control" type="password" name="newPassword" placeholder="Ingrese Password">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="newConfirma">Confirma Contraseña</label>
                                <input id="newConfirma" class="form-control" type="password" name="newConfirma" placeholder="Confirma Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newCorreo">Correo</label>
                        <input id="newCorreo" class="form-control" type="email" name="newCorreo" placeholder="Ingrese Correo">
                    </div>
                    <div class="form-group">
                        <label for="newTelefono">Telefono</label>
                        <input id="newTelefono" class="form-control" type="text" name="newTelefono" placeholder="Ingrese Telefono">
                    </div>
                    <div class="form-group">
                        <label for="my-select">Roles</label>
                        <select id="roles" class="form-control" name="roles">
                            <?php  foreach($data['myroles'] as $row){
                                ?>
                                    <option value="<?php  echo $row['idRol']?>"><?php  echo $row['descripcion']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="button" id="btnAccion" onclick="return registarUser(event);">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once "Views/Templates/footer.php";

?>