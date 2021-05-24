<template>
    <div style="margin: 10px">
        <form class="cmxform form-horizontal style-form" id="signupForm">
            <div class="form-group ">
                <label for="ref" class="control-label col-lg-4">{{ $t('reference') }} : </label>
                <div class="col-lg-8">
                    <input class="form-control " id="ref" name="type" v-model="model.ref"/>
                </div>
            </div>
            <div class="form-group ">
                <label for="designation" class="control-label col-lg-4">{{ $t('designation') }} : </label>
                <div class="col-lg-8">
                    <input class="form-control "
                           id="designation"
                           name="designation"
                           v-model="model.designation"/>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label col-lg-4">{{ $t('price') }} : </label>
                <div class="col-lg-8">
                  <currency-input
                      class="form-control"
                      v-model="model.price"
                      currency="TND"
                      locale="tn"
                  />
                </div>
            </div>
            <div class="form-group ">
                <label for="nature" class="control-label col-lg-4">{{ $t('nature') }} : </label>
                <div class="col-lg-8">
                    <select class="form-control " id="nature" name="type" v-model="model.nature">
                        <option value="" disabled>{{ $t('please_choose_an_option') }}</option>
                        <option value="software">Software</option>
                        <option value="hardware">Hardware</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <button class="btn btn-theme" type="button" @click="postAndReturn">{{ $t('add_and_return') }}</button>
                        <button class="btn btn-theme" type="button" @click="postAndContinue">{{ $t('add_and_return') }}</button>
                        <button class="btn btn-theme04" type="button" @click="cancel">{{ $t('add_and_return') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { CurrencyInput } from 'vue-currency-input'
import Vue from 'vue';

export default {
        name: "EquipementNew",
        components: { CurrencyInput },
        data () {
            return {
                model: {
                    ref: '',
                    price: 0,
                    designation: '',
                    nature: '',
                    agency: '',
                },
                equipements: [],
            }
        },
        methods: {
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
                        'code': this.model.agency
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
            cancel: function () {
                this.$root.$emit('cancel')
            },
            post: function () {
                const axios = require('axios');
                let self = this;
                const config = {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json'
                    }
                };
                axios.post('/api/equipements/post', self.model, config)
                    .then(response => {
                            Vue.$toast.open({
                              message: $t('added_successfully'),
                                type: 'success',
                                position: 'top-right',
                                autohide: 3000 ,
                                class: "p-3 mb-2 bg-info text-white"
                            });
                        }
                        , (error) => {
                            if(self.model.ref === ''){
                                Vue.$toast.open({
                                    message: $t('required_reference_field'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }else if(self.model.designation === ''){
                                Vue.$toast.open({
                                    message: $t('required_designation_field'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }else if(self.model.price === 0){
                                Vue.$toast.open({
                                    message: $t('required_price_field'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }
                            else if(self.model.nature === ''){
                                Vue.$toast.open({
                                    message: $t("required_nature_field"),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }else {
                                Vue.$toast.open({
                                  message: $t('add_error'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }
                        }
                    );
            },
            postAndContinue: async function () {
                this.post();
                this.equipements = await this.getOptionsEquipement();
                this.$root.$emit('equipements', this.equipements);
                this.model.designation = '';
                this.model.price = 0;
                this.model.ref = '';
                this.model.nature = '';
            },
            postAndReturn: async function () {
                this.post();
                this.equipements = await this.getOptionsEquipement();
                this.$root.$emit('equipements', this.equipements);
                this.cancel()
            },
        },
        mounted() {
            this.model.agency = this.$root.$refs.InterventionConfig.agency;
            this.model.agency.substr(this.model.agency.indexOf('(') + 1, 3);
        }
    }
</script>

<style scoped>

</style>