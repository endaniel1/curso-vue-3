<template>
    <div class="card">
        <div class="card-header">En que estás Pensando</div>

        <form action="" v-on:submit.prevent="newThought()" accept-charset="utf-8">
            <div class="from-group">
                <label for="thought">Estoy pensando en:</label>
                <input type="text" id="thought" class="form-control" name="thought" v-model="description">
            </div>
            <button type="submit" class="btn btn-primary">Enviar pensamiento</button>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            //console.log('Component mounted.')
        },
        data(){
            return {
                description: ""
            }
        },
        methods:{
            newThought(){
                const params = {
                    description: this.description,
                }
                this.description = "";
                axios.post("/thoughts", params).then(response => {
                    const thought = response.data;
                    this.$emit("newThought", thought);
                });
            }
        }
    }
</script>
