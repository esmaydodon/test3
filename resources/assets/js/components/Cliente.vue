<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
     <li class="breadcrumb-item"><a href="/"> Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Clientes
                <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                              <option value="nombre">Nombre</option>
                              <option value="num_documento">Número de Documento</option>
                              <option value="email">Email</option>
                              <option value="telefono">Número de telefono</option>


                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Tipo Documento</th>
                            <th>Número documento</th>
                            <th>direccion</th>
                            <th>telefono</th>
                            <th>email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="persona in arrayPersona" :key="persona.id">
                            <td>
                                <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <!-- <template v-if="categoria.condicion==1">
                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(categoria.id)">
                                  <i class="icon-trash"></i>
                                </button>
                                </template> -->
                                  <!-- <template v-else>
                                    <button type="button" class="btn btn-info btn-sm" @click="activarCategoria(categoria.id)">
                                  <i class="icon-ok"></i>
                                </button>
                                </template> -->
                            </td>
                            <td v-text="persona.nombre"></td>
                            <td v-text="persona.tipo_documento"></td>
                            <td v-text="persona.num_documento"></td>
                            <td v-text="persona.direccion"></td>
                            <td v-text="persona.telefono"></td>
                            <td v-text="persona.email"></td>
                            <!-- <td>
                                <div v-if="categoria.condicion==1">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                                
                            </td> -->
                        </tr>
  
                    </tbody>
                </table>
             <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
            </div>
            Marlon
        </div>
       
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar cuando modal sea 1 se asiganara esa clase se mostrará --> 
    <div class="modal fade"  tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de Persona">
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Tipo de Documento</label>
                            <div class="col-md-9">
                                <!-- <input type="email" v-model="descripcion" class="form-control" placeholder="ingrece Dscripción"> -->
                                <select v-model="tipo_documento" class="form-control">
                                    <option value="DNI">DNI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="PASAPORTE">PASAPORTE</option>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Número de Documento</label>
                            <div class="col-md-9">
                                <input type="text" v-model="num_documento" class="form-control" placeholder="Número de Documento">
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                            <div class="col-md-9">
                                <input type="text" v-model="direccion" class="form-control" placeholder="Dirección">  
                            </div>
                        </div>
                          <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                            <div class="col-md-9">
                                <input type="text" v-model="telefono" class="form-control" placeholder="Teléfono">  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Email</label>
                            <div class="col-md-9">
                                <input type="email" v-model="email" class="form-control" placeholder="Email">  
                            </div>
                        </div>
                        <div v-show="errorPersona" class="form-group row div-error">
                            <div class="text-center text-error">
                                <!-- para iterar, dentro del objeto error-->
                                <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1"  class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2"  class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->

    <!-- Fin del modal Eliminar -->
    
</main>
</template>

