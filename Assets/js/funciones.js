function frmLogin(e) {
  e.preventDefault();

  
  //https://www.facebook.com/groups/821926191292219/user/100054375574328/
  const usuario = document.getElementById("idUsuario");
  const clave = document.getElementById("idPassword");

  if (usuario.value == "") {
    clave.classList.remove("is-invalid");
    usuario.classList.add("is-invalid");
    usuario.focus();
  } else if (clave.value == "") {
    usuario.classList.remove("is-invalid");
    clave.classList.add("is-invalid");
    clave.focus();
  } else {
    //peticion mediante ajax
    const url = base_url + "Usuarios/validar";
    const frm = document.getElementById("frmLogin");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res == "ok") {
          window.location = base_url + "Usuarios";
        }else{
            document.getElementById("idAlert").classList.remove("d-none");
            document.getElementById("idAlert").innerHTML=res;
        }
      }
    };
  }
}

let tblUsuarios;
document.addEventListener("DOMContentLoaded",function () {
    tblUsuarios=$('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url+"Usuarios/listar",
            dataSrc: ''
        },
        columns: [ 
           {
            'data':'idusuarios',
           },
           {
            'data':'usuario',
           },
           {
            'data':'nombre',
           },
           {
            'data':'email',
           },
           {
            'data':'estado',
           },
           {
             'data':'telefono',
           },
           {
            'data':'acciones'
           }

         ]
    } );
  })

function frmUsuario(){
  document.getElementById("title").innerHTML="Registar Usuario";
  document.getElementById("btnAccion").innerHTML="Registrar";
  //caso contrseña
  //document.getElementId("codigo").classList.remove("d-none");
  document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value="";
}  

function registarUser(e) {
    e.preventDefault();
  
    
    //https://www.facebook.com/groups/821926191292219/user/100054375574328/
    const newUsuario = document.getElementById("newUser");
    const newNombre = document.getElementById("newNombre");
    const newPassword = document.getElementById("newPassword");
    const  newConfirmar= document.getElementById("newConfirma");
    const newCorreo = document.getElementById("newCorreo");
    const newTelefono = document.getElementById("newTelefono");
    const newRol = document.getElementById("roles");
  
    if (newUsuario.value == "" || newNombre.value=="" || newPassword.value=="" || newCorreo.value=="" || newConfirmar.value=="" || newTelefono.value=="" || newRol.value=="") {
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Los campos son Obligatorios',
            showConfirmButton: false,
            timer: 4000
          })
    } else if (newPassword.value != newConfirmar.value) {
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Las Password No Coinciden',
            showConfirmButton: false,
            timer: 4000
          })
    } else {
        //mintuso 7.19 del cpaitulo 07
      //peticion mediante ajax
      const url = base_url + "Usuarios/registrar";
      const frm = document.getElementById("frmUsuario");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         // console.log(this.responseText);
          //console.log(JSON.parse(this.responseText));
         const resp=JSON.parse(this.responseText);
         //console.log(resp);
           if (resp=="si") {
            Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'Usuario Registrado Correctamente',
              showConfirmButton: false,
              timer: 4000
            })
            //recetarer el formulario
            frm.reset();
            $("#nuevo_usuario").modal("hide");
            tblUsuarios.ajax.reload();
          }else if(resp=="modificado"){
            Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'Usuario Modificado Correctamente',
              showConfirmButton: false,
              timer: 4000
            })
            $("#nuevo_usuario").modal("hide");
            tblUsuarios.ajax.reload();
          }else{
            Swal.fire({
              position: 'top-center',
              icon: 'error',
              title: resp,
              showConfirmButton: false,
              timer: 4000
            })
            
          }

        }
      }
    }
  }
  function btnEditarUser(id) {  
    document.getElementById("title").innerHTML="Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML="Actualizar";

            //mintuso 7.19 del cpaitulo 07
      //peticion mediante ajax
      const url = base_url + "Usuarios/editar/"+id;
     
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            //console.log(this.responseText);

            const resp=JSON.parse(this.responseText);

            document.getElementById("id").value=resp.idusuarios;
             document.getElementById("newUser").value=resp.usuario;
             document.getElementById("newNombre").value=resp.nombre;
             document.getElementById("newPassword").value=resp.password;
             document.getElementById("newConfirma").value=resp.password;
             document.getElementById("newCorreo").value=resp.email;
             document.getElementById("newTelefono").value=resp.telefono;
             document.getElementById("roles").value=resp.idRol;
             $("#nuevo_usuario").modal("show");

        }
      }
    
  }

//https://www.youtube.com/watch?v=mtNbqWKu85k
 
            
            
            
            
            