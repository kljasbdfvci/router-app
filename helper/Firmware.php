<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

require_once __DIR__ . "/File.php";
require_once __DIR__ . "/Variable.php";

class Firmware {

    //
    private $firmwarePath;
    // App
    private $appSignature;
    private $appFilePrefixPath;
    private $appCurrentVersionPath;
    private $appTmpFilePath;
    private $appNewPath;
    private $appTmpTgzFilePath;
    private $appTmpDirFilePath;
    // System
    private $systemSignature;
    private $systemFilePrefixPath;
    private $systemCurrentVersionPath;
    private $systemTmpFilePath;
    private $systemNewPath;
    private $systemTmpTgzFilePath;
    private $systemTmpDirFilePath;

    public function __construct() {
        $variable = new Variable();
        $this->firmwarePath = $variable->getDiskPath() . '/firmware';
        // App
        $this->appSignature = "app-pbx";
        $this->appFilePrefixPath = $this->firmwarePath . "/" . $this->appSignature; // real
        $this->appCurrentVersionPath = $variable->getAppPath() . '/revision';
        $this->appTmpFilePath = $variable->getTmpPath() . "/" . $this->appSignature;
        $this->appNewPath = $this->appTmpFilePath . ".new";
        $this->appTmpTgzFilePath = $this->appTmpFilePath . ".tgz";
        $this->appTmpDirFilePath = $this->appTmpFilePath . ".dir";
        // System
        $this->systemSignature = "linux-os.18-pbx";
        $this->systemFilePrefixPath = $this->firmwarePath . "/" . $this->systemSignature; // real
        $this->systemCurrentVersionPath = '/revision';
        $this->systemTmpFilePath = $variable->getTmpPath() . "/" . $this->systemSignature;
        $this->systemNewPath = $this->systemTmpFilePath . ".new";
        $this->systemTmpTgzFilePath = $this->systemTmpFilePath . ".tgz";
        $this->systemTmpDirFilePath = $this->systemTmpFilePath . ".dir";
    }

    // Serial Number
    public function getSerialNumber() {
        return shell_exec("sudo serial | tr -d '\n'");
    }

    private function getPass() {
        return shell_exec("sudo serial -s code | tr -d '\n'");
    }

    // App
    public function checkAppTmpFile() {
        $resCheckAppTmpFile = FALSE;
        //  
        $pass = $this->getPass();
        $appTmpFile = new File($this->appTmpFilePath);
        if ($appTmpFile->decryptFile($pass, $this->appTmpTgzFilePath, TRUE)) {
            $appTmpDirFile = new File($this->appTmpDirFilePath);
            $appTmpDirFile->mkdir(TRUE);
            $appTmpTgzFile = new File($this->appTmpTgzFilePath);
            if ($appTmpTgzFile->untarTgz($this->appTmpDirFilePath, TRUE)) {
                $appTmpDirSignatureFile = new File($this->appTmpDirFilePath . "/signature");
                $signature = trim($appTmpDirSignatureFile->read());
                if ($signature == $this->appSignature) {
                    $appTmpDirRevisionFile = new File($this->appTmpDirFilePath . "/revision");
                    $revision = trim($appTmpDirRevisionFile->read());
                    $appTmpFile->moveTo($this->appFilePrefixPath . "-v" . $revision, TRUE);
                    $this->setAppNew();
                    $resCheckAppTmpFile = TRUE;
                    //
                    $appTmpDirFile->delete(TRUE);
                    $appTmpTgzFile->delete(TRUE);
                } else {
                    $appTmpFile->delete(TRUE);
                    $appTmpDirFile->delete(TRUE);
                    $appTmpTgzFile->delete(TRUE);
                }
            } else {
                $appTmpFile->delete(TRUE);
                $appTmpDirFile->delete(TRUE);
                $appTmpTgzFile->delete(TRUE);
            }
        } else {
            $appTmpFile->delete(TRUE);
        }
        return $resCheckAppTmpFile;
    }

    public function getAppCurrentVersion() {
        $file = new File($this->appCurrentVersionPath);
        if ($file->exists()) {
            return $file->read();
        } else {
            return "error";
        }
    }

    private function setAppNew() {
        $file = new File($this->appNewPath);
        $file->write("");
        return;
    }

    public function isAppNewUploaded() {
        $file = new File($this->appNewPath);
        return $file->exists();
    }

    public function getAppTmpFilePath() {
        return $this->appTmpFilePath;
    }

    // System
    public function checkSystemTmpFile() {
        $resCheckSystemTmpFile = FALSE;
        //  
        $pass = $this->getPass();
        $systemTmpFile = new File($this->systemTmpFilePath);
        if ($systemTmpFile->decryptFile($pass, $this->systemTmpTgzFilePath, TRUE)) {
            $systemTmpDirFile = new File($this->systemTmpDirFilePath);
            $systemTmpDirFile->mkdir(TRUE);
            $systemTmpTgzFile = new File($this->systemTmpTgzFilePath);
            if ($systemTmpTgzFile->untarTgz($this->systemTmpDirFilePath, TRUE)) {
                $systemTmpDirSignatureFile = new File($this->systemTmpDirFilePath . "/signature");
                $signature = trim($systemTmpDirSignatureFile->read());
                if ($signature == $this->systemSignature) {
                    $systemTmpDirRevisionFile = new File($this->systemTmpDirFilePath . "/revision");
                    $revision = trim($systemTmpDirRevisionFile->read());
                    $systemTmpFile->moveTo($this->systemFilePrefixPath . "-v" . $revision, TRUE);
                    $this->setSystemNew();
                    $resCheckSystemTmpFile = TRUE;
                    //
                    $systemTmpDirFile->delete(TRUE);
                    $systemTmpTgzFile->delete(TRUE);
                } else {
                    $systemTmpFile->delete(TRUE);
                    $systemTmpDirFile->delete(TRUE);
                    $systemTmpTgzFile->delete(TRUE);
                }
            } else {
                $systemTmpFile->delete(TRUE);
                $systemTmpDirFile->delete(TRUE);
                $systemTmpTgzFile->delete(TRUE);
            }
        } else {
            $systemTmpFile->delete(TRUE);
        }
        return $resCheckSystemTmpFile;
    }

    public function getSystemCurrentVersion() {
        $file = new File($this->systemCurrentVersionPath);
        if ($file->exists()) {
            return $file->read();
        } else {
            return "error";
        }
    }

    private function setSystemNew() {
        $file = new File($this->systemNewPath);
        $file->write("");
        return;
    }

    public function isSystemNewUploaded() {
        $file = new File($this->systemNewPath);
        return $file->exists();
    }

    public function getSystemTmpFilePath() {
        return $this->systemTmpFilePath;
    }

}
