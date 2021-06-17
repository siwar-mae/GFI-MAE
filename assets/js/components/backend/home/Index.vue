<template>
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12 main-chart">
          <div class="border-head">
            <h3>{{ $t('welcome') }}</h3>
          </div>
            <div id="chart" ref="barchart"></div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import Vue from 'vue';
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

    export default {
      name: "Index",
      data() {
        return {
          agencies: [],
          nbrAgencies: 0,
          names: [],
          percents: [],
        }
      },
      methods: {
        getAgencies: async function () {
          const axios = require('axios');
          let response = await axios.get('/api/agencies/list');
          return response.data.map(
              function (agency) {
                agency.percent = agency.percent * (response.data.length / 100);
                return agency;})
        },
        },
      mounted: async function() {
        this.agencies = await this.getAgencies();
        this.nbrAgencies = this.agencies.length;
        this.names = this.agencies.map(element => ( element.name));
        this.percents = this.agencies.map(element => ( element.percent))
        const chart = new ApexCharts(this.$refs.barchart, {
          chart: {
            type: 'bar',
            height: 400,
          },
          series: [{
            name: this.$t('number_of_interventions_per_agency'),
            data: this.percents
          }],
          xaxis: {
            categories: this.names,
          },
          colors: ['#006400'],
          title: {
            text: this.$t('interventions_per_agency'),
            align: 'center'
          },
        })
        await chart.render()
      },
    };
</script>