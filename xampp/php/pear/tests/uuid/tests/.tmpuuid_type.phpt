--TEST--
UUID type detection
--SKIPIF--
<?php if (!extension_loaded("uuid")) print "skip"; ?>
--POST--
--GET--
--INI--
--FILE--
<?php
echo uuid_type("b691c99c-7fc5-11d8-9fa8-00065b896488")."\n";
echo uuid_type("878b258c-a9f1-467c-8e1d-47d79ca2c01b")."\n";
echo uuid_type("00000000-0000-0000-0000-000000000000")."\n";
?>
--EXPECT--
1
4
-1


