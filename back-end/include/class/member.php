<?php
require_once 'include/function/db_pdo.php';

class Member
{
	public static $username = NULL;
	public static $nickname = '';
	public static $access = NULL;

	function __construct()
	{
		self::$username = NULL;
		self::$nickname = '';
		self::$access = NULL;
		session_cache_limiter('nocache');
		session_cache_expire(43200); // minutes
		$sessname = session_name();
		if (isset($_COOKIE[$sessname])) {
			session_start();
			session_write_close();
			self::$username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
			self::$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : NULL;
			self::$access = isset($_SESSION['access']) ? $_SESSION['access'] : NULL;
		}
	}

	function login($username, $password)
	{
		$dbh = PDO_Inst();
		$sth = $dbh->prepare("SELECT * FROM `members` WHERE `email` = :username AND `password` = :password");
		$sth->execute(array(':username' => $username, ':password' => sha1(md5($password))));
		$query = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($query as $item) {
			self::$username = $item['email'];
			self::$nickname = $item['nickname'];
			self::$access = $item['access'];
		}
		$username = $password = NULL;

		if (!count($query))
			return false;
		session_start();
		$_SESSION['username'] = self::$username;
		$_SESSION['nickname'] = self::$nickname;
		$_SESSION['access'] = self::$access;
		session_write_close();
		return true;
	}

	function logout()
	{
		self::$username = NULL;
		self::$nickname = NULL;
		self::$access = NULL;
		session_start();
		$_SESSION['uid'] = NULL;
		$_SESSION['username'] = NULL;
		$_SESSION['nickname'] = NULL;
		$_SESSION['access'] = NULL;
		session_write_close();
	}

	function redirect($privilege = NULL)
	{
		if (!self::$username) {
			header('Location: '.SYSTEM_URL.'/signin');
			exit();
		} else if ($privilege && self::$access < $privilege) {
			header('HTTP/1.1 403 Forbidden');
			die('<h1>Forbidden</h1>');
		}
	}
}
