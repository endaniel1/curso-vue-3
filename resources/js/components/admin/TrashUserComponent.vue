<template>
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
                    <td>{{user.deleted_at | formatDate}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success" 
                        v-on:click.prevent="restoreUser(user)" >
                            <span class="">restaurar</span>
                        </button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger"
                        v-on:click.prevent="destroyUser(user)">
                            <span class="">Destroir</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {      
        mounted() {
           console.log("hola desde TrashUserComponent");
           this.getUserTrash();
        },
        data(){
            return {
                users : [],
            }
        },
        methods:{
            getUserTrash(){
                console.log("buscar users");
                axios.get("/users/trash").then(response => {
                    this.users = response.data;
                    //console.log(this.users);
                });
            },
            restoreUser(user){
                axios.get("/users/"+user.id+"/restore").then(response => {
                    console.log("restaurado usuario correctament");
                    this.getUserTrash();
                });
            },
            destroyUser(user){                
                axios.patch("/users/"+user.id+"/delete").then(response => {
                    console.log("destroido usuario correctament");
                    console.log("faltan mensaje de eliminacion");
                    this.getUserTrash();
                });
            },
            viewRoles(role){
                if (role[0]) {
                    return role[0].name;
                }else{
                    return "---";
                }
            }
        }
    }
</script>
