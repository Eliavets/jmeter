<?php
header('Content-Type: text/plain; charset=utf-8');
//header('Content-Type: application/json; charset=utf-8');
    usleep(rand(1000000,2000000));

    $host = "lrn.test";
    $user = "root";
    $password = "";
    $database = "lrn";

// Create connection
$link = mysqli_connect($host, $user, $password, $database)
or die("Connection failed: " . mysqli_error($link));

$counts = "SELECT COUNT(*) FROM table_";
$count = $link->prepare($counts);

$result = $link->query($count) or die ("Connection failed: " . mysqli_error($link));
$count->close();

if ($count = 0) {
    $parts = [];
    for ($i = 0; $i < 10000; $i++) {
        if (rand(1, 1000) > 5) {
            $agent = rand(1, 20);
        } else {
            $agent = rand(21, 10000);
        }

        $types = ['incoming', 'forward', 'callback', 'outgoing'];
        $rand_type = array_rand($types);
        $type = $types[$rand_type];

        $destinations = ['Санкт-Петербург', 'Москва', 'Казань', 'Пенза', 'Саранск', 'Нижний Новгород', 'Екатеринбург', 'Владивосток'];
        $rand_town = array_rand($destinations);
        $destination = $destinations[$rand_town];

        $parts[] = sprintf("(
        %d,
        '%s',
        '%s',
        '%s',
        %s,
        '%s',
        '%s',
        '%s',
         %d,
        '%s',
        '%s',
        '%s',
         %s,
         %d,
        '%s',
         %s
         
        
    )",
            $agent,
            $type,
            $start_date = date("Y-m-d H:i:s", time() - rand(1, 126144000)),
            $finish_date = date("Y-m-d H:i:s", time() - rand(1, 126144000)),
            $cli = '78123057431',
            $input_data = file_get_contents('php://input'),
            $setup_time_ms = rand(0, 1000),
            $destination,
            $customer_local_time = date("Y-m-d H:i:s", time() - rand(1, 126144000)),
            $call_id = sha1(microtime(true) . "" . rand(1, 100)),
            $charged_time = rand(1, 3600),
            $result = rand(1, 100) > 20 ? 'successful' : 'failed',
            $account_id = '78122134112',
            $h323_call_id = sha1(microtime(true) . "" . rand(1, 100)),
            $connect_time = date("Y-m-d H:i:s", time() - rand(1, 126144000)),
            $number = '7' . rand(800, 999) . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT)
        );
    }

    $query = "INSERT INTO table_ (Agent, `type`, start_date, finish_date, cli, input_data, setup_time_ms, destination, customer_local_time,
call_id, charged_time, result, account_id, h323_conf_id, connect_time, `number`)
VALUES " . join(',', $parts) . " ";
    $stmt = mysqli_prepare($link, $query);

    print $query . "\n";
    $result = mysqli_query($link, $query) or die ("Connection failed: " . mysqli_error($link));
    $stmt->close();

}

else {
    print "Таблица заполнена\n";


    $req = "SELECT * from table_ where destination like 'С%' ";
$stmt = $link->prepare($req);
print $req . "\n";
$result = $link->query($req) or die ("Connection failed: " . mysqli_error($link));

while ($row = $result->fetch_assoc()) {
    print_r($row);
    print "\n=================\n";
}
$link->close();
}