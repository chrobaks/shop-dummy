<?php

class PaymentController extends BaseController
{
    private $ArticleModel;
    private $UserModel;

    public function __construct ()
    {
        $this->ArticleModel = new ArticleModel();
        $this->UserModel = new UserModel();
        
        $this->setView(['pageTitle' => 'Bestellung / Zahlungs-Einstellungen']);
    }

    public function setPayment ()
    {
        if (!AppSession::hasValue('shopCart')) {
            return false;
        }

        if (isset($_POST['payment_type'])) {

            $shopCart = $this->ArticleModel->getShopCart(AppShopCart::getShopCartList());
            $shopCart['shopCountList'] = $_SESSION['shopCart'];
            
            if ($this->UserModel->setUserOrder($shopCart)) {
                $this->setView(['formMsg' => 'Die Bestellung wurde erfolgreich gespeichert!']);
            } else {
                $this->setView(['formMsg' => 'Die Bestellung konnte nicht gespeichert werden!']);
            }

            $this->setView(['pageTitle' => 'Bestellung / Zahlungs-Bestätigung']);

            AppSession::setValues(['shopCart' => []]);
        }
    }
}
