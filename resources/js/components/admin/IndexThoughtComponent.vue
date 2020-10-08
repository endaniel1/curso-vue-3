<template>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <heading-content-component 
            @back="pageBack"
            :title="description"
            />
             <search-form-component 
            :urlSearch="urlSearch"
            >
            </search-form-component>

           <keep-alive>
                <component
                :addNewComponent="addComponentNew"
                @goUrl="changeComponent"
                v-bind:is="endContent"
                ></component>
            </keep-alive>

            <form-thought-component 
                @newThought="addThought"></form-thought-component>   
            
            <lists-thought-component 
                v-for="(thought, index) in thoughts" 
                :key="thought.id" 
                :thought="thought"
                @updateThought="updateThought(index, thought)"
                @deleteThought="deleteThought(index)"
                />   

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getThought();
        },
        data(){
            return {
                description:"thought",   
                urlSearch:"thoughts",
                endContent:"",//no lo agrego aqui para qq cambie de componente porque para q funcione la listo o tabla hay q pasarle el trought pero no es como lo voy hacer
                addComponentNew: [
                    "form-thought-component", "trash-thought-component"
                ],
                thoughts:[],
            }
        },
        methods:{
            getThought(){
                console.log("cargando data");
                axios.get("/thoughts").then(response => {
                    this.thoughts = response.data.data;
                    //console.log(response.data);
                });
            },
            addThought(thought){
                console.log("añadiendo data a mi variable");
                this.thoughts.push(thought);
            },
            deleteThought(index){
                console.log("eliminar data a mi variable");
                this.thoughts.splice(index, 1);
            }, 
            updateThought(index, thought){
                console.log("actualizar data a mi variable");
                this.thoughts[index] = thought;
            },
            //lo q eh agregado nuevo
            pageBack(page){
                console.log("back desde index thought compontent");
                this.$parent.switchTo(page+"-component");//llamamos aqui el elemento padre y llamomos a la funcion q cambia de componente
            },
            changeComponent(change){
                this.endContent = change;
            }
        }
    }
</script>
