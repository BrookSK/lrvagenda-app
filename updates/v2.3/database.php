<?php
session_start();
error_reporting(1);

$db_config_path = '../application/config/database.php';

if (!isset($_SESSION["license_code"])) {
    $_SESSION["error"] = "Invalid purchase code!";
    header("Location: index.php");
    exit();
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {
        
        mysqli_query($connection, "UPDATE settings SET version = '2.3' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `customers` ADD `time_zone` VARCHAR(155) NULL AFTER `gender`;");
        mysqli_query($connection, "ALTER TABLE `services` ADD `enable_service_extra` INT NULL DEFAULT '0' AFTER `google_meet`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `auth_type` VARCHAR(20) NULL DEFAULT NULL AFTER `parent_id`, ADD `auth_id` VARCHAR(30) NULL DEFAULT NULL AFTER `auth_type`, ADD `device_1` TEXT NULL DEFAULT NULL AFTER `auth_id`, ADD `device_2` TEXT NULL DEFAULT NULL AFTER `device_1`;");

        mysqli_query($connection, "ALTER TABLE `settings` CHANGE `global_ultramsg` `global_wapp_msg` INT(11) NULL DEFAULT '0';");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `whatsapp_type` VARCHAR(20) NULL DEFAULT 'ultramsg' AFTER `enable_whatsapp_msg`, ADD `wazfy_instance_id` VARCHAR(50) NULL DEFAULT NULL AFTER `whatsapp_type`, ADD `wazfy_token` VARCHAR(50) NULL DEFAULT NULL AFTER `wazfy_instance_id`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `whatsapp_type` VARCHAR(20) NULL DEFAULT 'ultramsg' AFTER `enable_whatsapp_msg`, ADD `wazfy_instance_id` VARCHAR(50) NULL DEFAULT NULL AFTER `whatsapp_type`, ADD `wazfy_token` VARCHAR(50) NULL DEFAULT NULL AFTER `wazfy_instance_id`;");

        mysqli_query($connection, "UPDATE `lang_values` SET `label` = 'Ultramsg', `keyword` = 'ultramsg', `english` = 'Ultramsg' WHERE `lang_values`.`keyword` = 'ultramsg-api';");

        mysqli_query($connection, "ALTER TABLE `services` ADD `service_type` INT NOT NULL DEFAULT '1' AFTER `details`, ADD `number_of_service` VARCHAR(255) NULL AFTER `service_type`, ADD `service_repeat` VARCHAR(255) NULL AFTER `number_of_service`;");

        mysqli_query($connection, "ALTER TABLE `appointments` ADD `is_recurring` INT NOT NULL DEFAULT '0' AFTER `sync_calendar_user`, ADD `recurring_count` INT NOT NULL DEFAULT '0' AFTER `is_recurring`, ADD `next_recur_date` VARCHAR(255) NULL AFTER `recurring_count`, ADD `is_completed` INT NOT NULL DEFAULT '0' AFTER `next_recur_date`;");

        mysqli_query($connection, "ALTER TABLE `services` ADD `service_extra` VARCHAR(255) NULL AFTER `google_meet`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `pwa_logo` VARCHAR(155) NULL AFTER `link`, ADD `enable_pwa` INT NULL DEFAULT '0' AFTER `pwa_logo`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `custom_css` LONGTEXT NULL DEFAULT NULL AFTER `about_info`;");

        mysqli_query($connection, "ALTER TABLE `appointments` ADD `service_extra` VARCHAR(255) NULL DEFAULT NULL AFTER `service_id`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `remember_me_token` VARCHAR(155) NULL DEFAULT NULL AFTER `slug`;");


        // import database table
        $query = '';
          $sqlScript = file('sql/system_settings.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        // import database table
        $query = '';
          $sqlScript = file('sql/custom_form.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/custom_form_answer.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/service_extra.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }



        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Custom Form', 'custom-form', 'Custom Form'),
        ('user', 'Input Title', 'input-title', 'Input Title'),
        ('user', 'Input Name', 'input-name', 'Input Name'),
        ('user', 'Input Type', 'input-type', 'Input Type'),
        ('user', 'Input required or not', 'input-required-or-not', 'Input required or not'),
        ('user', 'New Input', 'new-input', 'New Input'),
        ('user', 'Custom Forms', 'custom-forms', 'Custom Forms'),
        ('user', 'Add new input', 'add-new-input', 'Add new input'),
        ('user', 'Select input type', 'select-input-type', 'Select input type'),
        ('user', 'text', 'text', 'Text'),
        ('user', 'Textarea', 'textarea', 'Textarea'),
        ('user', 'Is this required ?', 'is-required', 'Is this required ?'),
        ('user', 'Additional Info', 'additional-info', 'Additional Info'),
        ('user', 'Service Extra', 'service-extra', 'Service Extra'),
        ('user', 'Wazfy', 'wazfy', 'Wazfy'),
        ('user', 'Extra Service', 'extra-service', 'Extra Service'),
        ('user', 'Service Type', 'service-type', 'Service Type'),
        ('user', 'Recurring Service', 'recurring-sevice', 'Recurring Service'),
        ('user', 'One of Service', 'one-of-service', 'One of Service'),
        ('user', 'Number of Service', 'number-of-service', 'Number of Services'),
        ('user', 'Repeats In', 'repeats-in', 'Repeats In'),
        ('user', 'Repeats Weekly', 'repeats-weekly', 'Repeats Weekly'),
        ('user', 'Repeats Monthly', 'repeats-monthly', 'Repeats Monthly'),
        ('user', 'Recurring Service', 'recurring-service', 'Recurring Service'),
        ('user', 'Recurring', 'recurring', 'Recurring'),
        ('user', 'One Time Service', 'one-time-service', 'One Time Service'),
        ('user', 'Service repeats weekly', 'service-repeats-weekly', 'Service repeats weekly'),
        ('user', 'Service repeats monthly', 'service-repeats-monthly', 'Service repeats monthly'),
        ('user', 'Recurring-info', 'recurring-info', 'Recurring-info'),
        ('user', 'Repeated in ', 'repeated-in', 'Repeated in '),
        ('user', 'Next', 'next', 'Next'),
        ('user', 'Recurring Count', 'recurring-count', 'Recurring Count'),
        ('user', 'Booked service extra', 'booked-service-extra', 'Booked service extra'),
        ('user', 'Disable service extra', 'disable-service-extra', 'Disable service extra'),
        ('user', 'Enable service extra', 'enable-service-extra', 'Enable service extra'),
        ('user', 'PWA Settings', 'pwa-settings', 'PWA Settings'),
        ('user', 'Enable PWA (Progressive Web Apps)', 'enable-pwa', 'Enable PWA (Progressive Web Apps)'),
        ('user', 'Enable to allow your users to install PWA on their phone', 'pwa-enable-title', 'Enable to allow your users to install PWA on their phone'),
        ('user', 'mage dimensions should not exceed 512 x 512 pixels.', 'pwa-logo-size-alert', 'mage dimensions should not exceed 512 x 512 pixels.'),
        ('user', 'Install PWA', 'install-pwa', 'Install PWA'),
        ('user', 'Custom CSS', 'custom-css', 'Custom CSS'),
        ('user', 'Add your custom css code here', 'add-your-own-css-code-here', 'Add your custom css code here'),
        ('user', 'Required', 'required', 'Required'),
        ('user', 'Custom Inputs', 'custom-inputs', 'Custom Inputs'),
        ('user', 'Setup Business', 'setup-business', 'Setup Business'),
        ('user', 'Redirect URL', 'redirect-url', 'Redirect URL'),
        ('user', 'Google', 'google', 'Google'),
        ('user', 'Facebook App ID', 'facebook-app-id', 'Facebook App ID'),
        ('user', 'Facebook App Secret', 'facebook-app-secret', 'Facebook App Secret'),
        ('user', 'Graph Version', 'graph-version', 'Graph Version'),
        ('user', 'Social Login', 'social-login', 'Social Login'),
        ('user', 'Continue With Google', 'continue-with-google', 'Continue With Google'),
        ('user', 'Continue With Facebook', 'continue-with-facebook', 'Continue With Facebook'),
        ('user', 'Remember me', 'remember-me', 'Remember Me'),
        ('user', 'Integration docs', 'integration-docs', 'Integration docs');");

            
      /* close connection */
      mysqli_close($connection);

      $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://" . $_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $redir = str_replace('updates/v2.3/', '', $redir);
      header("refresh:5;url=" . $redir);
      $success = 1;
    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aoxio &bull; Update Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2">

                <div class="row">
                    <div class="col-sm-12 logo-cnt">
                        <p>
                           <img src="assets/img/logo.png" alt="">
                       </p>
                       <h1>Welcome to the Update Installer</h1>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                            <div class="alert alert-danger">
                                <strong><?php echo htmlspecialchars($message); ?></strong>
                            </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                            <div class="alert alert-success">
                                <strong>Completing Updates ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 second </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

