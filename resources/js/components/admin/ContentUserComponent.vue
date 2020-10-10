<template>
    <div class="card-body">
        <search-form-component 
        :urlSearch="url"
        >
            <template #add>
                <div class="row">
                    <legend class="col-form-label col-md-1 pt-0">Rol:</legend>
                    <div class="col-md-11">
                        <!--Aqui van los roles pero en un ciclo-->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="role" id="role" refs="role" />
                            <label class="custom-control-label" for="role">Admin</label>
                        </div>
                    </div>
                </div>
            </template>
        </search-form-component>

        <div class="d-flex mb-3 justify-content-end">
            <a href="#" class="btn btn-success" @click.prevent="goUrl(addNewComponent[0])">
                <i class="fas fa-plus-square"></i> Agregar Nuevo
            </a>
            <a href="#" class="btn btn-danger ml-2" @click.prevent="goUrl(addNewComponent[1])">
                <i class="fas fa-trash-restore"></i> Papelera
            </a>
        </div>

        <table class="table table-border">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th colspan="2" class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users" :key="user.id" >
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning" 
                        v-on:click.prevent="editUser(user)" >
                            <span class="">Editar</span>
                        </button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger">
                            <span class="">Eliminar</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <paginator-component 
        @changePages="changePage"
        :datapagination="paginator"
        />
    </div>
</template>

<script>
    export default {
        props:["addNewComponent"],
        mounted() {
            this.getUsers();
        },
        data(){
            return{
                url : "users",
                users : [],
                paginator:{}
            }
        },
        methods:{
            goUrl(component){
                this.$emit("headingDescription", component);
                this.$parent.contentBody = component+"-user-component";
            },
            getUsers(page){
                console.log("cargando data de users");
                axios.get("/users?page="+page).then(response => {
                    this.users = response.data.data;

                    //datos de la paginacion
                    this.paginator = {
                        total        :response.data.total,
                        current_page :response.data.current_page,
                        per_page     :response.data.per_page,
                        last_page    :response.data.last_page,
                        from         :response.data.from,
                        to           :response.data.to,
                    }
                });
            },
            changePage(page){
                this.getUsers(page);
            }
        }
    }
</script>
