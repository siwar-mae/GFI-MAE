<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> {{ $t('affect_intervention') }}</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <div class='demo-topbar'>
          </div>
          <div id='wrap'>
            <div id='calendar'></div>
            <div style='clear:both'></div>
          </div>
        </div>
      </div>
    </section>
  </section>

</template>

<script>
import Vue from 'vue';
export default {
  name: "InterventionAffect",
  components: {},
  data() {
    return {
      emails: [],
      users: [],
      date: '',
      user: '',
      affectations: [],
    };
  },
  methods: {
    list: async function () {
      const axios = require('axios');
      const promise = await axios.get('/api/users/list')
      return promise.data;
    },
    formatDate: function (value) {
      return this.$options.filters.formatDate(value, 'fr');
    },
    listAffectation: function () {
      const axios = require('axios');
      let self = this;
      // Make a request for a user with a given ID
      axios.get('/api/affectations/list')
          .then(function (response) {
            // // handle success
            self.affectations = response.data;
          });
    },
  },
  props: {
    employees : Array,
  },
  mounted() {
    this.users = this.employees;
    this.listAffectation();
  }
};
$(function() {
  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid' ],
    defaultView: 'dayGridMonth',
    header: {
      center: 'addEventButton'
    },
    customButtons: {
      addEventButton: {
        text: 'add event...',
        click: function() {
          var dateStr = prompt('Enter a date in YYYY-MM-DD format');
          var date = new Date(dateStr + 'T00:00:00'); // will be in local time

          if (!isNaN(date.valueOf())) { // valid?
            this.user = prompt('Enter intervenant');
            this.date = date;
            const axios = require('axios');
            let self = this;
            const config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json'
              }
            };
            axios.post('/api/affectations/post', {user: self.user, date: self.date}, config)
                .then(response => {
                      calendar.addEvent({
                        title: this.user,
                        start: date,
                        allDay: true
                      });
                      Vue.$toast.open({
                        message: 'added_successfully',
                        type: 'success',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                      });
                    }
                    , (error) => {
                      Vue.$toast.open({
                        message: 'user_affected_to_this_date',
                        type: 'error',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                      });
                    });
          }
        }
      }
    }
  });

  calendar.render();

});
</script>
<style scoped>

</style>


