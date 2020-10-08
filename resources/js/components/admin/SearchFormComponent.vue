<template>
    <form method="get" :action="urlSearch" v-on:submit.prevent="search()">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="search" class="sr-only">Buscar</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." value="" />
            </div>
            <div class="form-group col-md-3">
                <label for="from" class="sr-only">Fecha desde</label>
                <input type="date" id="from" name="from" class="form-control" placeholder="Fecha desde" value="" />
            </div>
            <div class="form-group col-md-3">
                <label for="to" class="sr-only">Fecha hasta</label>
                <input type="date" id="to" name="to" class="form-control" placeholder="Fecha hasta" value="" />
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
            }
        },
        methods:{
            search(){
                console.log("a buscar");
            }
        }
    }
</script>
