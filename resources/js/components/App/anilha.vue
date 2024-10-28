<template>
<div>
   
     <table-component :dados="anilha" :titulos="['id','numeracao']">
     </table-component>
</div>


</template>

<script>

    export default {
        data () {
        return {
            urlbase: 'http://localhost:8000/api/anilha',
            anilha: {data: []},
            
        }
        
    },
    methods: {
        carregarLista(){
                 let url = this.urlbase 

                
                axios.get(url)
                .then(response =>{
                    this.anilha = response.data
                    

                })
                .catch(errors =>{
                    console.log(errors)
                })
            },
    },
    mounted(){
                this.carregarLista()
            }
    
    }
</script>
