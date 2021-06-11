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
                  <p class="fc-event">{{ user.email }}</p>
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
  },
  props: {
    employees : Array,
  },
  mounted() {
    this.users = this.employees;
  }
};
$(function() {

  /* initialize the external events
  -----------------------------------------------------------------*/
  $('#external-events .fc-event').each(function() {
    // store data so the calendar knows to render an event upon drop
    $(this).data('event', {
      title: $.trim($(this).text()), // use the element's text as the event title
      stick: true // maintain when user navigates (see docs on the renderEvent method)
    });
    // make the event draggable using jQuery UI
    $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
    });

  });
  /* initialize the calendar
  -----------------------------------------------------------------*/
  $('#calendar').fullCalendar({
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    dragRevertDuration: 0,
    drop: function() {
      // is the "remove after drop" checkbox checked?
      if ($('#drop-remove').is(':checked')) {
        // if so, remove the element from the "Draggable Events" list
        $(this).remove();
      }
    },
    eventDragStop: function( event, jsEvent, ui, view ) {
      if(isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
        $('#calendar').fullCalendar('removeEvents', event._id);
        var el = $( "<div class='fc-event'>" ).appendTo( '#external-events-listing' ).text( event.title );
        el.draggable({
          zIndex: 999,
          revert: true,
          revertDuration: 0
        });
        el.data('event', { title: event.title, id :event.id, stick: true });
      }
    },
    eventReceive: function (event){
      let self = this;
      self.user = event.title;
      self.date = event.start._d;
      var affectation = new CustomEvent("affectation", {
        "detail": {"user":self.user,"date":self.date }
      });
      document.dispatchEvent(affectation);
    },
  });

  var isEventOverDiv = function(x, y) {
    var external_events = $( '#external-events' );
    var offset = external_events.offset();
    offset.right = external_events.width() + offset.left;
    offset.bottom = external_events.height() + offset.top;
    // Compare
    if (x >= offset.left
        && y >= offset.top
        && x <= offset.right
        && y <= offset .bottom) { return true; }
    return false;
  };

  document.addEventListener("affectation", function (e) {
    this.user = e.detail.user;
    this.date = e.detail.date;
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
  });


});
</script>
<style scoped>

</style>


