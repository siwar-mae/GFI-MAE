<template>
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> {{ $t('user_management') }}</h3>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> {{ $t('edit_user') }} </h4>
          <div class="form-panel">
            <div class="row mt">
              <div class="col-lg-12">
                <div class="row content-panel">
                  <div class="col-md-4 profile-text mt mb centered">
                    <div class="right-divider hidden-sm hidden-xs">
                      <h2> Welcome ! </h2>
                    </div>
                  </div>
                  <!-- /col-md-4 -->
                  <div class="col-md-4 profile-text">
                    <h2>{{ app.user.fullName }}</h2>
                    <h4>{{ app.user.roles[0] }}</h4>
                  </div>
                  <!-- /col-md-4 -->
                  <div class="col-md-4 centered">
                    <div class="profile-pic">
                      <p><img src="img/avatar.png" class="img-circle"></p>
                    </div>
                  </div>
                  <!-- /col-md-4 -->
                </div>
                <!-- /row -->
              </div>
              <!-- /col-lg-12 -->
              <div class="col-lg-12 mt">
                <div class="row content-panel">
                  <div class="panel-heading">
                    <ul class="nav nav-tabs nav-justified">
                      <li>
                        <h4>Edit Profile</h4>
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
                            <h4 class="mb">Personal Information</h4>
                            <form role="form" class="form-horizontal">
                              <div class="form-group">
                                <label class="col-lg-2 control-label"> Avatar</label>
                                <div class="col-lg-6">
                                  <input type="file" id="exampleInputFile" class="file-pos">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 control-label">FullName</label>
                                <div class="col-lg-6">
                                  <input type="text" placeholder=" " id="c-name" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 control-label">Role</label>
                                <div class="col-lg-6">
                                  <input type="text" placeholder=" " id="lives-in" class="form-control">
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="col-lg-8 col-lg-offset-2 detailed mt">
                            <h4 class="mb">Contact Information</h4>
                            <form role="form" class="form-horizontal">
                              <div class="form-group">
                                <label class="col-lg-2 control-label">Address</label>
                                <div class="col-lg-6">
                                  <input type="text" placeholder=" " id="addr" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                  <input type="text" placeholder=" " id="email" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                  <button class="btn btn-theme" type="submit">Save</button>
                                  <button class="btn btn-theme04" type="button">Cancel</button>
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
              <!-- /row -->
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
export default {
  name: "UserEdit"
}
</script>

<style scoped>

</style>