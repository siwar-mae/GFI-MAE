<template>
  <v-select
    :options="this.options"
    v-model="value"
    :disabled="schema.disabled"
    :placeholder="schema.placeholder"
    class="bg-light"
    style="width: 100%">
  </v-select>
</template>
<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import "vue-select/src/scss/vue-select.scss";
import { abstractField } from "vue-form-generator";

export default {
  name: 'SelectMazars',
  mixins: [ abstractField ],
  components: { vSelect },
  data() {
    return {
      options: []
    }
  },
  methods: {},
  mounted: async function () {
    this.options = await this.schema.getOptions();
  }
}
</script>
