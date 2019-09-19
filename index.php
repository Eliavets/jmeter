<?php
/*echo "<pre>";

$login = ($_POST['login']);
$password = ($_POST['password']);
$phone = ($_POST['phone']);

function issetParams($login, $password, $phone)
{
    if ($login = preg_match('/^[A-Za-z]+[A-Za-z0-9_-]{3,15}$/', $login) && $password = preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$/', $password) && $phone = preg_match('/^((8|\+7)[\- ]?)[0-9]{10}$/',$phone)) {
        if (isset ($_POST['login']) && isset($_POST['password']) && isset($_POST['phone'])) {
            echo "Successful registration\n";
        }

    } else {
        echo "Error\n";
    }
}
issetParams($login, $password, $phone);
function validateLogin($login)
{
    if ($login = preg_match('/^[A-Za-z]+[A-Za-z0-9_-]{3,15}$/',$login, $matches))
    {
        print "login ok: ".$matches[0]."\n";
    }
    else
    {
        print "login doesn't match the format. error\n";
    }
}

validateLogin($login);

function validatePassword($password)
{
    if ($password = preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$/',$password, $matches))
    {
        print "password ok: ".$matches[0]."\n";
    }
    else
    {
        print "password doesn't match the format. error\n";
        return $password=NULL;
    }

}
validatePassword($password);

function validatePhone($phone)
{
    if ($phone = preg_match('/^((8|\+7)[\- ]?)[0-9]{10}$/',$phone, $matches))
    {
        print "phone ok: ".$matches[0]."\n";
    }
    else
    {
        print "Phone doesn't match the format +7 *** *** ** **. error\n";
    }

}
validatePhone($phone);
?>*/













