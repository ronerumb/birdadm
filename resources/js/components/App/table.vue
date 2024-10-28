<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th v-for="t in titulos" :key="t" class="text-capitalize">{{ t }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="obj in dados" :key="obj.id">
          <template v-for="(valor, chave) in obj" v-if="titulos.includes(chave)">
            <td :key="chave">{{ valor }}</td>
          </template>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    dados: {
      type: Array,
      required: true
    },
    titulos: {
      type: Array,
      required: true
    }
  },
  methods: {
   
  }
}
</script>
