<template>
    <div class="card-body">
        <search-form-component 
        :urlSearch="url"
        />

        <div class="d-flex mb-3 justify-content-end">
            <a href="#" class="btn btn-success" @click.prevent="goUrl(addNewComponent[0])">
                <i class="fas fa-plus-square"></i> Agregar Nuevo
            </a>
            <a href="#" class="btn btn-danger ml-2" @click.prevent="goUrl(addNewComponent[1])">
                <i class="fas fa-trash-restore"></i> Papelera
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props:["addNewComponent"],
        mounted() {
            console.log('Component mounted. ListsUserComponent.vue')
        },
        data(){
            return{
                url : "users"
            }
        },
        methods:{
            goUrl(component){
                this.$emit("headingDescription", component);
                this.$parent.contentBody = component+"-user-component";
            }
        }
    }
</script>
