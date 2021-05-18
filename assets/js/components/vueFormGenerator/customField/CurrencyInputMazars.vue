<template>
  <currency-input
    class="form-control text-right"
    v-model="value"
    :readonly="schema.readonly"
    style="width: 100%"
    />
</template>

<script>
import { abstractField } from "vue-form-generator";
import { CurrencyInput } from 'vue-currency-input'

export default {
  name: "CurrencyInputMazars",
  mixins: [ abstractField ],
  components: { CurrencyInput },
  data() {
    return {
    }
  },
  mounted: async function () {
  }
}
</script>

<style scoped>

</style>
