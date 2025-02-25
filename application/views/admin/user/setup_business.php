<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <?php $this->load->view('admin/include/breadcrumb'); ?>

    <!-- Ajuste de CSS para essa página de setup -->
    <style>
        nav.main-header.navbar.navbar-expand.navbar-white.navbar-light {
            display: none !important;
        }
        aside.main-sidebar.sidebar-dark-primary.elevation-4.overflow-auto {
            display: none !important;
        }
        .content-wrapper {
            margin-left: 0px !important;
        }
        .feature-steps {
            display: none !important;
        }
        label.text-danger.text-setup-page-lrv {
            font-size: 12px !important;
        }
        .card-header.card-lrv-setup {
            display: flex !important;
            flex-direction: column !important;
        }
    </style>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
           
            <div class="col-lg-9 pl-3">
                <form method="post" action="<?php echo base_url('admin/dashboard/update_setup') ?>">
                    <div class="card">
                        <div class="card-header card-lrv-setup">
                          <h5 class="card-title"><?php echo trans('setup-business') ?></h5>
                            <div class="form-group mb-2">
                                <label class="text-danger text-setup-page-lrv">Complete seu cadastro para continuar!</label>  
                            </div>
                        </div>

                        <div class="card-body">
                          <div class="row p-35">
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label class="mb-1"><?php echo trans('company-slug-restrict') ?> <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <?php $parse = parse_url(base_url()) ?>
                                        <div class="input-group-prepend">
                                          <div class="input-group-text"><?php echo $parse['host']; ?>/</div>
                                        </div>
                                        <input type="text" id="user-name" name="company_slug" class="form-control slug_input" autocomplete="off" required>
                                    </div>
                                </div>
                                
                                <div class="loader"></div>
                                
                                <p class="text-danger fs-14 mt-0 mb-0" id="name_illegal" style="display: none;"><i class="icon-close"></i> <?php echo trans('illegal-characters-title') ?></p>
                                <p class="text-danger fs-14 mt-0 mb-0" id="name_exist" style="display: none;"><i class="icon-close"></i> <?php echo trans('name-is-already-taken') ?>.</p>
                                <p class="text-success fs-14 mt-0 mb-0" id="name_available" style="display: none;"><i class="icon-check"></i> <?php echo trans('name-is-available') ?>.</p>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label class="mb-1"><?php echo trans('company-name') ?> <span class="text-danger">*</span></label>
                                    <input type="text" required class="form-control name_input" name="company_name" placeholder="<?php echo trans('name-of-your-company') ?>">
                                </div>

                                <p class="text-danger fs-14 mt-0 mb-2" id="name_illegal_2" style="display: none;"><i class="icon-close"></i> <?php echo trans('illegal-characters-title') ?></p>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-1"><?php echo trans('categories') ?> <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control" required>
                                        <option value=""> <?php echo trans('select') ?></option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo html_escape($category->id)?>"> <?php echo html_escape($category->name)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                          </div>
                        </div>

                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?php echo html_escape(user()->id); ?>">
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn btn-primary setup_bbtn" disabled> <?php echo trans('submit') ?></button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
