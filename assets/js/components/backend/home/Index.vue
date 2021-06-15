<template>
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12 main-chart">
          <!--CUSTOM CHART START -->
          <div class="border-head">
            <h3>Welcome !</h3>
          </div>
          <div class="custom-bar-chart mr-4">
            <ul class="y-axis">
              <li><p>10.000</p></li>
              <li><p>8.000</p></li>
              <li><p>6.000</p></li>
              <li><p>4.000</p></li>
              <li><p>2.000</p></li>
              <li><p>0</p></li>
            </ul>
            <div class="bar" v-for="agency in agencies">
              <div class="title">{{ agency.name }}</div>
              <div class="value tooltips" data-toggle="tooltip" data-placement="top">{{ agency.percent }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>

    export default {
      name: "Index",
      data() {
        return {
          agencies: [],
          count: [],
          nbrAgencies: 0,
        }
      },
      methods: {
        getAgencies: async function () {
          const axios = require('axios');
          let self = this;
          let response = await axios.get('/api/agencies/list');
          return response.data.map(
              function (agency) {
                console.log(agency.percent);
                // console.log(self.nbrAgencies);
                let percent = agency.percent * (self.nbrAgencies / 100);
                agency.percent = Math.round(percent)
                // console.log(agency)
                return agency;
              })
        },
        },
      mounted: async function() {
        this.agencies = await this.getAgencies();
        this.nbrAgencies = this.agencies.length;
      },
    };
</script>