<!DOCTYPE html>
<html lang="en" dir="<?php echo text_dir(); ?>">

<head>

    <!-- Title  -->
    <?php $settings = get_settings(); ?>
    <title><?php echo lang_value()->site_name ?> &bull; <?php if(isset($page_title)){echo trans(strtolower($page_title)).' &bull; ';} ?>  <?php echo lang_value()->site_title ?></title>
    <!-- Metas -->
    <meta charset="utf-8">
    <?php if (isset($page) && $page == 'Company'): ?>
    <meta name="author" content="<?php echo html_escape($company->name) ?>">
    <meta name="description" content="<?php echo html_escape($company->description) ?>">
    <meta name="keywords" content="<?php echo html_escape($company->keywords) ?>">
    <?php else: ?>
    <meta name="author" content="<?php echo lang_value()->site_name ?>">
    <meta name="description" content="<?php echo lang_value()->description ?>">
    <meta name="keywords" content="<?php echo lang_value()->keywords ?>">
    <?php endif ?>


    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta name="theme-color" content="#286efb" />
    <meta name="msapplication-navbutton-color" content="#286efb" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#286efb" />

    <!-- Favicons-->
    <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
    <link rel="apple-touch-icon" href="<?php echo base_url($settings->favicon) ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url($settings->favicon) ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url($settings->favicon) ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.ico">


    <!-- CSS Libs  -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/libs/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/libs/jarallax/dist/jarallax.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/libs/owl-carousel/dist/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/libs/owl-carousel/dist/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/fonts/bootstrap/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/line-icons/lineicons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/daterangepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/lightbox.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">


    <!-- Template CSS -->
    <link href="<?php echo base_url() ?>assets/front/css/template.min.css?var=<?= settings()->version ?>&time=<?=time();?>" rel="stylesheet">



    <?php if(settings()->enable_animation == 1): ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/aos.css">
    <?php endif; ?>

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/select2/css/select2.min.css">
    <!-- nice-select -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/nice-select.css">
    <!-- date & time picker -->
    <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/admin/css/timepicker.min.css" rel="stylesheet">



    <?php if (isset($page_title) && $page_title == 'Register'): ?>
    <link href="<?php echo base_url() ?>assets/front/css/intelInput.css" rel="stylesheet">
    <?php else: ?>
    <link href="<?php echo base_url() ?>assets/front/css/intlInputPhone.css" rel="stylesheet">
    <?php endif ?>

    <?php if (text_dir() == 'rtl'): ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/custom-rtl.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/bootstrap-rtl.min.css" crossorigin="anonymous">
    <?php endif ?>

    <!-- overwrite css -->

    <?php if($page == 'Company'): ?>
    <?php $font = get_by_id($company->font,'fonts')->name; ?>
    <?php $rgb = hex2rgb($company->color) ?>
    <link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $font); ?>:400,500,600,700" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/css/style-company-over.php?color=<?php echo html_escape($company->color); ?>&font=<?php echo str_replace(' ', '+', $font).'&rgb='.$rgb ?>" rel="stylesheet">
    <?php else: ?>
    <?php $rgb = hex2rgb(settings()->site_color) ?>
    <link href="<?php echo base_url() ?>assets/front/css/style-over.php?color=<?php echo settings()->site_color; ?>&rgb=<?php echo $rgb ?>" rel="stylesheet">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/libs/owl-carousel/dist/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/libs/owl-carousel/dist/css/owl.theme.default.min.css">

    <?php if (isset($company) && $company->template_style == 2): ?>
    <link href="<?php echo base_url() ?>assets/front/css/style2.css" rel="stylesheet">
    <?php endif ?>

    <!-- csrf token -->
    <script type="text/javascript">
    var csrf_token = '<?= $this->security->get_csrf_hash(); ?>';
    var token_name = '<?= $this->security->get_csrf_token_name();?>';
    </script>


    <?php if (!empty($settings->google_analytics)): ?>
    <?php echo base64_decode($settings->google_analytics) ?>
    <?php endif ?>

    <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php endif; ?>

    <style type="text/css">
        <?php echo json_decode(settings()->custom_css) ?>
    </style>

    <?php if (settings()->enable_pwa == 1): ?>
        <?php include 'pwa_config.php'; ?>
    <?php endif ?>


