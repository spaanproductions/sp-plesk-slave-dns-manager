<?php
// Copyright 1999-2017. Parallels IP Holdings GmbH.

use Modules_SpSlaveDnsManager_ApiRpc\Factory;

class Modules_SpSlaveDnsManager_ApiRpc extends pm_Hook_ApiRpc
{
    public function call($data)
    {
        $result = [];
        foreach ($data as $command => $params) {
            $result[$command] = Factory::get($command, $params)->run();
        }
        return $result;
    }
}
