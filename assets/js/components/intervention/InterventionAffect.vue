<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> {{ $t('affect_intervention') }}</h3>
      <div class="row mt">
        <div class="col-lg-12">
            <div id='wrap'>
              <div id='external-events'>
                <div id='external-events-listing'>
                  <h4>Users</h4>
                  <div v-for="user in users">
                    <div class='fc-event'>{{ user.id }}</div>
                  </div>
                </div>
                <p>
                  <input type='checkbox' id='drop-remove' checked='checked' />
                  <label for='drop-remove'>remove after drop</label>
                </p>
              </div>
              <div id='calendar'></div>
              <div style='clear:both'></div>
            </div>
        </div>
      </div>
    </section>
  </section>

</template>

<script>
export default {
  name: "InterventionAffect",
  components: {},
  data() {
    return {
      users: []
    };
  },
  methods: {
    list: function () {
      const axios = require('axios');
      let self = this;
      // Make a request for a user with a given ID
      axios.get('/api/users/list')
          .then(function (response) {
            // handle success
            self.users = response.data;
          });
    },
  },
  mounted() {
    this.list()
  }
};
</script>
<style scoped>

</style>


