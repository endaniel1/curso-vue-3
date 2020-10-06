<template>
    <div class="row justify-content-center">
        <div class="col-md-8">

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
            }
        }
    }
</script>
