<?php


namespace App;


class Signer
{

    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['email'] !== App::$config->get('email') || $_POST['password'] !== App::$config->get('password')) {
                App::$log->log('error', '401 Unauthorized');
                header("HTTP/1.1 401 Unauthorized");
                echo '401 Unauthorized';
                exit;
            }
        }
    }

    public function form()
    {
        require_once "../templates/signer/signer.php";
        exit();
    }

    public function signXML()
    {
        $cp = new CryptoPro();

        echo '<pre>' . htmlspecialchars($cp->signXML(file_get_contents($_FILES['file']['tmp_name']))) . '</pre>';
    }

    public function signFile()
    {
        $cp = new CryptoPro();

        $cp->signExec($_FILES['file']['tmp_name']);

        $signature = file_get_contents('../' . $_FILES['file']['tmp_name'] . '.sig');

        header('Content-Type: application/sig');
        header('Content-Length: ' . strlen($signature));
        header('Content-Disposition: inline; filename="' . $_FILES['file']['name'] . '.sig"');
        echo $signature;

        unlink('../' . $_FILES['file']['tmp_name'] . '.sig');
    }

}