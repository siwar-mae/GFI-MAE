<template>
    <div style="margin: 10px">
        <form class="cmxform form-horizontal style-form" id="signupForm">
            <div class="form-group ">
                <label for="type" class="control-label col-lg-4">Saisir type : </label>
                <div class="col-lg-8">
                    <input class="form-control " id="type" name="type" v-model="type" placeholder="Type"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <button class="btn btn-theme" type="button" @click="postAndReturn">Ajouter Et Revenir</button>
                        <button class="btn btn-theme" type="button" @click="postAndContinue">Ajouter Et Continuer</button>
                        <button class="btn btn-theme04" type="button" @click="cancel">Annuler</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Vue from 'vue';
    export default {
        name: "TypeNew",
        methods: {
            getOptions: async function () {
                const axios = require('axios');
                let response = await axios.get('/api/types/list');

                return response.data.map(
                    function (type) {
                        type['label'] = type.description
                        type['value'] = type.description
                        return type;
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
                axios.post('/api/types/post', {type: self.type}, config)
                    .then(response => {
                            Vue.$toast.open({
                                message: 'Ajout effectué avec succès!',
                                type: 'success',
                                position: 'top-right',
                                autohide: 3000 ,
                                class: "p-3 mb-2 bg-info text-white"
                            });
                        }
                        , (error) => {
                            if(self.type === ''){
                                Vue.$toast.open({
                                    message: "Veuillez remplir champs type !",
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }else {
                                Vue.$toast.open({
                                    message: "Erreur d'ajout!",
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
              this.types = await this.getOptions();
              this.$root.$emit('types', this.types);
              this.type = '';
            },
            postAndReturn: async function () {
                this.post();
                this.types = await this.getOptions()
                this.$root.$emit('types', this.types);
                this.cancel()
            },
        },
        data () {
            return {
                type: '',
                types: [],
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>