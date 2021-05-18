<template>
  <DatePicker v-model="value"
              :language="setLocale('fr')"
              @input="change"
              :format="DatePickerFormat"
              >
  </DatePicker>
</template>

<script>

import DatePicker from 'vuejs-datepicker';
import {abstractField} from 'vue-form-generator'
import {de, en, fr} from 'vuejs-datepicker/dist/locale'
import datetime from 'vuejs-datetimepicker';
export default {
  name: 'DatePickerMazars',
  mixins: [abstractField],
  components: {DatePicker, datetime},
  data: function () {
    return {
      default: '14-05-2021',
      DatePickerFormat: 'dd-MM-yyyy hh:mm',
      languages: {
        en: en,
        fr: fr,
        de: de
      }
    }
  },
  methods: {
    setLocale: function (locale) {
      return this.languages[locale];
    },
    change: function () {
      this.$root.$emit('change', this.value)
    }
  },
  mounted: function () {
  }
}
</script>
