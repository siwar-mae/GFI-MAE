<template>
  <section id="main-content">
    <section class="wrapper site-min-height">
      <div class="row mt">
        <div class="col-lg-12">
          <div class="row content-panel">
            <div class="col-md-4 profile-text mt mb centered">
              <div class="right-divider hidden-sm hidden-xs">
                <h2> {{ $t('welcome') }} ! </h2>
              </div>
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 profile-text">
              <h2>{{ fullName }}</h2>
              <h4>{{ role }}</h4>
              <h4>{{ email }}</h4>
              <h4>{{ address }}</h4>
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 centered">
              <div class="profile-pic">
                <p><img v-bind:src=model.thumb class="img-circle"></p>
              </div>
            </div>
            <!-- /col-md-4 -->
          </div>
          <!-- /row -->
        </div>
        <!-- /col-lg-12 -->
        <!-- /row -->
      </div>
      <div class="detailed mt">
        <h4>{{ $t('todo') }}</h4>
        <div class="recent-activity" v-for="item in items">
          <div class="activity-icon bg-theme"><i class="fa fa-check"></i></div>
          <div class="activity-panel">
            <h5>{{ $t('intervention') }}</h5>
            <p>{{ $t('date') }}: {{item.date}}</p>
          </div>
        </div>
        <!-- /recent-activity -->
      </div>
      <!-- /container -->
    </section>
    <!-- /wrapper -->
  </section>
</template>

<script>
import Vue from "vue";
    export default {
        name: "Index",
        props: {
          fullName: String,
          email: String,
          address: String,
          role: String,
          id: String,
          thumb: String
        },
        mounted() {
          this.model.fullName = this.fullName;
          this.model.email = this.email;
          this.model.address = this.address;
          this.model.role = this.role;
          this.model.id = this.id;
          this.model.thumb = this.thumb;
          this.listAffectationsByUser()
        },
        data () {
          return {
            model: {
              email: '',
              fullName: '',
              role: '',
              address: '',
              id: '',
              thumb: ''
            },
            items: [],
          }
        },
        methods: {
          put: function () {
            const axios = require('axios');
            let self = this;
            const config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json'
              }
            };
            axios.put('/api/users/put', self.model, config)
                .then(response => {
                      Vue.$toast.open({
                        message: this.$t('updated_successfully'),
                        type: 'success',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                      });
                    }
                    , (error) => {
                      Vue.$toast.open({
                        message: this.$t('error'),
                        type: 'error',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                      });
                    }
                );
          },
          listAffectationsByUser: function () {
            const axios = require('axios');
            let self = this;
            // Make a request for a user with a given ID
            axios.get('/api/affectations/list')
                .then(function (response) {
                  // handle success
                  self.items = response.data.dataByUser;
                  self.items.map((item) => {
                    item.date = self.$options.filters.formatDate(item.date.date, 'fr');
                    return {...item}})
                });
          },
        },
    };
</script>