<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

require_once __DIR__ . "/Arr.php";

class Str {

    public function contains($needle, $haystack) {
        return strpos($haystack, $needle) !== false;
    }

    public function split($delimiter, $string) {
        $arr = NULL;
        if (!isset($string) || strlen($string) == 0) {
            $arr = array();
        } elseif ($this->contains($delimiter, $string)) {
            $arr = explode($delimiter, $string);
        } else {
            $arr = array($string);
        }
        return $arr;
    }

    public function convertKeyStringToValueString($keyDelimiter, $keyString, $valueDelimiter, $keyValueList) {
        $values = array();
        $keys = $this->split($keyDelimiter, $keyString);
        foreach ($keys as $key) {
            array_push($values, $keyValueList[$key]);
        }
        $arr = new Arr();
        $valueString = $arr->join($valueDelimiter, $values);
        return $valueString;
    }

    public function splitCommaAndDash($string) {
        $values = array();
        $comma_string_list = explode(",", $string);
        for ($i = 0; $i < sizeof($comma_string_list); $i++) {
            $comma_string = $comma_string_list[$i];
            if (strpos($comma_string, "-") == TRUE) {
                $dash_string_list = explode("-", $comma_string);
                if ($dash_string_list[0] <= $dash_string_list[1]) {
                    for ($j = $dash_string_list[0]; $j <= $dash_string_list[1]; $j++) {
                        array_push($values, $j . "");
                    }
                } else {
                    throw new \yii\base\Exception("Invalide Range Number.");
                }
            } else {
                array_push($values, $comma_string . "");
            }
        }
        return $values;
    }

    public function parseDetail($string) {
        $arr = array();
        //
        $lines = explode("\n", $string);
        foreach ($lines as $line) {
            if (strlen($line)) {
                if ($line[0] == ' ') {
                    // will implement later 
                } elseif ($this->contains(":", $line)) {
                    $temp = explode(":", $line);
                    $key = trim($temp[0]);
                    $value = trim($temp[1]);
                    $arr += [$key => $value];
                }
            }
        }
        return $arr;
    }

    function parseINIWithSection($ini, $comments, $separators, $beArrays) {
        $sections = array();
        $section = array();
        $section_name = "";
        //
        $lines = explode("\n", $ini);
        foreach ($lines as $line) {
            $line = trim($line);
            if (strlen($line) == 0) {
                continue;
            } elseif ($line[0] == '[') {
                if (strlen($section_name) == 0) {
                    $section_name = preg_replace('/\[|\]/s', '', $line);
                } else {
                    if (sizeof($section) > 0) {
                        $sections += [$section_name => $section];
                    }
                    //
                    $section_name = preg_replace('/\[|\]/s', '', $line);
                    $section = array();
                }
            } elseif (!in_array($line[0], $comments)) {
                //
                $separator = "";
                for ($j = 0; $j < sizeof($separators); $j++) {
                    if (strpos($line, $separators[$j]) == TRUE) {
                        $separator = $separators[$j];
                        break;
                    }
                }
                //
                $temp = explode($separator, $line);
                $key = trim($temp[0]);
                $value = trim($temp[1]);
                //
                if (strlen($value) > 0) {
                    if (isset($beArrays)) {
                        if (in_array($key, $beArrays)) {
                            if (!isset($section[$key])) {
                                $section[$key] = array();
                            }
                            array_push($section[$key], $value);
                        } else {
                            $section += [$key => $value];
                        }
                    } else {
                        if (isset($section[$key])) {
                            if (is_array($section[$key])) {
                                array_push($section[$key], $value);
                            } else {
                                $value1 = $section[$key];
                                $section[$key] = array();
                                array_push($section[$key], $value1);
                                array_push($section[$key], $value);
                            }
                        } else {
                            $section += [$key => $value];
                        }
                    }
                }
            } else {
                // it is comment line
            }
        }
        if (sizeof($section) > 0) {
            $sections += [$section_name => $section];
        }
        return $sections;
    }

    function parseINIWithoutSection($ini, $comments, $separators, $beArrays) {
        $sections = array();
        $section = array();
        //
        $lines = explode("\n", $ini);
        foreach ($lines as $line) {
            $line = trim($line);
            if (strlen($line) == 0) {
                if (sizeof($section) > 0) {
                    array_push($sections, $section);
                    $section = array();
                }
            } elseif (!in_array($line[0], $comments)) {
                //
                $separator = "";
                for ($j = 0; $j < sizeof($separators); $j++) {
                    if (strpos($line, $separators[$j]) == TRUE) {
                        $separator = $separators[$j];
                        break;
                    }
                }
                //
                $temp = explode($separator, $line);
                $key = trim($temp[0]);
                $value = trim($temp[1]);
                //
                if (strlen($value) > 0) {
                    if (isset($beArrays)) {
                        if (in_array($key, $beArrays)) {
                            if (!isset($section[$key])) {
                                $section[$key] = array();
                            }
                            array_push($section[$key], $value);
                        } else {
                            $section += [$key => $value];
                        }
                    } else {
                        if (isset($section[$key])) {
                            if (is_array($section[$key])) {
                                array_push($section[$key], $value);
                            } else {
                                $value1 = $section[$key];
                                $section[$key] = array();
                                array_push($section[$key], $value1);
                                array_push($section[$key], $value);
                            }
                        } else {
                            $section += [$key => $value];
                        }
                    }
                }
            } else {
                // it is comment line
            }
        }
        return $sections;
    }

}
