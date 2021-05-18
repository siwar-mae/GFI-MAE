<template>
  <input
    class="form-control"
    v-model="value"
    :readonly="schema.readonly"
    :required="schema.required"
    type="text"
    v-on:blur="onblurFunction(value)" >

</template>

<script>
import {abstractField} from "vue-form-generator";

export default {
  name: "OnBlurInput",
  mixins: [abstractField],
  data() {
    return {
    }
  },
  methods:{
    onblurFunction : function(value){
     this.schema.onBlurFunction(value)
    }
  },
  mounted: async function () {
  }
}
</script>

<style scoped>

</style>
