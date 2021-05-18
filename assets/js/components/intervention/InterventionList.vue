<template>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Gestion des interventions</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <h4><i class="fa fa-angle-right"></i> Liste des interventions</h4>
                    <div class="content-panel">
                        <div class="adv-table" style="padding: 10px">
                            <vue-table-dynamic
                                    :params="params"
                                    ref="table"
                            >
                            </vue-table-dynamic>
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
    import VueTableDynamic from 'vue-table-dynamic'

    export default {
        name: "InterventionList",
        components: { VueTableDynamic },
        data() {
            return {
                params: {
                    data: [
                        ['ID', 'N°Intervention', `Date début`, `Structure`, `Observation(s)`, `Action(s)`]
                    ],
                    header: 'row',
                    enableSearch: true,
                    border: true,
                    stripe: true,
                    pagination: true,
                    pageSize: 5,
                    sort: [0, 1,2 ,3, 4, 5],
                    pageSizes: [5, 10, 20, 50],
                    columnWidth: [{column: 0, width: 100},{column: 1, width: 200},{column: 2, width: 200},{column: 3, width: 200},{column: 4, width: 1000},{column: 5, width: 400},],
                    fixed: 0,
                }

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
                        self.interventions = response.data.interventionsByUser;
                        for (let i = 0; i < self.interventions.length; i++) {
                            let structure = self.interventions[i].agency.name + ' (' + self.interventions[i].agency.code + ') ';
                            self.interventions[i].startDate.date = self.$options.filters.formatDate(self.interventions[i].startDate.date, 'fr');
                            self.params.data.push(([self.interventions[i].id, self.interventions[i].number, self.interventions[i].startDate.date,structure, self.interventions[i].observation, self.addBtn()]))
                        }
                    });
            },
            addBtn: function(){
                return ('<button type="button">Test</button>');
            }
        },
        mounted() {
            this.list()
        },
    }
</script>

<style scoped>
.truncate{
    width: 500px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

