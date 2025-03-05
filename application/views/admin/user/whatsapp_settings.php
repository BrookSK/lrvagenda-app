<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <?php $this->load->view('admin/include/breadcrumb'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        
            <?php $this->load->view('admin/user/include/settings_menu.php'); ?>

            <div class="col-lg-9 pl-3">
                <div class="card">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_whatsapp') ?>" role="form" class="form-horizontal pl-20">


                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="custom-control custom-switch prefrence-item pt-10 ml-0 pl-3">
                                        <div class="custom-control custom-switch pt-10">
                                          <input type="checkbox" value="1" name="enable_whatsapp_msg" class="custom-control-input" id="switch-1" <?php if($this->business->enable_whatsapp_msg == 1){echo 'checked';} ?>>
                                          <label class="custom-control-label" for="switch-1"><?php echo trans('enable-booking-confirmation-sms') ?></label>
                                          <p class="small text-muted"><?php echo trans('enable-booking-con-title') ?>.</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                <div class="form-group mb-4">
                                  <label><?php echo trans('active') ?> <?php echo trans('whatsapp') ?> <?php echo trans('type') ?></label>
                                  <select name="whatsapp_type" class="form-control">
                                      <option value="ultramsg" <?php echo ('ultramsg' == $this->business->whatsapp_type) ? "selected" : ""; ?>><?php echo trans('ultramsg') ?></option>
                                      <option value="wazfy" <?php echo ('wazfy' == $this->business->whatsapp_type) ? "selected" : ""; ?>><?php echo trans('wazfy') ?></option>
                                  </select>
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="card-body">
                                  <div class="form-group">
                                    <p><a class="text-<?php if($this->business->whatsapp_type == 'ultramsg'){echo "primary";}else{echo "dark";} ?> fs-18 font-weight-bold" target="_blank" href="https://ultramsg.com"><?php echo trans('ultramsg') ?> <i class="lni lni-arrow-right"></i></a></p>
                                  </div>

                                  <div class="form-group">
                                    <label><?php echo trans('instance-id') ?></label>
                                      <input type="text" name="ultramsg_instance_id" value="<?php echo html_escape($this->business->ultramsg_instance_id); ?>" class="form-control" >
                                  </div>

                                  <div class="form-group">
                                    <label><?php echo trans('token') ?></label>
                                      <input type="text" name="ultramsg_token" value="<?php echo html_escape($this->business->ultramsg_token); ?>" class="form-control" >
                                  </div>
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="card-body">
                                  <div class="form-group">
                                    <p><a class="text-<?php if($this->business->whatsapp_type == 'wazfy'){echo "primary";}else{echo "dark";} ?> fs-18 font-weight-bold" target="_blank" href="https://wazfy.com"><?php echo trans('wazfy') ?> <i class="lni lni-arrow-right"></i></a></p>
                                  </div>

                                  <div class="form-group">
                                    <label><?php echo trans('instance-id') ?></label>
                                      <input type="text" name="wazfy_instance_id" value="<?php echo html_escape($this->business->wazfy_instance_id); ?>" class="form-control" >
                                  </div>

                                  <div class="form-group">
                                    <label><?php echo trans('token') ?></label>
                                      <input type="text" name="wazfy_token" value="<?php echo html_escape($this->business->wazfy_token); ?>" class="form-control" >
                                  </div>
                                </div>
                              </div>



                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                      <p>Whatsapp (<b><a class="text-success" target="_blank" href="https://ultramsg.com">Ultramsg API</a></b>)</p>
                                    </div>

                                    <div class="form-group">
                                      <label>Instance Id</label>
                                        <input type="text" name="ultramsg_instance_id" value="<?php echo html_escape($this->business->ultramsg_instance_id); ?>" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                      <label>Token</label>
                                        <input type="text" name="ultramsg_token" value="<?php echo html_escape($this->business->ultramsg_token); ?>" class="form-control" >
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?php echo html_escape(user()->id); ?>">
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn btn-primary mt-2"> <?php echo trans('save-changes') ?></button>
                        </div>
                    </form>
                    <!-- campo onde o usuário pode inserir a URL do webhook -->
                    <form method="post" action="<?= base_url('admin/settings/update_webhook_url'); ?>">
                      <label for="webhook_url">URL do Webhook</label>
                      <input type="text" name="webhook_url" value="<?= isset($user->webhook_url) ? $user->webhook_url : ''; ?>" required>
                      <button type="submit">Salvar Webhook</button>
                  </form>
                </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
