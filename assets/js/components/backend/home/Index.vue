<template>
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12 main-chart">
          <div class="border-head">
            <h3>{{ $t('welcome') }}</h3>
          </div>
          <apexchart width="1500" type="bar" :options="options" :series="series[0].data"></apexchart>
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
          count: [],
          nbrAgencies: 0,
          options: {
            chart: {
              id: 'vuechart-example'
            },
            xaxis: {
              categories: []
            },
            title: {
              text: 'Percent of interventions in agencies',
              align: 'center',
              style: {
                fontSize:  '20px',
              },
            },
            colors: ['#00897b']
          },
          series: [{
            data: []
          }]
        }
      },
      methods: {
        getAgencies: async function () {
          const axios = require('axios');
          let self = this;
          let response = await axios.get('/api/agencies/list');
          return response.data.map(
              function (agency) {
                agency.percent = agency.percent * (response.data.length / 100);
                return agency;})
        },
        },
      mounted: async function() {
        this.agencies = await this.getAgencies();
        this.agencies.forEach((element)=>{
          this.options.xaxis.categories.push(element.name)
          this.series[0].data.push(element.percent)
        })
        this.nbrAgencies = this.agencies.length;
      },
    };
</script>