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
                    <div class="fc-event">{{ user.email }}</div>
                  </div>
                  <div class="fc-event"></div>
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
      emails: [],
      users: [],
    };
  },
  methods: {
    list: async function () {
      const axios = require('axios');
      const promise = await axios.get('/api/users/list')
      return promise.data;
    },
  },
  props: {
    employees : Array
  },
    mounted() {
    this.list();
    this.users = this.employees
  }
};
</script>
<style scoped>

</style>


