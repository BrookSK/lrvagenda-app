<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Serve dynamic company override CSS
    public function style_company_over()
    {
        header('Content-Type: text/css');
        // pass through to existing generator to keep styles consistent
        // expects $_GET['color'], $_GET['font'], $_GET['rgb']
        $path = FCPATH.'assets/front/css/style-company-over.php';
        if (file_exists($path)) {
            include $path;
        } else {
            echo '/* style-company-over not found */';
        }
    }

    // Serve dynamic general override CSS
    public function style_over()
    {
        header('Content-Type: text/css');
        // expects $_GET['color'], $_GET['rgb']
        $path = FCPATH.'assets/front/css/style-over.php';
        if (file_exists($path)) {
            include $path;
        } else {
            echo '/* style-over not found */';
        }
    }

    // Serve PWA manifest dynamically
    public function manifest()
    {
        header('Content-Type: application/manifest+json');
        // pass through to existing generator which expects pwa_data serialized in GET
        $path = FCPATH.'assets/pwa/manifest.php';
        if (file_exists($path)) {
            include $path;
        } else {
            echo json_encode(['error' => 'manifest generator not found']);
        }
    }
}
