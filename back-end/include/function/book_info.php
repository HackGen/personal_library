<?php
require_once 'include/class/simple_html_dom.php';

function book_info_abe($ISBN) {
	$html = @file_get_html("http://www.abebooks.com/products/isbn/{$ISBN}");
	if(!html) {
		return false;
	}

	if (!($title = $html->find('h2[property=name]', 0))) {
		return false;
	}
	$title = $title->innertext;

	if (!($author = $html->find('span[property=author]', 0))) {
		return false;
	}
	$author = $author->innertext;

	if($title == '' && $author == '') {
		return false;
	}

	return array('title'=>$title, 'author'=>$author);
}

function book_info_books($ISBN) {
	$html = @file_get_html("http://search.books.com.tw/exep/prod_search.php?key={$ISBN}");

	if (!$html)
		return false;

	$book = array();

	foreach ($html->find('li.item') as $element) {
		$link_title = $element->find('a[rel=mid_name]', 0);
		$link_author = $element->find('a[rel=go_author]', 0);
		$href = html_entity_decode($link_title->href);
		$book['title'] = html_entity_decode($link_title->title);
		$book['author'] = html_entity_decode($link_author->title);
		$innerhtml = @file_get_html($href);
		if (strpos($innerhtml->innertext, "<li>ISBN：{$ISBN}</li>") !== false) {
			return $book;
		}
	}
	return false;
}

function book_info_tenlong($ISBN) {
	$html = @file_get_html('http://www.tenlong.com.tw/items/'. $ISBN);

	if (!$html)
		return false;

	$title = $html->find('h2[class=item_title]', 0);
	if (!$title)
		return false;
	$title = $title->innertext;

	$author = $html->find('h3[class=item_author]', 0);
	if (!$author)
		return false;
	$author = $author->innertext;

	if($title == '' && $author == '') {
		return false;
	}

	return array('title'=>$title, 'author'=>$author);
}

function book_info_amazon($ISBN) {
	$html = @file_get_html("http://www.amazon.com/gp/search/field-isbn={$ISBN}");

	if (!$html)
		return false;

	$book = array();

	$link_result = $html->find('#result_0 h3.newaps', 0);

	if (!$link_result)
		return false;

	$href = html_entity_decode($link_result->find('a', 0)->href);
	$innerhtml = @file_get_html($href);
	if (strpos($innerhtml->innertext, substr_replace($ISBN, '-'.substr($ISBN, 3), 3)) !== false) {
		$link_title = $innerhtml->find('h1', 0);
		$link_author = $link_title->parent()->find('a', 0);
		$book['title'] = html_entity_decode($link_title->innertext);
		$book['author'] = html_entity_decode($link_author->innertext);
		$book['title'] = strip_tags(trim(preg_replace("/(?:\(.+?\))/i", '', $book['title'])));
		return $book;
	}
	return false;
}

function book_info($ISBN) {
	if ($result = book_info_books($ISBN))
		return $result;
	if ($result = book_info_tenlong($ISBN))
		return $result;
	if ($result = book_info_amazon($ISBN))
		return $result;
	if ($result = book_info_abe($ISBN))
		return $result;
	return false;
}

function toISBN_13($ISBN) {

	if(strlen($ISBN) == 10) {
		$ISBN = '978' . substr($ISBN, 0, -1);
		$str2int = function ($str) { return (int)$str; };
		$r = array_map($str2int , str_split($ISBN));

		$S = $r[0]*1+$r[1]*3+$r[2]*1+$r[3]*3+$r[4]*1+$r[5]*3+$r[6]*1+$r[7]*3+$r[8]*1+$r[9]*3+$r[10]*1+$r[11]*3;
		$M = $S % 10;
		$N = 10 - $M;

		$ISBN = $ISBN . ($N%10);
	}

	return $ISBN;
}