</head>

<body<?php if(isset($is_embed) && $is_embed == true){echo ' class="is-embed-no-bg"';} ?>>
<!-- main wrapper -->
<div class="main-wrapper">

<!-- header -->
<?php if (isset($menu) && $menu == TRUE): ?>
<header id="navbar">
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-whites py-3">
        <a class="navbar-brand" href="<?php echo base_url() ?>">
            <img width="120px" src="<?php echo base_url(settings()->logo) ?>" alt="logo">
        </a>

        <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>

        <!-- Menu -->
        <div id="navbarContent" class="collapse navbar-collapse mt-2">

            <ul class="navbar-nav align-items-lg-center ml-auto">

                <li class="nav-item xs-mb-10"><a href="<?php echo base_url() ?>" class="nav-link  <?php if(isset($page_title) && $page_title == "Home"){echo "active";} ?>"><?php echo trans('home') ?></a></li>
                
                <li class="nav-item xs-mb-10"><a href="<?php echo base_url('pricing') ?>" class="nav-link <?php if(isset($page_title) && $page_title == "Pricing"){echo "active";} ?>"><?php echo trans('pricing') ?></a></li>

                <?php if (settings()->enable_users == 1): ?>
                <li class="nav-item xs-mb-10"><a href="<?php echo base_url('companies') ?>" class="nav-link <?php if(isset($page_title) && $page_title == "Companies"){echo "active";} ?>"><?php echo trans('companies') ?></a></li>
                <?php endif ?>


                <?php if (settings()->enable_blog == 1): ?>
                <li class="nav-item xs-mb-10"><a href="<?php echo base_url('blogs') ?>" class="nav-link <?php if(isset($page_title) && $page_title == "Blogs"){echo "active";} ?>"><?php echo trans('blogs') ?></a></li>
                <?php endif ?>


                <?php if (settings()->enable_faq == 1): ?>
                <li class="nav-item xs-mb-10"><a href="<?php echo base_url('faqs') ?>" class="nav-link <?php if(isset($page_title) && $page_title == "Faqs"){echo "active";} ?>"><?php echo trans('faqs') ?></a></li>
                <?php endif ?>

                <li class="nav-item xs-mb-10"><a href="<?php echo base_url('contact') ?>" class="nav-link <?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>"><?php echo trans('contact') ?></a></li>

                <?php if (!empty(get_front_pages(0))): ?>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link dropdown-toggle"><?php echo trans('pages') ?></a>

                        <ul class="dropdown-menu shadow mt-1">
                            <?php foreach (get_front_pages(0) as $page): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php endif ?>

                <?php if (settings()->enable_multilingual == 1): ?>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link dropdown-toggle"><?php echo lang_short_form(); ?></a>

                        <ul class="dropdown-menu shadow mt-1">
                            <?php foreach (get_language() as $lang): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('home/switch_lang/'.$lang->slug) ?>"><?php echo html_escape($lang->name) ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php endif ?>

            </ul>

            <ul class="navbar-nav align-items-lg-center ml-lg-auto mt-0">
                <li class="nav-item mr-0">
                    <?php if (is_admin()): ?>
                        <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo base_url('auth/logout') ?>"><i class="lni lni-exit"></i> <?php echo trans('logout') ?> </a>

                        <a class="btn btn-sm btn-primary ml-auto" href="<?php echo base_url('admin/dashboard') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                    <?php elseif(is_customer()): ?>

                        <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo base_url('auth/logout') ?>"><i class="lni lni-exit"></i> <?php echo trans('logout') ?> </a>

                         <a class="btn btn-sm btn-primary ml-auto" href="<?php echo base_url('customer/appointments') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                    <?php elseif(is_staff()): ?>

                        <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo base_url('auth/logout') ?>"><i class="lni lni-exit"></i> <?php echo trans('logout') ?> </a>

                         <a class="btn btn-sm btn-primary ml-auto" href="<?php echo base_url('staff/appointments') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                    <?php elseif(is_user()): ?>

                        <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo base_url('auth/logout') ?>"><i class="lni lni-exit"></i> <?php echo trans('logout') ?> </a>

                        <?php $diff = date_difference(user()->created_at); ?>
                        <?php if (user()->email_verified == 0 && settings()->enable_email_verify == 1 && $diff < 2): ?>
                            <a class="btn btn-sm btn-warning ml-auto" href="<?php echo base_url('auth/verify?type=mail') ?>"><i class="fas fa-check-circle"></i> <?php echo trans('verify-account') ?></a>
                        <?php else: ?>
                            <a class="btn btn-sm btn-primary ml-auto" href="<?php echo base_url('admin/dashboard/user') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                        <?php endif ?>
                    <?php else: ?>
                        <a class="btn btn-sm btn-light ml-auto" href="<?php echo base_url('login') ?>"><?php echo trans('sign-in') ?></a>
                        <a class="btn btn-sm btn-primary ml-auto" href="<?php echo base_url('register') ?>"><?php echo trans('get-started') ?></a>
                    <?php endif ?>
                </li>
            </ul>

        </div>
        <!-- End Menu -->

    </nav>
