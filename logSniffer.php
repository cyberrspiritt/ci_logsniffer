<?php
/**
 * Created by PhpStorm.
 * User: cyberrspiritt
 * Date: 04/07/17
 * Time: 17:10
 */

ini_set('max_execution_time', 300); //set script timeout, incase the files to be searched are many

$dir = "app/logs"; //set the directory here
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
    		if($file != '.' || $file != '..'){
				$searchfor = 'validateEmail:'; //pattern to search for

				// the following line prevents the browser from parsing this as HTML.
				header('Content-Type: text/plain');

				// get the file contents, assuming the file to be readable (and exist)
				$contents = file_get_contents($dir.'/'.$file);
				// escape special characters in the query
				$pattern = preg_quote($searchfor, '/');
				// finalise the regular expression, matching the whole line
				$pattern = "/^.*$pattern.*\$/m";
				// search, and store all matching occurences in $matches
				if(preg_match_all($pattern, $contents, $matches)){
				   echo "Found matches:\n";
				   echo implode("\n", $matches[0]);
				   echo "\n";
				}
			}
        }
        closedir($dh);
    }
}