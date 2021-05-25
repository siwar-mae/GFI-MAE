<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> {{ $t('intervention_management') }}</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> {{ $t('list_of_intervention') }} </h4>
          <div class="content-panel">
            <div class="adv-table" style="padding: 10px">
              <CDataTable
                  :items="items"
                  :fields="fields"
                  column-filter
                  :table-filter="tableFilter"
                  :items-per-page-select="itemsPerPageSelect"
                  :items-per-page="5"
                  hover
                  sorter
                  pagination
              >
                <template #actions="{item, index}">
                  <td class="py-2">
                    <CButton
                        color="success"
                        variant="outline"
                        square
                        size="sm"
                        @click="pdf(item)"
                    >
                      {{Boolean(item._toggled) ? 'Hide' : $t('generate_pdf')}}
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
export default {
  name: "InterventionList",
  components: { },
  data() {
    return {
      fields: [
        { key: 'id', _style:'min-width:100px', label: this.$t('id') },
        { key: 'number', _style:'min-width:100px;', label: this.$t('number') },
        { key: 'startDate', _style:'min-width:200px;', label: this.$t('start_date') },
        { key: 'agency', _style:'min-width:200px;', label: this.$t('agency') },
        { key: 'observation', _style:'min-width:100px;', label: this.$t('observation') },
        {
          key: 'actions',
          label: this.$t('action'),
          _style: 'width:1%',
          sorter: false,
          filter: false,
        }
      ],
      tableFilter: {
        label: this.$t('filter_datagrid'),
        placeholder: this.$t('type_string')
      },
      itemsPerPageSelect: {
        label: this.$t('items_per_pages'),
      },
      noItemsView: {
        noResults: this.$t('no_filtering_results'),
        noItems: this.$t('no_items')
      },
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
    goToReport: function (item){
      if (item.id !== undefined) {
        window.open(this.location = 'api/document/report/' + item.id)
      }
    },
    pdf: function (item){
      if (item.id !== undefined) {
        window.open(this.location = '/api/documents/pdf/' + item.id)
      }
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

