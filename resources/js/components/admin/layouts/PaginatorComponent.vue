<template>
	<div class="row">
		<div class="col-12 d-flex justify-content-center">
			<nav>
				<ul class="pagination">
					<li v-if="datapagination.current_page > 1">
						<a href="#" title="Atras" @click.prevent="changePages(datapagination.current_page - 1)">
							<span aria-hidden="true">&laquo;</span> <span>Atras</span>
						</a>
					</li>

					<li v-for="page in pagesNumber" v-bind:class="[page == isActived ? 'active' : '']">
						<a href="#" :title="page" @click.prevent="changePages(page)">
							{{page}}
						</a>
					</li>

					<li v-if="datapagination.current_page < datapagination.last_page">
						<a href="#" title="Siguiente" @click.prevent="changePages(datapagination.current_page + 1)">
							<span>Siguiente</span> <span aria-hidden="true">&raquo;</span>
						</a>
					</li>	
				</ul>
			</nav>
		</div>
	</div>
</template>
<script>
	export default {     
		name:"paginator-component",   
        props:["datapagination"],
        created() {
        },
        data(){
            return {
            	offset :3,
            }
        },
        methods:{
	    	changePages(page){//metodo q cambia de pagina
	    		this.datapagination.current_page=page;//decimos q la paginacion tenga la pagina actual
	    		this.$emit("changePages",page);//cargamos los keep con la pagina actual
	    	}
        },
        computed:{
        	isActived(){//para calcular la pagina activa
    			return this.datapagination.current_page;
    		},
	    	pagesNumber:function(){
	    		if (!this.datapagination.to) {//sino tenemos hasta
	    			return [];//retornamos nada
	    		}
	    		//controlando el control de la variable desde y si es negativo
	    		var from=this.datapagination.current_page - this.offset;//compesamos lo de la pagina actual
	    		if (from < 1) {
	    			from = 1;
	    		}
	    		//controlando el control de la variable hasta y si es mayor a la ultima pagina
	    		var to=from +(this.offset * 2);
	    		if(to >= this.datapagination.last_page){
	    			to=this.datapagination.last_page;
	    		}
	    		//
	    		var pagesArray=[];
	    		while(from <= to){
	    			pagesArray.push(from);
	    			from++;
	    		}
	    		return pagesArray;
	    	}
        }
    }
</script>