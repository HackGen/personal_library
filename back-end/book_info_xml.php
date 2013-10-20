<?php
require_once 'include/class/simple_html_dom.php';
require_once 'include/function/book_info.php';

header('Content-Type: text/xml; charset=utf-8');

$ISBN = isset($_GET['isbn']) ? floor($_GET['isbn']) : 0;

$book = $ISBN ? book_info($ISBN) : false;
$cnt = $book ? 1 : 0;

$dom = new DOMDocument('1.0');
$dom->encoding = 'UTF-8';
$root = $dom->createElement('root');
$dom->appendChild($root);
$channel = $dom->createElement('bookinfo');
$channel->setAttribute('count', $cnt);
$root->appendChild($channel);

if ($book) {
	$item = $dom->createElement('book');
	$item->setAttribute('title', $book['title']);
	$item->setAttribute('author', $book['author']);
	$channel->appendChild($item);
}
echo($dom->saveXML());