<script>
    export default {
        data() { 
            return {
                categoria_id:0,
                nombre:'',
                tipo_documento:'DNI',
                num_documento:'',
                direccion:'',
                telefono:'',
                email:'',

                arrayPersona:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorPersona:0,
                errorMostrarMsjPersona:[],
                pagination:{
                        'total':0,
                        'current_page':0,
                        'per_page':0,
                        'last_page':0,
                        'from':0,
                        'to':0,
                },
                offset:3,
                criterio : 'nombre',
                buscar : ''
            }
        },
        computed:{
              isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods: {        
            listarPersona(page,buscar,criterio){
                  let me=this;
                var url= 'cliente?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
             },
             cambiarPagina(page,buscar,criterio){
                 //agregamos una m para ser referencia de esta clase js
                 let me = this;
                 me.pagination.current_page=page;   
                 me.listarPersona(page,buscar,criterio); 

             },
             registrarPersona(){
                 if (this.validarPersona()) {
                     return;
                 }else{
                         let me=this;
                 axios.post('cliente/registrar',{
                     'nombre':this.nombre,
                     'tipo_documento':this.tipo_documento,
                     'num_documento':this.num_documento,
                     'direccion':this.direccion,
                     'telefono':this.telefono,
                     'email':this.email
                 }).then(function (response) {
                     me.cerrarModal();
                     me.listarPersona(1,'','nombre');
                     //si ocurre todo bien 
                //console.log(response);
                //me.arrayCategoria=response.data;
                })
                .catch(function (error) {
                console.log(error);
                });
                 }
             
             },
             actualizarPersona(){
                    if (this.validarPersona()) {
                     return;
                 }else{
                         let me=this;
                 axios.put('cliente/actualizar',{
                     'id':this.persona_id,
                      'nombre':this.nombre,
                     'tipo_documento':this.tipo_documento,
                     'num_documento':this.num_documento,
                     'direccion':this.direccion,
                     'telefono':this.telefono,
                     'email':this.email
                 }).then(function (response) {
                     me.cerrarModal();
                     me.listarPersona(1,'','nombre');
                     //si ocurre todo bien 
                //console.log(response);
                //me.arrayCategoria=response.data;
                })
                .catch(function (error) {
                console.log(error);
                });
                 }
             },
            //  activarCategoria(id){
            //       const swalWithBootstrapButtons = Swal.mixin({
            //     customClass: {
            //         confirmButton: 'btn btn-success',
            //         cancelButton: 'btn btn-danger'
            //     },
            //     buttonsStyling: false
            //     })

            //     swalWithBootstrapButtons.fire({
            //     title: 'Esta seguro de ACTIVAR esta categoria?',
            //     text: "Consulta!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonText: 'Aceptar',
            //     cancelButtonText: 'Cancelar',
            //     reverseButtons: true
            //     }).then((result) => {
            //     if (result.isConfirmed) {
            //         //console.log(id);
            //            let me=this;
            //      axios.put('categoria/activar',{
            //          'id':id    
            //      }).then(function (response) {
                     
            //          me.listarCategoria(1,'','nombre');
            //          swalWithBootstrapButtons.fire(
            //         'Activado!',
            //         'El Registro a sido ACTIVADO con éxito.',
            //         'success'
            //         )

            //          //si ocurre todo bien 
                
            //     //me.arrayCategoria=response.data;
            //     })
            //     .catch(function (error) {
            //     console.log(error);
            //     });

                    
            //     } else if (
            //         /* Read more about handling dismissals below */
            //         result.dismiss === Swal.DismissReason.cancel
            //     ) {
            //         swalWithBootstrapButtons.fire(
            //         'Cancelled',
            //         'Your imaginary file is safe :)',
            //         'error'
            //         )
            //     }
            //     })
            // },
            // desactivarCategoria(id){
            //     const swalWithBootstrapButtons = Swal.mixin({
            //     customClass: {
            //         confirmButton: 'btn btn-success',
            //         cancelButton: 'btn btn-danger'
            //     },
            //     buttonsStyling: false
            //     })

            //     swalWithBootstrapButtons.fire({
            //     title: 'Esta seguro de desactivar esta categoria?',
            //     text: "texto!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonText: 'Aceptar',
            //     cancelButtonText: 'Cancelar',
            //     reverseButtons: true
            //     }).then((result) => {
            //     if (result.isConfirmed) {
            //         console.log(id);
            //            let me=this;
            //      axios.put('categoria/desactivar',{
            //          'id':id    
            //      }).then(function (response) {
                     
            //          me.listarCategoria(1,'','nombre');
            //          swalWithBootstrapButtons.fire(
            //         'Desactivado!',
            //         'El Registro a sido Desactivado con éxito.',
            //         'success'
            //         )

            //          //si ocurre todo bien 
                
            //     //me.arrayCategoria=response.data;
            //     })
            //     .catch(function (error) {
            //     console.log(error);
            //     });

                    
            //     } else if (
            //         /* Read more about handling dismissals below */
            //         result.dismiss === Swal.DismissReason.cancel
            //     ) {
            //         swalWithBootstrapButtons.fire(
            //         'Cancelled',
            //         'Your imaginary file is safe :)',
            //         'error'
            //         )
            //     }
            //     })
            // },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona=[]; 

                if(!this.nombre) this.errorMostrarMsjPersona.push("Este nombre de la persona no puede estar vacio!");
                if(this.errorMostrarMsjPersona.length) this.errorPersona=1;
                return this.errorPersona;
            },
             cerrarModal(){
                 this.modal=0;
                 this.tituloModal='';
                 this.nombre='';
                 this.tipo_documento='DNI';
                 this.num_documento='';
                 this.direccion='';
                 this.telefono='';
                 this.email='';
                 this.errorPersona=0;

             },
             abrirModal(modelo,accion,data=[]){
                 switch(modelo){
                     case "persona":
                     {
                      switch (accion) {
                          case'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Cliente';
                                this.nombre='';
                                this.tipo_documento='DNI';
                                this.num_documento='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.tipoAccion=1;
                                break;
                            }
                        case 'actualizar':
                            { 
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Cliente';
                                this.tipoAccion=2;
                                this.persona_id=data['id']
                                this.nombre=data['nombre'];
                                this.tipo_documento=data['tipo_documento'];
                                this.num_documento=data['num_documento'];
                                this.direccion=data['direccion'];
                                this.telefono=data['telefono'];
                                this.email=data['email'];
                                
                                break;
                            }
                        
                        }   
                     }
                 }
             }
            },
            mounted() {
                this.listarPersona(1,this.buscar,this.criterio);
            }
        }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1  !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: brown !important;
        font-weight: bold;
    }
</style>