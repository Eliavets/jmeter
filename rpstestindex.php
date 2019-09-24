<?php
//Начало

include 'config.php';
include 'rpsTestClass.php';

//[$%& link ]
$test = new rpsTestClass($config);
//[$ count ]
//<$count <= 0 >
if($test->countRows()<=0){
    //Да
    header('Content-Type: text/plain; charset=utf-8');
    print 'Таблица пуста!';
    $test->fillTable();
    $test->getLastQuery();
}else{
    //Нет
    header('Content-Type: application/json; charset=utf-8');
    $query = "select * from table_ where destination like 'С%'";
    print json_encode($test->assocResult($query));
    //$test->getLastQuery();
}

$database -> $config;

if ($database) {
    $record_numbers = dbase_numrecords ($database);
    for ($i = 1; $i <= $record_numbers; $i++) {
        //выполнение каких-либо действий с записью
    }
}

}
//Конец