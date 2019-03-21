<?php

class PaymentController extends BaseController
{
    private $ArticleModel;
    private $UserModel;

    public function __construct ($appConfig)
    {
        $this->ArticleModel = new ArticleModel($appConfig['mysql']);
        $this->UserModel = new UserModel($appConfig['mysql']);
        
        $this->setView([
            'page' => 'payment',
            'pageTitle' => 'Bestellung / Zahlungs-Einstellungen',
        ]);

        if (!empty($_SESSION['shopCart'])) {
            $this->setPayment();
        }
    }

    private function setPayment ()
    {
        if (isset($_POST['payment_type'])) {

            $shopCart = $this->ArticleModel->getShopCart(AppSession::getShopCartList());
            $shopCart['shopCountList'] = $_SESSION['shopCart'];
            
            if ($this->UserModel->setUserOrder($shopCart)) {
                $this->setView([
                    'formMsg' => 'Die Bestellung wurde erfolgreich gespeichert!',
                    'pageTitle' => 'Bestellung / Zahlungs-Bestätigung',
                ]);
            } else {
                $this->setView([
                    'formMsg' => 'Die Bestellung konnte nicht gespeichert werden!',
                    'pageTitle' => 'Bestellung / Zahlungs-Bestätigung',
                ]);
            }

            AppSession::setValues(['shopCart' => []]);

        } else {
            $this->setView($this->ArticleModel->getShopCart(AppSession::getShopCartList()));
        }
    }
}
