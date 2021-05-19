<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Gestion des interventions</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> Liste des interventions</h4>
          <div class="content-panel">
            <div class="adv-table" style="padding: 10px">
              <CDataTable
                  :items="items"
                  :fields="fields"
                  column-filter
                  table-filter
                  items-per-page-select
                  :items-per-page="5"
                  hover
                  sorter
                  pagination
              >
                <template #actions="{item, index}">
                  <td class="py-2">
                    <CButton
                        color="primary"
                        variant="outline"
                        square
                        size="sm"
                    >
                      {{Boolean(item._toggled) ? 'Hide' : 'Edit'}}
                    </CButton>
                  </td>
                </template>
              </CDataTable>
            </div>
          </div>
          <!-- /form-panel -->
        </div>
        <!-- /col-lg-12 -->
      </div>
      <!-- /row -->
    </section>
  </section>
</template>

<script>
const fields = [
  { key: 'id', _style:'min-width:100px' },
  { key: 'number', _style:'min-width:100px;' },
  { key: 'startDate', _style:'min-width:200px;' },
  { key: 'agency', _style:'min-width:200px;' },
  { key: 'observation', _style:'min-width:100px;' },
  {
    key: 'actions',
    label: 'Actions',
    _style: 'width:1%',
    sorter: false,
    filter: false,
  }
];
export default {
  name: "InterventionList",
  components: { },
  data() {
    return {
      fields,
      details: [],
      collapseDuration: 0,
      items: [],
    }
  },
  methods: {
    list: function () {
      const axios = require('axios');
      let self = this;
      // Make a request for a user with a given ID
      axios.get('/api/interventions/list')
          .then(function (response) {
            // handle success
            self.items = response.data.interventionsByUser;
            self.items.map((item) => {
              item.startDate = self.$options.filters.formatDate(item.startDate.date, 'fr');
              item.agency =  item.agency.name + '(' + item.agency.code + ')'
              return {...item}})
          });
    },
  },
  mounted() {
    this.list()
  },
  computed: {
  },
  watch: {
  },
}
</script>

<style scoped>
</style>

