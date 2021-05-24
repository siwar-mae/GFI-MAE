<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> {{ $t('user_management') }}</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> {{ $t('user_list') }}</h4>
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
                    >
                      {{Boolean(item._toggled) ? 'Hide' : $t('edit')}}
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
  name: "UserList",
  components: { },
  data() {
    return {
      fields: [
        { key: 'id', _style:'min-width:100px', label: this.$t('id') },
        { key: 'email', _style:'min-width:100px;', label: this.$t('email') },
        { key: 'roles', _style:'min-width:200px;', label: this.$t('role')},
        { key: 'fullName', _style:'min-width:200px;', label: this.$t('fullName')},
        {
          key: 'actions',
          label: this.$t('action'),
          _style: 'width:1%',
          sorter: false,
          filter: false,
        }
      ],
      details: [],
      collapseDuration: 0,
      items: [],
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
    }
  },
  methods: {
    list: function () {
      const axios = require('axios');
      let self = this;
      // Make a request for a user with a given ID
      axios.get('/api/users/list')
          .then(function (response) {
            // handle success
            self.items = response.data;
            self.items.map((item) => {
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

