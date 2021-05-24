<template>
    <div style="margin: 10px">
        <Modal v-model="showModalType" :title=this.title1 size="xl">
            <TypeNew></TypeNew>
        </Modal>
        <Modal v-model="showModalEquipement" :title=this.title2 size="xl">
            <EquipementNew></EquipementNew>
        </Modal>
        <form class="cmxform form-horizontal style-form" id="signupForm">
            <div class="form-group ">
                <label for="type" class="control-label col-lg-4">{{ $t('type_of_intervention') }}</label>
                <div class="col-lg-6">
                    <select class="form-control " id="type" name="type" v-model="type">
                        <option value="" disabled>{{ $t('please_choose_an_option') }}</option>
                        <option v-for="type in types">{{type.value}}</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-theme" type="button" @click="openModalType">
                        <i class="fa fa-plus"></i>
                    </button>
                 </div>
            </div>
            <div class="form-group ">
                <label for="equipement" class="control-label col-lg-4">{{ $t('equipement') }}</label>
                <div class="col-lg-6">
                    <select class="form-control " id="equipement" name="equipement" v-model="equipement">
                        <option value="" disabled>{{ $t('please_choose_equipment') }}</option>
                        <option v-for="equipement in equipements">{{equipement.value}}</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-theme" type="button" @click="openModalEquipement">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="form-group ">
                <label for="observation" class="control-label col-lg-4">{{ $t('intervention_and_observation') }}</label>
                <div class="col-lg-8">
                    <input class="form-control " id="observation" name="observation" v-model="model.observation"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <button class="btn btn-theme" type="button" @click="postAndReturn">{{ $t('add_and_return') }}</button>
                        <button class="btn btn-theme" type="button" @click="postAndContinue">{{ $t('add_and_create') }}</button>
                        <button class="btn btn-theme04" type="button" @click="close">{{ $t('cancel') }}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
    import Vue from 'vue';
    import TypeNew from "../type/TypeNew";
    import EquipementNew from "../equipement/EquipementNew";
    export default {
        name: "InterventionConfig",
        components: {EquipementNew, TypeNew},
        mounted: async function() {
            this.types = await this.getOptions();
            this.equipements = await this.getOptionsEquipement();
            this.agency.substr(this.agency.indexOf('(') + 1, 3);
            this.$root.$on('cancel',()=>{
                this.showModalType = false
            });
            this.$root.$on('cancel',()=>{
                this.showModalEquipement = false
            });
            this.$root.$on('types',(data)=>{
                this.types = data;
            });

            this.$root.$on('equipements',(data)=>{
                this.equipements = data;
            });
        },
        data () {
            return {
                types: [],
                equipements: [],
                model: {
                    type: '',
                    equipement: '',
                    observation: ''
                },
                type: '',
                equipement: '',
                showModalType: false,
                showModalEquipement: false,
                title1: this.$t('add_type_of_intervention'),
                title2: this.$t('add_equipment')
            }
        },
        props: {
            agency: String,
        },
        created() {
          this.$root.$refs.InterventionConfig = this;
        },
        methods: {
            getOptions: async function () {
                const axios = require('axios');
                let response = await axios.get('/api/types/list');
                this.types = response.data
                return response.data.map(
                    function (type) {
                        type['label'] = type.description
                        type['value'] = type.description
                        return type;
                    }
                );
            },

            getOptionsEquipement: async function(){
                const config = {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json'
                    }
                };
                const axios = require('axios');
                let responseEquipements = await axios.get('/api/equipements/list', {
                    params: {
                        'code': this.agency
                    },config
                });
                return responseEquipements.data.map(
                    function (equipement) {
                        equipement['label'] = equipement.designation.concat(' ','(',equipement.reference,')')
                        equipement['value'] = equipement.designation.concat(' ','(',equipement.reference,')')
                        return equipement;
                    }
                );
            },

            post: function () {
                if(this.type === ''){
                    Vue.$toast.open({
                        message: this.$t('please_fill_in_type_fields'),
                        type: 'error',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                    });
                }else if(this.equipement === ''){
                    Vue.$toast.open({
                        message: this.$t('required_equipment_field'),
                        type: 'error',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                    });
                }else if(this.observation === ''){
                    Vue.$toast.open({
                        message: this.$t('required_observation_field'),
                        type: 'error',
                        position: 'top-right',
                        autohide: 3000 ,
                        class: "p-3 mb-2 bg-info text-white"
                    });
                }
               this.$root.$emit('observation', this.model.observation);
            },

            postAndReturn: function () {
                this.post();
                this.close()
            },

            postAndContinue: function () {
                this.post();
                this.type = '';
                this.model.observation = '';
                this.equipement = '';
            },
            openModalType: function () {
                this.showModalType = true;
            },
            close: function () {
                this.$root.$emit('close');
            },
            openModalEquipement: function () {
                this.showModalEquipement = true;
            },
        },
        watch: {
            type: function (val) {
                this.model.observation =  this.equipement + ' : ' + val
            },
            equipement: function (val) {
                this.model.observation = this.type + ' : ' + val
            },

        },
    }
</script>

<style scoped>

</style>