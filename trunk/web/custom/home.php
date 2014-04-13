<?php require_once('../Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
try {
	$result = 0;
	$msg = '';
	$code = 200;
	$data = array();
	$res = array();
	$cached = false;

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$extArray = array();
$extension = '';
$sql = '';
$sql2 = '';

if (isset($_GET['location'])) {
  $location = $_GET['location'];
  if (!empty($location)) {
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location).'&sensor=false';
		$content = file_get_contents($url);
		$result = json_decode($content, true);
		if ($result['status'] != 'OK') {
			throw new \Exception('Locaiton not found.');
		}
		foreach ($result['results'] as $res) {
			$location = $res['geometry']['location'];
			break;
		}
		$radius = 50;
		$distance = '';
		$sql = ", (ROUND(
		DEGREES(ACOS(SIN(RADIANS(".$location['lat'].")) * SIN(RADIANS(jobs.latitude)) + COS(RADIANS(".$location['lat'].")) * COS(RADIANS(jobs.latitude)) * COS(RADIANS(".$location['lng']." -(jobs.longitude)))))*60*1.1515,2)) as distance";
		$sql2 = "AND (ROUND(
		DEGREES(ACOS(SIN(RADIANS(".$location['lat'].")) * SIN(RADIANS(jobs.latitude)) + COS(RADIANS(".$location['lat'].")) * COS(RADIANS(jobs.latitude)) * COS(RADIANS(".$location['lng']." -(jobs.longitude)))))*60*1.1515,2)) <= ".$radius;
	}
}
if (isset($_GET['q'])) {
  $q = $_GET['q'];
  $extArray[] = "jobs_keywords.keyword LIKE '%$q%'";
}

if (!empty($extArray)) {
	$extension = implode(' AND ', $extArray);
}

$colkw_rsView = "%";
if (isset($_GET['q'])) {
  $colkw_rsView = $_GET['q'];
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT distinct jobs.job_id, jobs.*, geo_cities.cty_id as city_id, geo_cities.name as city, geo_countries.con_id as country_id, geo_countries.name as country, geo_states.sta_id as state_id, geo_states.name as state $sql FROM jobs LEFT JOIN jobs_keywords ON jobs.job_id = jobs_keywords.job_id LEFT JOIN geo_cities ON geo_cities.cty_id = jobs.city LEFT JOIN geo_countries ON geo_countries.con_id = jobs.country LEFT JOIN geo_states ON geo_states.sta_id = jobs.state WHERE 1 $sql2 AND jobs_keywords.keyword LIKE %s", GetSQLValueString("%" . $colkw_rsView . "%", "text"));
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);
$res = array();
if ($totalRows_rsView > 0) {
do {
	$res[] = $row_rsView;
} while ($row_rsView = mysql_fetch_assoc($rsView));
}
	$result = 1;
	$arr = array('success' => $result, 
		'message' => $msg, 
		'code' => $code, 
		'data' => $res, 
		'totalRows_rsView' => $totalRows_rsView, 
		'queryString_rsView' => $queryString_rsView, 
		'totalPages_rsView' => $totalPages_rsView,
		'startRow_rsView' => $startRow_rsView,
		'maxRows_rsView' => $maxRows_rsView, 
		'pageNum_rsView' => $pageNum_rsView, 
		'first' => ($pageNum_rsView > 0) ? 0 : null,
		
		'previous' => ($pageNum_rsView > 0) ? max(0, $pageNum_rsView - 1) : null, 
		'next' => ($pageNum_rsView < $totalPages_rsView) ? min($totalPages_rsView, $pageNum_rsView + 1) : null, 
		'last' => ($pageNum_rsView < $totalPages_rsView) ? $totalPages_rsView : null
		);
} catch (Exception $e) {
	$msg = $e->getMessage();
	$result = 0;
	$code = $e->getCode();
	$arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res);
}
$json = json_encode($arr);
echo $json;