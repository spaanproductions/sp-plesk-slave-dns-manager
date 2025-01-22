<?php
// Copyright 1999-2017. Parallels IP Holdings GmbH.
pm_Loader::registerAutoload();
pm_Context::init('sp-slave-dns-manager');

try {
    $result = pm_ApiCli::call('server_dns', array('--disable-custom-backend'));
} catch (pm_Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
exit(0);
