<?php


class rpsTestClass
{
    /** @var mysqli $link */
    public $link;
    private $host;
    private $user;
    private $password;
    private $database;

    private $last_query;

    /**
     * rpsTestClass constructor.
     * @param string[] $config
     */
    public function __construct($config)
    {
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        $this->setLink();
    }


    /**
     * @param mixed $link
     */
    public function setLink()
    {
        $this->link = new mysqli($this->host, $this->user, $this->password, $this->database);
    }

    public function countRows(){
        $query = 'select count(id) amount from table_';
        $this->last_query = $query;
        $result = $this->assocResult($query);
        return $result[0]['amount'];
    }


    public function assocResult($query){
        $this->last_query = $query;
        $res = $this->link->query($query);
        $out = array();
        while ($row = $res->fetch_assoc()){
            $out[] = $row;
        }
        return $out;
    }

    public function fillTable()
    {
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

            $query = "INSERT INTO table_ (  Agent, 
                                            `type`, 
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
                                            h323_conf_id, 
                                            connect_time, 
                                            `number`
                                            )
                        VALUES " . join(',', $parts) . " ";
            $this->last_query = $query;
            $this->link->query($query);

    }

    public function getLastQuery($silent=false){
        if(!$silent) {
            print $this->last_query;
        }
        return $this->last_query;
    }

}