<template>
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="row">
                <div class="col-1-text-justify" 
                v-for="(title, index) in titlePage" 
                :key="index">
                    <a href="#"
                    v-if="titlePage.length > 1 && index + 1 != titlePage.length"
                    v-on:click="back(title.toLowerCase())">{{title}}</a> 
                    <p v-else>{{title}}</p>
                    <span v-if="index + 1 < titlePage.length"> \ &nbsp;</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {        
        props:["titlePage"],
        mounted() {
           
        },
        data(){
            return {
            }
        },
        methods:{
            back(page){
                console.log("back desde heade content compoenten");
                console.log( this.$options.data);
                this.$emit("back", page);
            }
        }
    }
</script>
