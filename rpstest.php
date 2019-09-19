<?php
//print "ok";
//exit();
usleep(rand(1000000,2000000));
/*
 * {
                "cli": "78123057431",
                "disconnect_cause": "16",
                "setup_time_ms": "259",
                "destination": "Санкт-Петербург",
                "used_quantity": "4",
                "customer_local_time": "2019-07-29 23:49:46",
                "call_id": "655317beb24211e9971f3863bb43493c_00015D3F5BE814B1",
                "charged_time": "4",
                "result": "successful",
                "account_id": "78122134112",
                "h323_conf_id": "BB6427E9 1671301D 854BC751 E18990F0",
                "connect_time": "2019-07-29 23:49:46",
                "cld": "78126033330",
                "curr": "RUB",
                "charged": 0
            },
 *
 * */
/*$res = array();
for ($i=0;$i<rand(1,1);$i++){
    $res[] = array(

            "cli"=> "78123057431",
                "input_data"=>json_decode(file_get_contents("php://input" )),
                "disconnect_cause"=> "16",
                "setup_time_ms"=> rand(0,1000),
                "destination"=> "Санкт-Петербург",
                "used_quantity"=> "4",
                "customer_local_time"=> date("Y-m-d H:i:s",rand(0,time())),
                "call_id"=> "655317beb24211e9971f3863bb43493c_00015D3F5BE814B1",
                "charged_time"=> rand(0,100),
                "result"=> "successful",
                "account_id"=> "78122134112",
                "h323_conf_id"=> "BB6427E9 1671301D 854BC751 E18990F0",
                "connect_time"=> date("Y-m-d H:i:s",rand(0,time())),
                "cld"=> "78126033330",
                "curr"=> "RUB",
                "charged"=> 0
    );
}
header('content-type: application/json');
print json_encode($res);*/


$host = "lrn.test";
$user = "root";
$password = "";
$database = "lrn";

// Create connection
$link = mysqli_connect($host, $user, $password, $database)
or die("Connection failed: " . mysqli_error($link));

$q = "insert into 
      cdr_accounts(
        agent,
        type,
        start_date,
        finish_date,
        cli,
        input_data,
        setup_time_ms,
        destination,
        customer_local_time,
        call_id,
        charged_time,
        result,
        account_id,
        h323_call_id,
        connect_time,
        
        number) 
    values";

$parts = [];
for ($i=0;$i<10000;$i++) {
    if (rand(1, 1000) > 5) {
        $agent = rand(1, 20);
    } else {
        $agent = rand(21, 10000);
    }

    $types = ['incoming', 'forward', 'callback', 'outgoing'];

    $parts[] = sprintf("(
        %d,
        %d,
        '%s',
        '%s',
        '%s',
        '%s',
        %d,
        '%s',
        '%s'
    )",
        $agent,
        rand(1,6),
        date("Y-m-d H:i:s",time()-rand(1,126144000)),
        date("Y-m-d H:i:s",time()-rand(1,126144000)),
        sha1(microtime(true)."".rand(1,100)),
        sha1(microtime(true)."".rand(1,100)),
        rand(1,3600),
        '7'.rand(800,999).str_pad(rand(0,9999999),7,'0', STR_PAD_LEFT),
        rand(1,6)
    );

//print $q;
}

$z = $db->exec(
    $q.implode(',',$parts)
);

if ($z>0){
    print "ok";
}else{
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    print "error";


    $agent_length = rand(5,15);
    $agent_name = '';
    for($i=0;$i<$agent_length;$i++){
        $agent_name .= chr(ord('A')+rand(0,25));
    }

//$agent_name = substr(md5(rand(0,100).microtime(true)),0, rand(5,15));

    $type_arr = array("forwarded", "incoming", "missed", "dialed","callback");
    $type_rand = '';

    $type_rand = array_rand($type_arr, 1);
    echo $type_rand;


    die($type_rand);




    $sql = "INSERT INTO table_ (Agent, type_, start_date, finish_date, cli, input_data, disconnect_cause, setup_time_ms, destination, used_quantity, customer_local_time, 
call_id, charged_time, result, account_id, h323_conf_id, connect_time, cld, curr, charged)
VALUES ($Agent, ";
    $result = mysqli_query($link, $sql) or die ("Connection failed: " . mysqli_error($link));

    mysqli_close($link);
