<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

class Network
{

    private $numberOfIp;
    private $adapters;

    public function __construct()
    {
        $this->numberOfIp = 4;
        $this->setAdapters();
    }

    public function getNumberOfIp()
    {
        return $this->numberOfIp;
    }

    public function getAdapters()
    {
        return $this->adapters;
    }

    private function setAdapters()
    {
        $this->adapters = array();
        // eth
        $adaptersPath = glob('/sys/class/net/eth*', GLOB_ONLYDIR);
        foreach ($adaptersPath as $adapterPath) {
            $adapter = basename($adapterPath);
            array_push($this->adapters, $adapter);
        }
        // wlan
        /*
        $adaptersPath = glob('/sys/class/net/wlan*', GLOB_ONLYDIR);
        foreach ($adaptersPath as $adapterPath) {
            $adapter = basename($adapterPath);
            array_push($this->adapters, $adapter);
        }
        */
    }

    public function getNumberOfAdapter()
    {
        return sizeof($this->adapters);
    }

    private function setAdapterIp($adapter, $ip_number, $ip, $netmask)
    {
        exec("sudo ifconfig {$adapter}:{$ip_number} {$ip} netmask {$netmask} up");
    }

    private function deleteAdapterIps($adapter)
    {
        exec("sudo ip addr flush dev {$adapter}");
    }

    private function deleteAdaptersIps()
    {
        $adapters = $this->getAdapters();
        for ($i = 0; $i < sizeof($adapters); $i++) {
            $this->deleteAdapterIps($adapters[$i]);
        }
    }

    private function deleteGateway()
    {
        exec("sudo ip route del 0/0");
    }

    private function setGatewayIp($ip)
    {
        exec("sudo route add default gw {$ip}");
    }

    public function apply()
    {
        $network = new \app\models\Network();
        $network_datas = $network->getTableKeyValue();
        if ($this->getNumberOfAdapter() > 0 && sizeof($network_datas) > 0) {
            $this->deleteAdaptersIps();
        }
        foreach ($this->getAdapters() as $adapter) {
            for ($j = 0; $j < $this->numberOfIp; $j++) {
                $ip = $network_datas["network_" . $adapter . "_ip" . $j];
                $netmask = $network_datas["network_" . $adapter . "_netmask" . $j];
                if ((isset($ip) && strlen($ip) > 0) && (isset($netmask) && strlen($netmask) > 0)) {
                    $this->setAdapterIp($adapter, $j, $ip, $netmask);
                }
            }
        }
        $this->deleteGateway();
        $this->setGatewayIp($network_datas["network_gateway"]);
    }

    static public function adapterType($adapter)
    {
        $type = "";
        if (str_contains($adapter, "eth")) {
            $type = "eth";
        } else if (str_contains($adapter, "wlan")) {
            $type = "wlan";
        }
        return $type;
    }

    static public function adapterToName($adapter)
    {
        $num = preg_replace('/\D/i', '', $adapter);
        $name = "";
        if (Network::adapterType($adapter) == "eth") {
            $name = "Ethernet Port " . ($num + 1);
        } else if (Network::adapterType($adapter) == "wlan") {
            $name = "Wifi Port " . ($num + 1);
        }
        return $name;
    }
}
