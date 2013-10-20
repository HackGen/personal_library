<?php
require_once 'include/class/member.php';
$member = new Member();
$member->logout();

header('Location: /');
