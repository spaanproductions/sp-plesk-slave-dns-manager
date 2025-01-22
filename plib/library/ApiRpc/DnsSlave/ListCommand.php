<?php
// Copyright 1999-2017. Parallels IP Holdings GmbH.

namespace Modules_SpSlaveDnsManager_ApiRpc\DnsSlave;

use Modules_SpSlaveDnsManager_ApiRpc\AbstractCommand;
use Modules_SpSlaveDnsManager_Rndc;
use Modules_SpSlaveDnsManager_Slave;

class ListCommand extends AbstractCommand
{

    protected function _run()
    {
        $data = [];
        $rndc = new Modules_SpSlaveDnsManager_Rndc();

        foreach (Modules_SpSlaveDnsManager_Slave::getList() as $slave) {
            try {
                $details = $rndc->checkStatus($slave);
                $status = 'ok';
            } catch (\Exception $e) {
                $details = $e->getMessage();
                $status = 'warning';
            }
            $ip = (string)$slave->getIp();
            $config = (string)$slave->getConfig();

            $data[] = [
                'ip' => $ip,
                'status' => $status,
                'details' => $details,
                'config' => $config,
            ];
        }

        return ['slave' => $data];
    }
}

