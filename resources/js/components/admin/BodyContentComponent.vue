<template>
    <div class="card shadow mb-3">

        <component
        @headingDescription="addDescriptionHeading"
        :addNewComponent="addComponentNew"
        v-bind:is="changeComponet"
        ></component>

    </div>
</template>

<script>
   export default {
        props:["body","dataBody"],
        mounted() {
            console.log('Component mounted. BodyComponent.vue');
        },
        data(){
            return{ 
                addComponentNew : [
                    "create", "trash"
                ],
                contentBody : this.body,
                dataComponent : this.dataBody,
            }
        },
        methods:{
            pageBack(page){
                console.log("back desde index body content compontent");
                this.$parent.switchTo(page+"-component");//llamamos aqui el elemento padre y llamomos a la funcion q cambia de componente
            },
            addDescriptionHeading(descripNew){
                this.$parent.descriptionPage.push(descripNew);
            }
        },
        computed:{
            changeComponet(){
                return this.contentBody;
            }
        }
    }
</script>
