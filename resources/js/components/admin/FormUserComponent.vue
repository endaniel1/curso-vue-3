<template>
    <form id="form-user" name="form-user" method="POST" 
    :action="actionForm" enctype="multipart/form-data" class="form-class needs-validation" novalidate @submit.prevent="submitForm">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" 
                v-model="user.name"
                class="form-control" value="" placeholder="Nombre" 
                required />
                <div class="invalid-feedback">
                    <!--Aqui van los erroes y faltan agregarle las clases a los input para los erroes-->
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" 
                v-model="user.email"
                class="form-control" value="" placeholder="Email" 
                required />
                <div class="invalid-feedback">
                      <!--Aqui van los erroes y faltan agregarle las clases a los input para los erroes-->
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" 
                class="form-control" placeholder="Contraseña" 
                required />
                <span class="invalid-feedback">
                     <!--Aqui van los erroes y faltan agregarle las clases a los input para los erroes-->
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required />
            </div>
        </div>
        <fieldset class="form-group">
            <legend>Rol</legend>

            <div  class="custom-control custom-radio custom-control-inline"
            v-for="(role,index) in roles" :key="role.id">
            <input type="radio" name="role" id="role.name" 
            class="custom-control-input" v-model="dataRole" />
            <label class="custom-control-label" for="role.name">{{role.name}}</label>
            </div>

            <div class="invalid-feedback">
                  <!--Aqui van los erroes y faltan agregarle las clases a los input para los erroes-->
            </div>
        </fieldset>
        <div class="form-group text-center mb-0">
            <button type="submit" class="btn btn-primary">Agregar <i class="fa fa-save"></i></button>
        </div>
    </form>
</template>

<script>
    export default {
        props:["dataUser","getDataUser","actionForm"],
        created() {
            console.log('Component mounted. FormUserComponent.vue')
            this.getData();
        },
        data(){
           return{
            roles:[],
            user:[],
            dataRole:[]
           }
        },
        methods:{
            getData(){
                console.log("buscamos los datos para el formulario");
                //console.log(this.dataUser);
                //console.log(this.getDataUser);
                //console.log(this.actionForm);
                axios.get(this.getDataUser).then(response => {
                    console.log(response.data);
                    this.roles = response.data.roles
                    this.user = response.data.user
                });
            },
            submitForm(){
                console.log("Enviando datos");
            }
        }
    }
</script>
