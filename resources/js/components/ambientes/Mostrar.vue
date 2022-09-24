<template>
    <div class="row">
        <div class="col-12 mb-2">
            <!-- llamamos al componente para Crear   -->
        </div>
        <div class="col-12">             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ambiente in ambientes" :key="ambiente.id">
                                    <td>{{ ambiente.id }}</td>
                                    <td>{{ ambiente.Nombre_Ambiente }}</td>
                                    <td>
                                    
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>                          
        </div>
    </div>
</template>

<script>
export default {
    name:"ambientes",
    data(){
        return {
            ambientes:[]
        }
    },
    mounted(){
        this.mostrarambiente()
    },
    methods:{
        async mostrarambiente(){
            await this.axios.get('/api/ambientes').then(response=>{
                this.ambientes = response.data
            }).catch(error=>{
                console.log(error)
                this.ambientes = []
            })
        }
    }
}
</script>