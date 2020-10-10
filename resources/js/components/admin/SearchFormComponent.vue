<template>
    <form method="get" :action="urlSearch" @submit.prevent="search">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="search" class="sr-only">Buscar</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." v-model="data.search"/>
            </div>
            <div class="form-group col-md-3">
                <label for="from" class="sr-only">Fecha desde</label>
                <input type="date" id="from" name="from" class="form-control" placeholder="Fecha desde" v-model="data.from" />
            </div>
            <div class="form-group col-md-3">
                <label for="to" class="sr-only">Fecha hasta</label>
                <input type="date" id="to" name="to" class="form-control" placeholder="Fecha hasta" v-model="data.to"/>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i>Buscar</button>
            </div>
        </div>
        <slot name="add"></slot>
    </form>
</template>

<script>
    export default {
        props:["urlSearch"],
        mounted() {
            //console.log('Component mounted.')
        },
        data(){
            return {    
                data:{
                    search:"",
                    from:"",
                    to:"",
                    data:[]
                }
            }
        },
        methods:{
            search(event){
                //hasta aqui llege
                //tengo q buscar como obtener todos los datos de mi formulario para enviarlo para consultar
                this.data = [];
                console.log("a buscar");
                
            }
        }
    }
</script>
