<template>
  <section id="main-content">
    <section class="wrapper site-min-height">
      <div class="col-lg-12 mt">
      <div class="row content-panel">
        <div class="panel-heading">
          <ul class="nav nav-tabs nav-justified">
            <li>
              <h4>{{ $t('edit_profile') }}</h4>
            </li>
          </ul>
        </div>
        <!-- /panel-heading -->
        <div class="panel-body">
          <div class="tab-content">
            <!-- /tab-pane -->
            <!-- /tab-pane -->
            <div id="edit" class="tab-pane active">
              <div class="row">
                <div class="col-lg-8 col-lg-offset-2 detailed">
                  <h4 class="mb">{{ $t('personal_information') }}</h4>
                  <br>
                  <form role="form" class="form-horizontal" @submit.prevent="put">
                    <div class="form-group">
                      <label class="col-lg-2 control-label">{{ $t('avatar') }}</label>
                      <div class="col-lg-6">
                        <input type="file" id="exampleInputFile" class="file-pos" @change="previewFiles">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">{{ $t('fullName') }}</label>
                      <div class="col-lg-6">
                        <input type="text" placeholder=" " id="c-name" class="form-control" v-model="model.fullName">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">{{ $t('role') }}</label>
                      <div class="col-lg-6">
                        <select class="form-control " id="nature" name="type" v-model="model.role">
                          <option value="" disabled>{{ $t('please_choose_an_option') }}</option>
                          <option value="ROLE_ADMIN">{{ $t('admin') }}</option>
                          <option value="ROLE_USER">{{ $t('user') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">{{ $t('address') }}</label>
                      <div class="col-lg-6">
                        <input type="text" placeholder=" " id="addr" class="form-control" v-model="model.address">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">{{ $t('email') }}</label>
                      <div class="col-lg-6">
                        <input type="text" placeholder=" " id="email" class="form-control" v-model="model.email">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-theme" type="submit">{{ $t('save') }}</button>
                        <button class="btn btn-theme04" type="button">{{ $t('cancel') }}</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /col-lg-8 -->
              </div>
              <!-- /row -->
            </div>
            <!-- /tab-pane -->
          </div>
          <!-- /tab-content -->
        </div>
        <!-- /panel-body -->
      </div>
      <!-- /col-lg-12 -->
      </div>
      <!-- /container -->
    </section>
    <!-- /wrapper -->
  </section>
</template>

<script>
import Vue from "vue";

export default {
  name: "UserEdit",
  props: {
    fullName: String,
    email: String,
    address: String,
    role: String,
    id: String,
    thumb: String
  },
  mounted() {
    this.model.fullName = this.fullName;
    this.model.email = this.email;
    this.model.address = this.address;
    this.model.role = this.role;
    this.model.id = this.id;
    this.model.thumb = this.thumb;
  },
  data () {
    return {
      model: {
        email: '',
        fullName: '',
        role: '',
        address: '',
        id: '',
        thumb: ''
      },
    }
  },
  methods: {
    put: function () {
      const axios = require('axios');
      let self = this;
      const config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      };
      axios.put('/api/users/put', self.model, config)
          .then(response => {
                Vue.$toast.open({
                  message: this.$t('updated_successfully'),
                  type: 'success',
                  position: 'top-right',
                  autohide: 3000 ,
                  class: "p-3 mb-2 bg-info text-white"
                });
              }
              , (error) => {
                  Vue.$toast.open({
                    message: this.$t('update_error'),
                    type: 'error',
                    position: 'top-right',
                    autohide: 3000 ,
                    class: "p-3 mb-2 bg-info text-white"
                  });
              }
          );
    },
    previewFiles(event) {
        this.model.thumb = event.target.files[0].name
    }
  },
}
</script>

<style scoped>

</style>


