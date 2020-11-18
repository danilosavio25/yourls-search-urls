<?php
/*
Plugin Name: Search URLs by Title
Plugin URI: http://your-own-domain-here.com/articles/hey-test-my-sample-plugin/
Description: Search existent URLs using title as parameter
Version: 1.0
Author: Danilo Savio
Author URI: 
*/

function dss_search_urls_by_title(){


    if( !isset( $_REQUEST['title'] ) ) {
        return array(
			'statusCode' => 400,
			'simple'     => "Need a 'title' parameter",
			'message'    => 'error: missing param',
		);	
    }


    $page = 0;
    $rows = 10;

    if(isset( $_REQUEST['page'] )){
        if(!is_numeric($_REQUEST['page'])){
            return array(
                'statusCode' => 400,
                'simple'     => "Parameter page must be an Integer value",
                'message'    => 'error: Parameter page must be an Numeric value',
            );	
        }
        $page = $_REQUEST['page'];
    }

    if(isset( $_REQUEST['rows'] )){
        if(!is_numeric($_REQUEST['rows'])){
            return array(
                'statusCode' => 400,
                'simple'     => "Parameter rows must be an Integer value",
                'message'    => 'error: Parameter rows must be an Numeric value',
            );	
        }
        $rows = $_REQUEST['rows'];
    }

    $pagination = calc_pagination($page, $rows);

    global $ydb;
    
    $title = $_REQUEST['title'];

	$table_url = YOURLS_DB_TABLE_URL;
	$title  = yourls_sanitize_keyword( $title );

    $sqlQuery = "SELECT * FROM `$table_url` WHERE `title` = :title LIMIT $pagination,$rows";

    $queryResult = $ydb->fetchObjects($sqlQuery, array('title' => $title));
    
    
    $return = [ 
        'statusCode' => 200,
        'message'    => 'success',
        'links'       => array()
    ];
    
    
    if( count($queryResult) == 0 ) {
		// non existent link
		$return = array(
			'statusCode' => 404,
			'message'    => 'Error: title not found',
		);
	} else {
        for ( $i = 0; $i < count($queryResult); $i++) {
            $return['links'][$i] = array(
                    'shorturl' => yourls_get_yourls_site() .'/'. $queryResult[$i]->keyword,
                    'url'      => $queryResult[$i]->url,
                    'title'    => $queryResult[$i]->title,
                    'timestamp'=> $queryResult[$i]->timestamp,
                    'ip'       => $queryResult[$i]->ip,
                    'clicks'   => $queryResult[$i]->clicks,
            );
        }
		
    }
    
    return $return;
}

function calc_pagination($page, $rows){
    if($page == 0 || !$page){
        return 0;
    }

    return ($page - 1) * $rows;
}
yourls_add_filter( 'api_action_search_urls_by_title', 'dss_search_urls_by_title' );
