<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj"  :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'text'">{{ valor }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">{{ '...' + valor }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="30px" height="30px">
                        </span>


                    </td>
                </tr>



            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['dados', 'titulos'],
    computed: {
        dadosFiltrados(){
           let campos = Object.keys(this.titulos)
           let dadosFiltrados = [];

            // map mapeia cada função que esta sendo passada na list
            this.dados.map((item, chave) => {

                let itemFiltrado = {}
                campos.forEach(campo => {

                    itemFiltrado[campo] = item[campo]; // a sintaxe [] de array pode ser usada para atribuir valores a objetos

                })
                dadosFiltrados.push(itemFiltrado)
            })


            return dadosFiltrados;
        }
    }
}
</script>
