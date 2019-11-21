<?php

namespace App;

use ZipArchive;

class CryptoPro
{

    private $certificate;

    public function __construct()
    {
        if (!$this->certificate) {
            $this->certificate = $this->SetupCertificate(CURRENT_USER_STORE, "My", STORE_OPEN_READ_ONLY,
                CERTIFICATE_FIND_SUBJECT_NAME, App::$config->get('dn'), 0, 1);
        }

        if (!$this->certificate) {
            App::$log->log('error', 'CryptoPro Не найден сертификат');
            App::$parser->dropError('SMEV-100004', 'Не найден сертификат');
        }
    }

    public function signXML($content)
    {
        $signer = new \CPSigner();
        $signer->set_TSAAddress('http://testca.cryptopro.ru/tsp/tsp.srf');
        $signer->set_Certificate($this->certificate);

        $sd = new \CPSignedXML();
        $sd->set_SignatureType(2);
        $sd->set_SignatureMethod('urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256');
        $sd->set_DigestMethod('urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256');
        $sd->set_Content($content);

        return $sd->Sign($signer, "");
    }

    public function signFile($content)
    {
        $signer = new \CPSigner();
        $signer->set_TSAAddress('http://www.cryptopro.ru/tsp/tsp.srf');
        $signer->set_Certificate($this->certificate);

        $sd = new \CPSignedData();
        $sd->set_Content($content);

        return $sd->Sign($signer, 0, STRING_TO_UCS2LE);
    }

    public function signCades($content)
    {
        $signer = new \CPSigner();
        $signer->set_TSAAddress('http://www.cryptopro.ru/tsp/tsp.srf');
        $signer->set_Certificate($this->certificate);

        $sd = new \CPSignedData();
        $sd->set_Content($content);

        return $sd->SignCades($signer, 0x01, 1, 1);
    }

    public function signExec($file)
    {

        exec('cd ../tmp;    /opt/cprocsp/bin/amd64/cryptcp -sign -dn="'.App::$config->get('dn').'" '.$file, $out, $err);

        if($err !== 0){
            App::$log->log('error', 'CryptoPro Не удалось подписать файл');
            App::$parser->dropError('CryptoPro', 'Не удалось подписать файл');
        }

        return;

    }

    public function getSignedZipBase64($file, $type)
    {
        $sign = $this->signFile($file);

        $zip = new ZipArchive();
        $zipName = '../tmp/' . time() . rand(0, 99999) . ".zip";

        $zip->open($zipName, ZipArchive::CREATE);
        if($type == 'pdf'){
            $zip->addFromString('File.'.$type, base64_decode($file));
        } else{
            $zip->addFromString('File.'.$type, $file);
        }

        $zip->addFromString('File.'.$type.'.sig', $sign);
        $zip->close();

        $zipData = file_get_contents($zipName);
        $signedZip = base64_encode($zipData);

        unlink($zipName);

        return $signedZip;
    }

    public function verify($content)
    {

        if(!App::$config->get('verify')){
            return true;
        }

        try {
            $verify = new \CPSignedXML();
            $verify->Verify($content, "");
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getCertificate()
    {
        return $this->certificate->Export(0);
    }

    private function SetupStore($location, $name, $mode)
    {
        $store = new \CPStore();
        $store->Open($location, $name, $mode);
        return $store;
    }

    private function SetupCertificates($location, $name, $mode)
    {
        $store = $this->SetupStore($location, $name, $mode);
        $certs = $store->get_Certificates();
        return $certs;
    }

    private function SetupCertificate($location, $name, $mode, $find_type, $query, $valid_only, $number)
    {
        $certs = $this->SetupCertificates($location, $name, $mode);
        if ($find_type != null) {
            $certs = $certs->Find($find_type, $query, $valid_only);
            return $certs->Item($number);
        } else {
            $cert = $certs->Item($number);
            return $cert;
        }
    }

}