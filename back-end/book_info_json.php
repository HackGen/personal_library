<?php
require_once 'include/class/simple_html_dom.php';
require_once 'include/function/book_info.php';

header('Content-Type: application/x-javascript; charset=utf-8');

$ISBN = isset($_GET['isbn']) ? toISBN_13($_GET['isbn']) : 0;

$book = $ISBN ? book_info($ISBN) : false;
$cnt = $book ? 1 : 0;
$book['count'] = $cnt;
$book['isbn'] = $ISBN;

echo(json_encode($book));
