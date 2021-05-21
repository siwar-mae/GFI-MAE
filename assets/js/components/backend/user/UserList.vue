<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Gestion des utilisateurs</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> Liste des utilisateurs</h4>
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
                        color="success"
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
  { key: 'email', _style:'min-width:100px;' },
  { key: 'roles', _style:'min-width:200px;' },
  { key: 'fullName', _style:'min-width:200px;' },
  {
    key: 'actions',
    label: 'Actions',
    _style: 'width:1%',
    sorter: false,
    filter: false,
  }
];
export default {
  name: "UserList",
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

