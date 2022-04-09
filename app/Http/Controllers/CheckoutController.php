<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use App\UserOrder;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->makePagseguroSession();

        var_dump(session()->get('pagseguro_session_code'));

        $totalPriceCartItem = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $total = array_sum($totalPriceCartItem);

        return view('checkout', compact('total'));
    }

    public function proccess(Request $request)
    {
        try {
            $user = auth()->user();
            $dataPost = $request->all();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = Uuid::uuid4();

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems)
            ];

            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            $store = (new Store())->notifyStoreOwners($stores);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference
                ]
            ]);
        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processa o pedido!';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {
            $notification = new Notification();
            $notification = $notification->getTransaction();

            $reference = base64_decode($notification->getReference());

            $userOrder = UserOrder::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            return response()->json([], 204);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : '';

            return response()->json(['error' => $message], 500);
        }
    }

    private function makePagseguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
