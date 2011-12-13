<?php
/**
* autoTweet.php
* A quick & dirty way of automating tweets with OAuth using PHP/MYSQL
* @author Clement Ongera <cnongera@gmail.com>
* @license GNU Public License
*/

//configurations
$host = "localhost";
$username = "root";
$password = "";
$database = "twabase";

//Get the tweets from the database
$conn = mysql_connect($host,$username,$password);
mysql_select_db($database) or die( "Unable to select database");
$query = ("select twid, tweet from twable where twastus = 0 order by twid asc LIMIT 1"); 
$result = mysql_query($query);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$tweetsId = $row['twid'];
$tweetId = $tweetsId;
$message = $row['tweet'];
$tweets = $message;
//If tweets are longer than 140 characters trancate and put dot dot dot trailers
    if (strlen($tweets) > 140){
		$tweets = substr($tweets, 0, 136)."...";
        }

}

$response = postTweet($tweets);
print "Tweet Id: " . $tweetId . "<br>";

//If the tweet hasn't been twitted display the error code
if ($response !== 200) {
    echo 'Tweet Not Tweeted! <br>';
	print "Response code: " . $response . "<br>";
	$rCodes = " <a href=\"https://dev.twitter.com/docs/error-codes-responses\">Twitter Error Codes & Responses</a><br />";
	print "More on the response codes: " . $rCodes . "<br>";
	
//if tweet has been twitted then Yaay! Update database
} else {
    //echo 'Tweet Tweeted!<br>';
	print "Tweet: " . $tweets . "<br>";
	
	//Update the database
    $updateStatus = mysql_query("UPDATE twable SET twastus = 1 WHERE twid = $tweetId");
    if($updateStatus) echo "Update: Successful!";
	else
	echo "Update Failed!";
	}
//Close up the connection
mysql_close($conn);

	//function that sends the tweets to twitter
function postTweet($tweets) {
	// I used Matt Harris' OAuth library to make the connection
	// You can get it at: https://github.com/themattharris/tmhOAuth
  require_once('tmhOAuth.php');
  
  //You need to use the actual values from your Twitter application settings
    $connection = new tmhOAuth(array(
    'consumer_key' => '***',
    'consumer_secret' => '***',
    'user_token' => '***',
    'user_secret' => '***',
  )); 
 // Make the API call and return the response. You are done!
 $connection->request('POST',$connection->url('1/statuses/update'),array('status' => $tweets));
   return $connection->response['code'];
}

?>