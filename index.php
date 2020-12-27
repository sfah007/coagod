<?php
/*
NC
*/
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $_ENV['BOT_TOKEN']; //Your token
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
  bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>$text,
  'parse_mode'=>$mode
  ]);
  }
  
//==============NC======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$username = $update->message->from->username;
$chatid = $update->callback_query->message->chat->id;
$msg = isset($update->message->text)?$update->message->text:'';
$START_MESSAGE = $_ENV['START_MESSAGE'];
$HELP_MENU = $_ENV['HELP_MENU'];
//////Style of Benchamxd/////
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE***",
'parse_mode'=>"MarkDown",
]);
if(strpos($text,"/stats") !== false){ 
$bic = trim(str_replace("/stats","",$text));

$get = json_decode(file_get_contents("https://coronavirus-19-api.herokuapp.com/countries/$bic"),true);
$ab = $get['country'];
$cd = $get['cases'];
$ef = $get['todayCases'];
$gh = $get['todayDeaths'];
$deth = $get['deaths'];
$kl = $get['recovered'];
$mn = $get['active'];
$critic = $get['critical'];
$jok = $get['casesPerOneMillion'];
$joke = $get['deathsPerOneMillion'];
$jokee = $get['testsPerOneMillion'];
$jo = $get['totalTests'];

if($get['cases']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text'=>"***🔥🌀 CORONAVIRUS STATS 🌀🔥



🌐COUNTRY :*** $ab


***⭕ TOTAL CASES :*** $cd

***⭕ TOTAL DEATHS:*** ​$deth


***🔵 TODAY'S CASES :*** $ef

***🔵 TODAY'S DEATHS :*** $gh


***😀 RECOVERED :***  $kl

***🔴 ACTIVE CASES :*** $mn

***🔴 CRITICAL CASES:*** $critic

*Your Command* : $text
*Bot By Nimesh chandhra*",
   'parse_mode'=>"MarkDown",
]);
   
 }
}
?>
