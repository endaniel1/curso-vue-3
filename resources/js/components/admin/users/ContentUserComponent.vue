<template>
    <div class="card-body">
        <form method="get" accept-charset="utf-8"
        @submit.prevent="SearchUser" >

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="search" class="sr-only">Buscar</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." v-model="search"/>
                </div>
                <div class="form-group col-md-3">
                    <label for="from" class="sr-only">Fecha desde</label>
                    <input type="date" id="from" name="from" class="form-control" placeholder="Fecha desde" v-model="from" />
                </div>
                <div class="form-group col-md-3">
                    <label for="to" class="sr-only">Fecha hasta</label>
                    <input type="date" id="to" name="to" class="form-control" placeholder="Fecha hasta" v-model="to" />
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i>Buscar</button>
                </div>
            </div>                
            <div class="row">
                <legend class="col-form-label col-md-1 pt-0">Rol:</legend>
                <div class="col-md-11">
                    <!---->
                    <div v-for="(role,index) in getRoles" :key="role.name" 
                    class="custom-control custom-radio custom-control-inline">
                        <input class="custom-control-input" type="radio" name="roleSearch"
                        :id="role.name" 
                        v-model="roleSearch" 
                        :value="role.name" />
                        <label class="custom-control-label" :for="role.name">{{role.name.toUpperCase()}}</label>
                    </div>
                </div>
            </div>
        </form>
        <!--Esto aqui est tentativo ya q se puedo mejorar si en vez de agregar o papelera fuera otra cosa q no sea eso-->
        <div class="d-flex mb-3 justify-content-end">
            <a href="#" class="btn btn-success" @click.prevent="goUrl(addNewComponent[0],'create')">
                <i class="fas fa-plus-square"></i> Agregar Nuevo
            </a>
            <a href="#" class="btn btn-danger ml-2" @click.prevent="goUrl(addNewComponent[1])">
                <i class="fas fa-trash-restore"></i> Papelera
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-border ">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th class="text-center">Fecha</th>
                        <th colspan="2" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user,index) in users" :key="user.id" >
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <span 
                            v-text="viewRoles(user.roles)" 
                            :class="{'bg-primary':viewRoles(user.roles) != '---'}"></span>
                        </td>
                        <td>{{user.created_at | formatDate}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning" 
                            v-on:click.prevent="editUser(user.id)" >
                                <span class="">Editar</span>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger"
                            v-on:click.prevent="deleteUser(user)">
                                <span class="">Eliminar</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <paginator-component 
        @changePages="changePage"
        :datapagination="paginator"
        />

    </div>
</template>

<script>
    export default {
        name:"content-user-component",
        props:["addNewComponent"],
        mounted() {
            this.getUsers();
        },
        data(){
            return{
                url : "users",
                users : {},
                paginator:{},
                search:'',
                from:'',
                to:'',
                roleSearch:'',
                getRoles:[]
            }
        },
        methods:{
            goUrl(component, data){
                this.$emit("headingDescription", component);
                this.$parent.contentBody = component+"-user-component";             
                this.$parent.data = data;
            },
            getUsers(page){
                //console.log("cargando data de users");
                axios.get("/users?page="+page+"&search="+this.search+"&from="+this.from+"&to="+this.to+"&role="+this.roleSearch).then(response => {
                    console.log(response.data);
                    this.users = response.data.users.data;
                    if(this.getRoles == ''){
                        this.getRoles = response.data.roles
                    }
                    //datos de la paginacion
                    this.paginator = {
                        total        :response.data.users.total,
                        current_page :response.data.users.current_page,
                        per_page     :response.data.users.per_page,
                        last_page    :response.data.users.last_page,
                        from         :response.data.users.from,
                        to           :response.data.users.to,
                    }
                });
            },
            editUser(user){
                console.log("edito user");
                console.log(user);
                this.goUrl("edit", user);
            },
            deleteUser(user){
                //console.log("elimino user");
                axios.delete(`/users/${user.id}`).then(respose => {
                    this.getUsers();
                });
            },
            changePage(page){
                this.getUsers(page);
            },
            SearchUser(event){
                //console.log("Hola vamoa a buscar");
                this.getUsers();
            },
            viewRoles(role){
                //para buscar los roles de los usuario
                if (role[0]) {
                    return role[0].name;
                }else{
                    return "---";
                }
            }
        }
    }
</script>