</div>
</header>
<?php endif ?>


<?php if (isset($page) && $page == 'Company'): ?>
<header class="borderb-1 <?php if(isset($is_embed) && $is_embed == true){echo 'd-hide';} ?> <?php if (isset($page_title) && $page_title == 'Company Home'){echo 'position-absolute';} ?> left-0 top-0 w-100 <?php if (!empty($template) && $template == 5){echo "bg-white";} ?>">

<?php if (isset($company->template_style) && $company->template_style == 5): ?>
    <div class="header-top_area bg-dark py-1">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <ul class="list-unstyled social-icon p-0 m-0">
                        <?php if(!empty($company->facebook)): ?>
                            <li><a href="#!"><i class="text-white fs-14 fab fa-facebook-f"></i></a></li>
                        <?php endif ?>

                        <?php if(!empty($company->twitter)): ?>
                            <li><a href="#!"><i class="text-white fs-14 fab fa-twitter"></i></a></li>
                        <?php endif ?>

                        <?php if(!empty($company->instagram)): ?>
                            <li><a href="#!"><i class="text-white fs-14 fab fa-instagram"></i></a></li>
                        <?php endif ?>

                        <?php if(!empty($company->whatsapp)): ?>
                            <li><a href="#!"><i class="text-white fs-14 fab fa-whatsapp"></i></a></li>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="col-xl-6 col-md-6 text-md-right">
                    <div class="pt-0">
                        <?php if(!empty($company->email)): ?>
                            <span class="mr-3 text-muted"><a class="text-white fs-12" href="#"> <i class="bi bi-envelope icon mr-1"></i> <?php echo html_escape($company->email) ?></a></span>
                        <?php endif; ?>

                        <?php if(!empty($company->phone)): ?>
                            <span class="text-muted"><a class="text-white fs-12" href="#"> <i class="bi bi-telephone icon"></i> <?php echo html_escape($company->phone) ?></a></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($template) && $template == 5): ?>
    <?php 
        $text_color = 'text-dark';
        $navbg = 'bg-white';
        $py = '1';
    ?>
<?php else: ?>
    <?php 
        $text_color = '';
        $navbg = '';
        $py = '3';
    ?>
<?php endif ?>

