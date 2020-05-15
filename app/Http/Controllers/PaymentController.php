<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Used to process plans
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\Amount;
use PayPal\Api\RedirectUrls;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Payment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Api;

class PaymentController extends Controller
{
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
        
    }    
    
    public function payWithpaypal(Request $request)
    {
        
        $get = $request->all();
        $producto_pagar = $get['p'];
        $productos_disponibles = array();
        
        if($producto_pagar >= 0 && $producto_pagar < 3)
        {
        $productos_disponibles[0]['Nombre'] = "500 MineCoins | mc.gaming-force.es";
        $productos_disponibles[0]['Precio'] = "5";
        $productos_disponibles[1]['Nombre'] = "1000 MineCoins | mc.gaming-force.es";
        $productos_disponibles[1]['Precio'] = "7";   
        $productos_disponibles[2]['Nombre'] = "1500 MineCoins | mc.gaming-force.es";
        $productos_disponibles[2]['Precio'] = "10";        
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($productos_disponibles[$producto_pagar]['Nombre']) /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($productos_disponibles[$producto_pagar]['Precio']);
        /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        
        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($productos_disponibles[$producto_pagar]['Precio']);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Colaboración voluntaria con el proyecto MC.Gaming-Force.es');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl('https://mc.gaming-force.es/TornadoTPV/status') /** Specify return URL **/
            ->setCancelUrl('https://mc.gaming-force.es/TornadoTPV/status');
        
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        /** dd($payment->create($this->_api_context));exit; **/
        try
        {
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) 
        {
            if (Config::get('app.debug')) {\Session::put('error', 'Connection timeout');

                return Redirect::route('https://mc.gaming-force.es/TornadoTPV/error');

            } else 
            {
                Session::put('error', 'Some error occur, sorry for inconvenient');

                return Redirect::route('https://mc.gaming-force.es/TornadoTPV/error');

            }

        }

        foreach ($payment->getLinks() as $link) 
        {
            if ($link->getRel() == 'approval_url') 
                {
                $redirect_url = $link->getHref();
                break;

                }

        }/** add payment ID to session **/

        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) 
        {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        Session::put('error', 'Unknown error occurred');
        return Redirect::route('https://mc.gaming-force.es/TornadoTPV/pagar');
        }
        else
        {
            echo "El producto solicitado no se encuentra disponible ";
        }

    }    
    //
    
    public function getPaymentStatus()
        {
        
        $user = null;
        if(Auth::id() != null && Auth::id() > 0)
        {
            $user = \App\User::find(Auth::id());
        }
        if($user != null)
        {        
            /** Get the payment ID before session clear **/
            $payment_id = Input::get('paymentId');/** clear the session payment ID **/
            //Session::forget('paypal_payment_id');
            if (empty(Input::get('PayerID')) || empty(Input::get('token'))) 
                {
                    //Session::put('error', 'Payment failed');
                    return view('payment_error',['user' => $user]);
                    //return Redirect::route('/');
                    
                }
                    
                $payment = Payment::get($payment_id, $this->_api_context);
                    
                $execution = new PaymentExecution();
                $execution->setPayerId(Input::get('PayerID'));/**Execute the payment **/
                $result = $payment->execute($execution, $this->_api_context);
                if ($result->getState() == 'approved') 
                    {   
                    
                        $transacciones = $result->getTransactions();
                        
                        foreach($transacciones as $t)
                        {
                            
                            $items = $t->item_list->items;
                            foreach($items as $i)
                            {
                                $cantidad = 0;
                                if(strpos("500", $i->name) !== false)
                                {
                                    $user->minecoins = $user->minecoins + 500;                                   
                                    $cantidad = 500;
                                }
                                if(strpos("1000", $i->name) !== false)
                                {
                                    $user->minecoins = $user->minecoins + 1000;
                                    $cantidad = 1000;
                                }       
                                if(strpos("1500", $i->name) !== false)
                                {
                                    $user->minecoins = $user->minecoins + 1500;
                                    $cantidad = 1500;
                                }    
                                
                                $user->save();
                                $id_grupo = -377733215;
                                    $telegram = new Api(env('TELEGRAM_TOKEN'));
                                    $telegram->sendMessage([
                                   'chat_id' => $id_grupo,
                                   'parse_mode' => "HTML",
                                   'text' => "El usuario ".$user->nick." ha comprado : ".$cantidad." minecoins"
                               ]);                                
                            }
                        }
                    
                        return view('payment_success',['user' => $user]);
                        
                    }
                        
                    Session::put('error', 'Payment failed');
                        return view('payment_error',['user' => $user]);
                    
            //return Redirect::route('/');}   
        }
        }
}
