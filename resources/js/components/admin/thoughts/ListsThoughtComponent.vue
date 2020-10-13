<template>
    <div class="card">
        <div class="card-header">Publicado en {{thought.created_at}} - ultima Actualizacion {{thought.updated_at}}</div>
        <div class="card-body">
            <input v-if="editModel" type="text" class="form-control" v-model="thought.description">
            <p v-else>{{thought.description}}</p>
        </div>
        <div class="card-footer">
             <button v-if="editModel" type="button" class="btn btn-success"
                v-on:click="update()"
            >Guardar Cambios</button>
            <button v-else type="button" class="btn btn-default"
                v-on:click="edit()"
            >Editar</button>
            <button type="button" class="btn btn-danger"
                v-on:click="destroy()"
            >Eliminar</button>
        </div>
    </div>
</template>

<script>
    export default {
        name:"lists-thought-component",
        props:["thought"],
        data(){
            return {
                editModel: false,
            }
        },
        mounted() {
            //console.log('Component mounted.')
        },
        methods: {
            destroy(){
                console.log(`/thoughts/${this.thought.id} ruta de eliminacion`);
                axios.delete(`/thoughts/${this.thought.id}`).then(respose => {
                    this.$emit("deleteThought");
                });
            },
            edit(){
                this.editModel = true;
            },
            update(){
                const params = {
                    description: this.description,
                };
                console.log(`/thoughts/${this.thought.id} ruta de actualizacion`);
                axios.put(`/thoughts/${this.thought.id}`, params).then(respose => {
                    this.editModel = false;
                    const thought = respose.data;
                    this.$emit("updateThought", thought);
                });
            }
        }
    }
</script>
