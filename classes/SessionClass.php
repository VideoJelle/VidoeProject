<?php

//session_start();
class SessionClass
{
    //Fields
    private $idKlant;
    private $email;
    private $userrole;
    private $geblokkeerd;
<<<<<<< HEAD
    private $adres;
    private $woonplaats;
=======
>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d

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
        $this->geblokkeerd = $_SESSION['geblokkeerd'] = $loginObject->getGeblokkeerd();
<<<<<<< HEAD
        $this->adres = $_SESSION['adres'] = $loginObject->getAdres();
        $this->woonplaats = $_SESSION['woonplaats'] = $loginObject->getWoonplaats();
=======
>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d

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
        session_unset('geblokkeerd');
<<<<<<< HEAD
        session_unset('adres');
        session_unset('woonplaats');
=======
>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
        session_destroy();
        unset($this->idKlant);
        unset($this->email);
        unset($this->userrole);
        unset($this->geblokkeerd);
<<<<<<< HEAD
        unset($this->adres);
        unset($this->woonplaats);
=======
>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
    }
}

$session = new SessionClass();
?>