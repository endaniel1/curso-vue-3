<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <heading-content-component 
            @back="pageBack"
            :titlePage="descriptionPage"
            />

            <body-content-component
            :body="componentBody"
            @goUrl="changeComponent"
            />
            
        </div>
    </div>
</template>

<script>
    export default {
        created() {
           this.getDefaultData();
        },
        data(){
            return{
                descriptionPage: [],
                componentBody: "",
                data:""
            }
        },
        methods:{
            getDefaultData(){
                this.descriptionPage = ["Home","User"];
                this.componentBody = "content-user-component"
            },
            pageBack(page){
                console.log("back desde index user compontent");
                this.$parent.switchTo(page+"-component");//llamamos aqui el elemento padre y llamomos a la funcion q cambia de componente
            },
            changeComponent(change){
                this.endContent = change;
            },
        },
        computed:{

        }
    }
</script>
