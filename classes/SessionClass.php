<?php

//session_start();
class SessionClass
{
    //Fields
    private $idKlant;
    private $email;
    private $userrole;

    //Properties
    public function getUserrole()
    {
        return $this->userrole;
    }

    //Constructor
    public function ___construct()
    {
    }

    public function login($loginObject)
    {
        // De velden $id, $email, $userrole een waarde geven.
        //var_dump($loginObject);
        $this->idKlant = $_SESSION['idKlant'] = $loginObject->getIdKlant();
        $this->email = $_SESSION['email'] = $loginObject->getEmail();
        $this->userrole = $_SESSION['userrole'] = $loginObject->getUserrole();

        $usersObject = LoginClass::find_info_by_id($_SESSION['idKlant']);
        //$_SESSION['username'] = $usersObject->getFirstName()." ".
        //$usersObject->getInfix()." ".
        //$usersObject->getLastname();

    }

    public function logout()
    {
        session_unset('idKlant');
        session_unset('email');
        session_unset('userrole');
        session_destroy();
        unset($this->idKlant);
        unset($this->email);
        unset($this->userrole);
    }
}

$session = new SessionClass();
?>