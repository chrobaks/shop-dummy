<?php

class SignUpController extends BaseController
{
    private $Model;

    public function __construct ()
    {
        $this->Model = new UserModel();
        $this->setView(['pageTitle' => 'Benutzer-Registrierung']);
    }

    public function setSignUp ()
    {
        $_POST['role'] = '0';
        $_POST = AppValidator::setValidation('signUp', $_POST);

        $formMsg = "Keine Registrierung möglich, die Daten sind nicht korrekt.";

        if (AppValidator::isValid()) {
            if ( ! $this->Model->getUserIsUnique($_POST['email'])) {
                $formMsg = "Keine Registrierung mit dieser Emailadresse möglich.";
            } else {
                $formMsg = "Bitte öffnen Sie ihr Email-Postfach und aktivieren sie ihren Account mit der Email, die wir ihnen geschickt haben.";
           
            }
        }

        $this->setView(['formMsg' => $formMsg]);
    }
}
