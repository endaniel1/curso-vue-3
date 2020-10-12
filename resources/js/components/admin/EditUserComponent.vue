<template>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 font-weight-bold">Editar Usuario</h6>
                </div>
                <div class="card-body">
                    <div v-if="errors != ''" class="alert alert-danger" role="alert">
                        <ul>                        
                            <li v-for="(error,index) in errors">{{ $error }}</li>
                        </ul>
                    </div>
                </div>
                <form-user-component 
                :dataUser="user"
                :getDataUser="urlGetDataUser"
                :actionForm="urlForm"
                />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            console.log('Component mounted. EditUserComponent.vue')
            //console.log(this.$parent.data)
            this.getData(this.$parent.data)
            this.$parent.data = ""//para eliminar los datos del componente padre q ya no los nesecito
        },
        data(){
           return{
            user : "",
            errors : [],
            urlForm : "update",
            rolesUser:"",
            urlGetDataUser:""
           }
        },
        methods:{
            getData(data){
                this.user = this.$parent.data;
                this.urlGetDataUser = "users/"+this.$parent.data+"/edit";                
            }
        }
    }
</script>
