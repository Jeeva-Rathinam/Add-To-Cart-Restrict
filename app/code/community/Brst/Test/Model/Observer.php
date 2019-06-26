<?php
ini_set('display_errors', '1');

// Mage::log('Hy observer called', null, 'logfile.log');
class Brst_Test_Model_Observer
{
    //Put any event as per your requirement
    public function logCartAdd() {
        $product = Mage::getModel('catalog/product')
                        ->load(Mage::app()->getRequest()->getParam('product', 0));
        $cart_qty = (int) Mage::getModel('checkout/cart')->getQuote()->getItemsQty();

        if ($product->getId()==31588 && cart_qty > 0) {
            Mage::throwException("You can not add This special Product, empty cart before add it");
        }

        // $quote = Mage::getSingleton('checkout/session')->getQuote();
        // if ($quote->hasProductId(2)) 
        //{
        //  Mage::getSingleton("core/session")->addError("Cart has Special Product you can not add another");
        //  return;
        // }
        $quote = Mage::getModel('checkout/cart')->getQuote();
        foreach ($quote->getAllItems() as $item) {
            $productId = $item->getProductId();
            if($productId==31588){
                Mage::throwException("Cart has Special Product you can not add another");
            }
        }

    }
}
?>