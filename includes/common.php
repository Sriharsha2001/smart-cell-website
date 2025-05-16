<?php
// Start session if not started
if (!isset($_SESSION)) {
    session_start();
}

// Get database URL from environment variable
$db_url = getenv('DATABASE_URL');

// Parse the URL to get connection parameters
$dbopts = parse_url($db_url);

$host = $dbopts["host"];
$port = $dbopts["port"];
$dbname = ltrim($dbopts["path"],'/');
$user = $dbopts["user"];
$password = $dbopts["pass"];

// Create connection string for pg_connect
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Connect to PostgreSQL
$con = pg_connect($conn_string);

if (!$con) {
    die("Error in connection: " . pg_last_error());
}
?>
