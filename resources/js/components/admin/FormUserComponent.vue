<template>
    <form id="form-user" name="form-user" method="POST" 
    :action="actionForm" enctype="multipart/form-data" class="form-class needs-validation" novalidate @submit.prevent="submitForm">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" 
                v-model="user.name"
                :class="{'is-invalid' : formErrors != '' && formErrors.name}" class="form-control" value="" placeholder="Nombre" 
                required />
                <div class="invalid-feedback">
                    {{formErrors.name ? formErrors.name[0] : 'Nombre es Requerido!'}}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" 
                v-model="user.email"                
                :class="{'is-invalid' : formErrors != '' && formErrors.email}" class="form-control" value="" placeholder="Email" 
                required />
                <div class="invalid-feedback">
                       {{formErrors.email ? formErrors.email[0] : 'Email es Requerido!'}}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" 
                v-model="user.password"
                :class="{'is-invalid' : formErrors != '' && formErrors.password}" class="form-control" placeholder="Contraseña" 
                required />
                <span class="invalid-feedback">
                    {{formErrors.password ? formErrors.password[0] : 'Password es Requerido!'}}
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation"                 
                v-model="user.password_confirmation"
                id="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required />
            </div>
        </div>
        <fieldset class="form-group">
            <legend>Rol</legend>

            <div class="custom-control custom-radio custom-control-inline"
            v-for="(role,index) in roles" :key="role.id">
                <input type="radio" name="role" class="custom-control-input"
                :id="role.name" 
                v-model="dataRole" 
                :value="role.name" 
                :class="{'is-invalid' : formErrors != '' && formErrors.roles}"
                />
                <label class="custom-control-label" :for="role.name">{{role.name.toUpperCase()}}</label>
            </div>

            <div class="invalid-feedback">
                 {{formErrors.roles ? formErrors.roles[0] : 'Rol es Requerido!'}}
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
            //console.log('Component mounted. FormUserComponent.vue')
            this.getData();
        },
        data(){
           return{
            roles : [],
            user : {},
            dataRole : [],
            formErrors : []
           }
        },
        methods:{
            getData(){
                //console.log("buscamos los datos para el formulario");
                console.log(this.dataUser);
                console.log(this.getDataUser);
                console.log(this.actionForm);
                axios.get(this.getDataUser).then(response => {
                    //console.log(response.data);
                    this.roles = response.data.roles
                    this.user = response.data.user
                });
            },
            submitForm(){
                if (this.actionForm == "store") {
                    console.log(this.dataRole);

                    axios.post("users",this.processUser()).then(response => {
                        this.resetData();
                        this.$emit("successData","Usuario Creado Con Existo");
                    }).catch(errors => {
                        console.clear();
                        this.getError(errors.response.data.errors);
                    });

                }else if(this.actionForm == this.dataUser+"/update"){
                    console.log("enviar para actualizar");

                    axios.put("users/"+this.dataUser, this.processUser()).then(response => {
                        this.resetData();
                        this.$emit("successData","Usuario Actualizado Con Existo");
                    }).catch(errors => {
                        console.clear();
                        this.getError(errors.response.data.errors);
                    });

                }else{
                    console.log("Error no se puedo enviar el formulario");
                }
                //console.log("Enviando datos");
            },
            getError(errors){
                this.formErrors = errors;
                this.$emit("errors",errors);
            },
            processUser(){
                return {
                    name : this.user.name,
                    email : this.user.email,
                    password : this.user.password,
                    password_confirmation : this.user.password_confirmation,
                    role : this.dataRole
                }
            },
            resetData(){
                roles : [];
                user : {};
                dataRole : [];
            }
        }
    }
</script>