<div class="container">
    <nav class="navbar navbar-expand-lg <?php echo $navbg ?> navbar-light py-<?php echo $py ?> <?php if (isset($company->template_style) && $company->template_style == 2){echo "hide";}?>">
        <a class="navbar-brand mr-lg-5" href="<?php if (isset($is_cdomain) && $is_cdomain == true){echo base_url();}else{echo base_url($slug);} ?>">
            <?php if (!empty($company->logo)):?>
                <img width="<?php echo html_escape($company->size) ?>" src="<?php echo base_url($company->logo) ?>" alt="logo">
            <?php else: ?>
                <span class="text-white company-name"><?php echo html_escape($company->name) ?></span>
            <?php endif; ?>
        </a>

        <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> <?php echo html_escape($text_color) ?> text-xs-black"><i class="fas fa-bars"></i></span>
        </button>

        <!-- Menu -->
        <div id="navbarContent" class="collapse navbar-collapse company mt-2">
            
            <ul class="navbar-nav align-items-lg-center ml-auto">
                <li class="nav-item"><a href="<?php if (isset($is_cdomain) && $is_cdomain == true){echo base_url();}else{echo base_url($slug);} ?>" class="nav-link text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> <?php echo html_escape($text_color) ?> text-xs-white <?php if(isset($page_title) && $page_title == "Home"){echo "active";} ?>"><?php echo trans('home') ?></a></li>
                
                <li class="nav-item"><a href="<?php echo base_url('services'.$slug) ?>" class="nav-link text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> <?php echo html_escape($text_color) ?> text-xs-white <?php if(isset($page_title) && $page_title == "Services"){echo "active";} ?>"><?php echo trans('services') ?></a></li>

                <li class="nav-item"><a href="<?php echo base_url('staffs'.$slug) ?>" class="nav-link text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> <?php echo html_escape($text_color) ?> text-xs-white <?php if(isset($page_title) && $page_title == "Staff"){echo "active";} ?>"><?php echo trans('staff') ?></a></li>
     
                <?php if (check_user_feature_access($company->user_id, 'gallery') == TRUE): ?>
                    <?php if ($company->enable_gallery == TRUE): ?>
                        <li class="nav-item"><a href="<?php echo base_url('gallery'.$slug) ?>" class="nav-link text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> <?php echo html_escape($text_color) ?> text-xs-white <?php if(isset($page_title) && $page_title == "Gallery"){echo "active";} ?>"><?php echo trans('gallery') ?></a></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty(get_pages($company->uid))): ?>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link dropdown-toggle <?php if (isset($page_title) && $page_title == 'Company Home'){echo 'text-white';} ?> <?php echo html_escape($text_color) ?>"><?php echo trans('pages') ?></a>

                        <ul class="dropdown-menu shadow mt-1">
                            <?php foreach (get_pages($company->uid) as $page): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('company/page/'.$slug.'/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php endif ?>

                <?php if (settings()->enable_multilingual == 1): ?>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link dropdown-toggle <?php if (isset($page_title) && $page_title == 'Company Home'){echo 'text-white';} ?> <?php echo html_escape($text_color) ?>"><?php echo lang_short_form(); ?></a>

                        <ul class="dropdown-menu shadow mt-1">
                            <?php foreach (get_language() as $lang): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('home/switch_lang/'.$lang->slug) ?>"><?php echo html_escape($lang->name) ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>

            <?php if (isset($is_cdomain) && $is_cdomain == true): ?>
                <?php $site_url = settings()->site_url.'/';?>
            <?php else: ?>
                <?php $site_url = base_url();?>
            <?php endif; ?>


            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item mr-0">
                    <?php if(is_user()): ?>
                        <a class="btn btn-sm btn-secondary ml-auto text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> text-xs-white" href="<?php echo prep_url($site_url.'auth/logout') ?>"><i class="icon-logout"></i> <?php echo trans('logout') ?> </a>

                         <a class="btn btn-sm btn-primary ml-auto" href="<?php echo prep_url($site_url.'admin/dashboard/user') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                    <?php elseif(is_customer()): ?>

                        <a class="btn btn-sm btn-secondary ml-auto" href="<?php echo prep_url($site_url.'auth/logout') ?>"><i class="lni lni-exit"></i> <?php echo trans('logout') ?> </a>

                         <a class="btn btn-sm btn-primary ml-auto" href="<?php echo prep_url($site_url.'customer/appointments') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                    <?php elseif(is_staff()): ?>

                        <a class="btn btn-sm btn-secondary ml-auto" href="<?php echo prep_url($site_url.'auth/logout') ?>"><i class="lni lni-exit"></i> <?php echo trans('logout') ?> </a>

                         <a class="btn btn-sm btn-primary ml-auto" href="<?php echo prep_url($site_url.'staff/appointments') ?>"><i class="icon-speedometer"></i> <?php echo trans('dashboard') ?></a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-secondary ml-auto text-<?php if (isset($page_title) && $page_title == 'Company Home'){echo 'white';} ?> text-xs-white" href="<?php echo prep_url($site_url.'login') ?>"><?php echo trans('sign-in') ?></a>
                        <a class="btn btn-sm btn-primary ml-auto" href="<?php echo prep_url($site_url.'register') ?>"><?php echo trans('get-started') ?></a>
                    <?php endif ?>
                </li>
            </ul>

        </div>
        <!-- End Menu -->

    </nav>
</div>
</header>
<?php endif ?>

