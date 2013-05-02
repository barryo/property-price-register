<?php

if( count( $argv ) != 2 || !is_readable( $argv[1] ) )
    die( "Invalid arguments or bad filename\n" );

require( 'config.php' );

if( !( $db = mysql_pconnect( $dbhost, $dbuser, $dbpass ) ) )
    die( "DB error: " . mysql_error() . "\n\n" );
  
if( !( mysql_select_db( $dbname ) ) )
    die( "Could not select MySQL database: " . mysql_error() . "\n\n" );

echo "Erasing existing table information...";

if( !mysql_query( "TRUNCATE `ppr`" ) )
    die( "Could not truncate data table: " . mysql_error() . "\n\n" );

echo "done\n\n";

if( !( $fp = fopen( $argv[1], 'r' ) ) )
    die( "Could not open data file for reading\n" );

echo "Loading and inserting new data...";

mysql_query( "LOCK TABLES ppr WRITE" );
mysql_query( "ALTER TABLE ppr DISABLE KEYS" );


while( ( $r = fgetcsv( $fp, 4096, "," ) ) !== false ) 
{
    $y = substr( $r[0], 6 );
    $m = substr( $r[0], 3, 2 );
    $d = substr( $r[0], 0, 2 );

    $p = preg_replace( "/[^0-9\.]/", "", $r[4] );

    $q = "INSERT INTO ppr VALUES ( 0, \"{$y}-{$m}-{$d}\", "
            . "\"" . mysql_real_escape_string( $r[1] ) 
                . ( strlen( $r[2] ) ? ", " . mysql_real_escape_string( $r[2] ) : '' ) . "\", "
            . "\"" . strtoupper( $r[3] ) . "\", "
            . ( strtoupper( $r[6] ) == 'YES' ? $p * 1.23 : $p ) . ", " 
            . ( strtoupper( $r[5] ) == 'YES' ? 1 : 0 ) . ", "
            . "\"" . mysql_real_escape_string( $r[7] ) . ( strlen( $r[8] ) ? " - " . mysql_real_escape_string( $r[8] ) : '' ) . "\" )\n";

    mysql_query( $q );
}



mysql_query( "ALTER TABLE ppr ENABLE KEYS" );
mysql_query( "UNLOCK TABLES" );

echo "done\n\n";


mysql_close( $db );

  