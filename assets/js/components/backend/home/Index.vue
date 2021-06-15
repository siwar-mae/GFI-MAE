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
            <div class="bar">
              <div class="title">JAN</div>
              <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
            </div>
            <div class="bar ">
              <div class="title">FEB</div>
              <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
            </div>
            <div class="bar ">
              <div class="title">MAR</div>
              <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
            </div>
            <div class="bar ">
              <div class="title">APR</div>
              <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
            </div>
            <div class="bar">
              <div class="title">MAY</div>
              <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
            </div>
            <div class="bar ">
              <div class="title">JUN</div>
              <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
            </div>
            <div class="bar">
              <div class="title">JUL</div>
              <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
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
    };
</script>