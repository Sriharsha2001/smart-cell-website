<?php
// Start session if not started
if (!isset($_SESSION)) {
    session_start();
}

// Get database URL from environment variable
$db_url = getenv('DATABASE_URL');

if (!$db_url) {
    die("No DATABASE_URL environment variable set");
}

// Parse the URL to get connection parameters
$dbopts = parse_url($db_url);

$host = $dbopts["host"] ?? null;
$port = $dbopts["port"] ?? 5432; // Default PostgreSQL port
$dbname = isset($dbopts["path"]) ? ltrim($dbopts["path"], '/') : null;
$user = $dbopts["user"] ?? null;
$password = $dbopts["pass"] ?? null;

// Check if required parameters are present
if (!$host || !$dbname || !$user || !$password) {
    die("Missing required database connection parameters");
}

// Create connection string for pg_connect
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Connect to PostgreSQL
$con = pg_connect($conn_string);

if (!$con) {
    die("Error connecting to database: " . pg_last_error());
}
?>
