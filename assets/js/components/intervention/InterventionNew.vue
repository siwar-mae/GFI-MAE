<template>
    <!-- Your HTML tags-->
    <section id="main-content">
        <section class="wrapper">
            <Modal v-model="showModalConfig" :title=title size="xl">
                <InterventionConfig :agency.sync="this.model.structure"></InterventionConfig>
            </Modal>
            <h3><i class="fa fa-angle-right"></i> {{ $t('intervention_management') }}</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <h4><i class="fa fa-angle-right"></i> {{ $t('add_an_intervention') }}</h4>
                    <div class="form-panel">
                        <div class="form">
                            <form class="cmxform form-horizontal style-form" id="signupForm" @submit.prevent="post">
                                <div class="form-group ">
                                    <label for="number" class="control-label col-lg-2">{{ $t('number') }}</label>

                                    <div class="col-lg-10">
                                        <input class=" form-control" id="number" name="number" type="text" readonly v-model="model.number"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="startDate" class="control-label col-lg-2">{{ $t('startDate') }}</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" id="startDate" name="startDate" readonly v-model="model.startDate"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="structure" class="control-label col-lg-2">{{ $t('structure') }}</label>
                                    <div class="col-lg-10">
                                        <select class="form-control"
                                                id="structure"
                                                name="structure"
                                                v-model="model.structure"
                                        >
                                            <option value="" disabled>{{ $t('please_choose_an_option') }}</option>
                                            <option v-for="agency in agencies">{{agency.value}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="observation" class="control-label col-lg-2">{{ $t('intervention_and_observation') }}</label>
                                    <div class="col-lg-6">
                                        <textarea
                                                  class="form-control "
                                                  id="observation"
                                                  name="observation"
                                                  ref="input" :style="inputStyle"
                                                  v-model="model.observation">
                                        </textarea>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-theme" type="button" @click="openModalConfig">{{ $t('configure_observation') }}</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                      <button class="btn btn-theme" type="button" @click="post">{{ $t('add') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form-panel -->
                </div>
                <!-- /col-lg-12 -->
            </div>
            <!-- /row -->
        </section>
        <!-- /wrapper -->
    </section>
</template>

<script>
    import Vue from 'vue';
    import moment from "moment";
    import InterventionConfig from "./InterventionConfig";
    import VueModal from '@kouts/vue-modal'
    import '@kouts/vue-modal/dist/vue-modal.css'
    Vue.component('Modal', VueModal)
    export default {
        name: "InterventionNew",
        components: {
            InterventionConfig, 'Modal': VueModal
        },
        methods: {
            post: function () {
                const axios = require('axios');
                let self = this;
                const config = {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json'
                    }
                };
                axios.post('/api/interventions/post', self.model, config)
                    .then(response => {
                            Vue.$toast.open({
                                message: this.$t('added_successfully'),
                                type: 'success',
                                position: 'top-right',
                                autohide: 3000 ,
                                class: "p-3 mb-2 bg-info text-white"
                            });
                            self.model.structure = '';
                            self.model.observation = '';
                            self.model.number = self.model.number + 1 ;
                        }
                        , (error) => {
                            if(this.model.observation === ''){
                                Vue.$toast.open({
                                    message: this.$t('required_observation_field'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }else {
                                Vue.$toast.open({
                                    message: this.$t('add_error'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }
                        }
                    );
            },
            set: function () {
                const axios = require('axios');
                let self = this;
                axios.get('/api/interventions/list')
                    .then(function (response) {
                        // handle success
                        let interventions = response.data.interventions;
                        let numbers = interventions.map(d => d.number);
                        if (numbers.length > 0) {
                            self.model.number = Math.max.apply(Math, numbers) + 1;
                        } else {
                            self.model.number = 100;
                        }
                    });
                self.model.startDate = self.formatDate(moment())
            },
            formatDate: function (value) {
                return this.$options.filters.formatDate(value, 'fr');
            },
            getOptions: async function () {
            const axios = require('axios');
            let response = await axios.get('/api/agencies/list');
            return response.data.map(
                function (agency) {
                    agency['label'] = agency.name.concat(' ','(',agency.code,')')
                    agency['value'] = agency.name.concat(' ','(',agency.code,')')
                    return agency;
                }
            );
        },
            openModalConfig: function () {
                if(this.model.structure === ''){
                    this.showModalConfig = false;
                    Vue.$toast.open({
                        message: this.$t('please_choose_an_agency'),
                        type: 'error',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                    });
                }else{
                    this.showModalConfig = true;
                }
        },
            resize () {
                this.inputHeight = `${this.$refs.input.scrollHeight}px`
            }
        },
        mounted: async function() {
            this.set();
            this.agencies = await this.getOptions();
            this.$root.$on('observation',(data)=>{
                this.model.observation = this.model.observation + '\n' + '*' + data
            });
            this.$root.$on('close',()=>{
                this.showModalConfig = false
            });
            this.resize()
        },
        data () {
            return {
                showModalConfig: false,
                model: {
                    number: '',
                    startDate: '',
                    structure: '',
                    observation: '',
                },
                agencies: [],
                simpleDialog: false,
                observation: '',
                inputHeight: '0',
                title: this.$t('configure_intervention')
            }
        },
        watch: {
            observation () {
                this.resize()
                this.$emit('input', this.observation)
            }
        },
        computed: {
            inputStyle () {
                return {
                    'min-height': this.inputHeight
                }
            }
        },
    };
</script>
<style>
    textarea {
        padding: 8px;
        border: 1px solid #aeaeae;
        resize: none;
        overflow: hidden;
        font-size: 16px;
    }
</style>