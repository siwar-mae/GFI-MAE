<template>
    <!-- Your HTML tags-->
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> {{ $t('user_management') }}</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <h4><i class="fa fa-angle-right"></i> {{ $t('add_user') }} </h4>
                    <div class="form-panel">
                        <div class="form">
                            <form class="cmxform form-horizontal style-form" id="signupForm" @submit.prevent="post">
                                <div class="form-group">
                                    <label for="email" class="control-label col-lg-2">{{ $t('email') }} : </label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" id="email" name="email" type="email" v-model="model.email"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">{{ $t('role') }} : </label>
                                    <div class="col-lg-10">

                                        <b-form-checkbox-group
                                            id="checkbox-group-2"
                                            v-model="model.roles"
                                            name="flavour-2"
                                        >
                                          <b-form-checkbox value="ROLE_ADMIN"> {{ $t('admin') }} </b-form-checkbox>
                                          <b-form-checkbox value="ROLE_USER"> {{ $t('user') }} </b-form-checkbox>
                                        </b-form-checkbox-group>

                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="fullanme" class="control-label col-lg-2">{{ $t('fullName') }} : </label>
                                <div class="col-lg-10">
                                  <input class=" form-control" id="fullanme" name="fullanme" type="text" v-model="model.fullName"/>
                                </div>
                              </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-theme" type="submit">{{ $t('add') }}</button>
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
    export default {
        name: "UserNew",
        components: {
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
                axios.post('/api/users/post', self.model, config)
                    .then(response => {
                            Vue.$toast.open({
                                message: this.$t('added_successfully'),
                                type: 'success',
                                position: 'top-right',
                                autohide: 3000 ,
                                class: "p-3 mb-2 bg-info text-white"
                            });
                            self.model.email = '';
                            self.model.fullName = '';
                            self.model.roles = '' ;
                        }
                        , (error) => {
                            if(this.model.email === ''){
                                Vue.$toast.open({
                                    message: this.$t('required_email_field'),
                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }else if(this.model.roles === '') {
                              Vue.$toast.open({
                                message: this.$t('required_role_field'),
                                type: 'error',
                                position: 'top-right',
                                autohide: 3000 ,
                                class: "p-3 mb-2 bg-info text-white"
                              })
                            }else if(this.model.fullName === '') {
                              Vue.$toast.open({
                                message: this.$t('required_fullName_field'),
                                type: 'error',
                                position: 'top-right',
                                autohide: 3000 ,
                                class: "p-3 mb-2 bg-info text-white"
                              })
                            }else {
                                Vue.$toast.open({

                                    type: 'error',
                                    position: 'top-right',
                                    autohide: 3000 ,
                                    class: "p-3 mb-2 bg-info text-white"
                                });
                            }
                        }
                    );
            },
        },
        mounted: async function() {
        },
        data () {
            return {
                model: {
                    email: '',
                    fullName: '',
                    address: '',
                    thumbnail: '',
                    roles: [],
                },
            }
        },
        watch: {
        },
        computed: {
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