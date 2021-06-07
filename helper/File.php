<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

require_once __DIR__ . "/Str.php";

class File {

    private $path;

    public function __construct($path) {
        $this->path = $path;
    }

    public function exists() {
        if (file_exists($this->path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isDirectory() {
        if (is_dir($this->path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isFile() {
        if (is_file($this->path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isLink() {
        if (is_link($this->path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getParentFile() {
        return new File(dirname($this->path));
    }

    public function delete($useBashCommand = FALSE) {
        if (!$useBashCommand) {
            return unlink($this->path);
        } else {
            if ($this->isDirectory()) {
                shell_exec("sudo rm -r '{$this->path}'");
            } elseif ($this->isFile()) {
                shell_exec("sudo rm '{$this->path}'");
            } elseif ($this->isLink()) {
                shell_exec("sudo rm '{$this->path}'");
            }
        }
    }

    public function moveTo($newPath, $useBashCommand = FALSE) {
        $resMoveTo = FALSE;
        if (!$useBashCommand) {
            //return rename($this->path, $newName);
        } else {
            $command = "sudo mv '{$this->path}' '{$newPath}'";
            $return_var = NULL;
            exec($command, $output, $return_var);
            if (!$return_var) {
                $resMoveTo = TRUE;
            }
        }
        return $resMoveTo;
    }

    public function createLink($link, $useBashCommand = FALSE) {
        $resCreateLink = FALSE;
        if (!$useBashCommand) {
            //return link($this->path, $link);
        } else {
            $command = "sudo ln -s '{$this->path}' '{$link}'";
            $return_var = NULL;
            exec($command, $output, $return_var);
            if (!$return_var) {
                $resCreateLink = TRUE;
            }
        }
        return $resCreateLink;
    }

    public function untarTgz($newPath, $useBashCommand = FALSE) {
        $resUntarTgz = FALSE;
        if (!$useBashCommand) {
            //
        } else {
            $command = "sudo tar -zxvf '{$this->path}' -C '{$newPath}'";
            $return_var = NULL;
            exec($command, $output, $return_var);
            if (!$return_var) {
                $resUntarTgz = TRUE;
            }
        }
        return $resUntarTgz;
    }

    public function readLink() {
        if ($this->isLink()) {
            return readlink($this->path);
        } else {
            return NULL;
        }
    }

    public function decryptFile($pass, $outputPath, $useBashCommand = FALSE) {
        $resDecryptFile = FALSE;
        if (!$useBashCommand) {
            //
        } else {
            $command = "echo \"{$pass}\" | sudo openssl enc -aes-256-cbc -d -in {$this->path} -out {$outputPath} -pass stdin";

            $return_var = NULL;
            exec($command, $output, $return_var);
            //exe
            if (!$return_var) {
                $resDecryptFile = TRUE;
            } else {
                $new_file = new File($outputPath);
                $new_file->delete(TRUE);
            }
        }
        return $resDecryptFile;
    }

    public function mkdir($useBashCommand = FALSE) {
        $resMkdir = FALSE;
        if (!$useBashCommand) {
            //
        } else {
            $command = "sudo mkdir '{$this->path}'";
            $return_var = NULL;
            exec($command, $output, $return_var);
            if (!$return_var) {
                $resMkdir = TRUE;
            }
        }
        return $resMkdir;
    }

    public function mkdirs($useBashCommand = FALSE) {
        $resMkdirs = FALSE;
        if (!$useBashCommand) {
            //
        } else {
            $command = "sudo mkdir -p '{$this->path}'";
            $return_var = NULL;
            exec($command, $output, $return_var);
            if (!$return_var) {
                $resMkdirs = TRUE;
            }
        }
        return $resMkdirs;
    }

    public function write($content, $useBashCommand = FALSE) {
        $myfile = fopen($this->path, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

    public function read() {
        $myfile = fopen($this->path, "r") or die("Unable to open file!");
        $content = fread($myfile, filesize($this->path));
        fclose($myfile);
        return $content;
    }

    public function readLineByLine($withReturn) {
        $content = array();
//
        $myfile = fopen($this->path, "r") or die("Unable to open file!");
        while (!feof($myfile)) {
            $line = fgets($myfile);
            if (!$withReturn) {
                $line = substr($line, 0, -1);
            }
            array_push($content, $line);
        }
        fclose($myfile);
        return $content;
    }

    public function parseINIWithSection($comments, $separators, $beArrays) {
        $str = new Str();
        return $str->parseINIWithSection($this->read(), $comments, $separators, $beArrays);
    }

    public function parseINIWithoutSection($comments, $separators, $beArrays) {
        $str = new Str();
        return $str->parseINIWithoutSection($this->read(), $comments, $separators, $beArrays);
    }

}
