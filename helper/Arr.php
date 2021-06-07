<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

class Arr {

    public function isArrayItemInArray($array1, $array2) {
        $flag = FALSE;
        foreach ($array1 as $item) {
            if (in_array($item, $array2)) {
                $flag = TRUE;
                break;
            }
        }
        return $flag;
    }

    public function searchStringInArrayValues($string, $array) {
        foreach ($array as $key => $value) {
            if ($string == $value) {
                return $key;
            }
        }
        return NULL;
    }

    public function join($glue, $pieces) {
        return implode($glue, $pieces);
    }

    public function joinWithPrefix($glue, $pieces, $prefix) {
        $implode = "";
        for ($i = 0; $i < sizeof($pieces); $i++) {
            $implode .= $prefix . $pieces[$i];
            if ($i + 1 < sizeof($pieces)) {
                $implode .= $glue;
            }
        }
        return $implode;
    }

    public function isSizeEqual($array1, $array2) {
        if (
                (isset($array1) && isset($array2)) &&
                (is_array($array1) && is_array($array2)) &&
                sizeof($array1) == sizeof($array2)
        ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isEqual($array1, $array2) {
        if ($this->isSizeEqual($array1, $array2)) {
            $flag = TRUE;
            foreach ($array1 as $item) {
                if (!in_array($item, $array2)) {
                    $flag = FALSE;
                    break;
                }
            }
            return $flag;
        } else {
            return FALSE;
        }
    }

}
