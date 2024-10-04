<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // ====================THANH TOÁN VNPAY==================== //

    public function vnPayPayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://datn-hn5.test/";
        $vnp_TmnCode = "1U83ZQU1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "WEFJK48ZJU89ZE87ITT22GQ06JCNPP8B"; //Chuỗi bí mật
        $vnp_TxnRef = '123458'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán vnpay test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';

        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    // ====================END THANH TOÁN VNPAY==================== //

    // ================================================================================ //

    // ====================THANH TOÁN MOMO==================== //

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    // Hàm thực hiện thanh toán qua Momo
    public function moMoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        // Các thông tin cấu hình của Momo
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";  // Số tiền thanh toán
        $orderId = time() . "";
        $returnUrl = route('momo.return');  // Đường dẫn sau khi thanh toán xong
        $notifyUrl = route('momo.notify');  // Đường dẫn để nhận thông báo từ Momo (nên là URL có thể truy cập công khai)
        $bankCode = "SML";

        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = ""; // Thông tin thêm (nếu có)

        // Tạo chuỗi để ký
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyUrl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Tạo dữ liệu gửi đến Momo
        $data = array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        // Gửi yêu cầu tới Momo và nhận phản hồi
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Kiểm tra và chuyển hướng người dùng tới trang thanh toán của Momo
        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']); // Chuyển hướng tới cổng thanh toán
        } else {
            return back()->withErrors('Đã xảy ra lỗi khi tạo thanh toán.');
        }
    }

    // Xử lý sau khi thanh toán thành công
    public function returnPayment(Request $request)
    {
        // Xử lý logic sau khi thanh toán thành công (nếu có)

        // Sau đó chuyển hướng về trang chủ
        return redirect()->route('home')->with('message', 'Thanh toán thành công!');
    }

    // Xử lý thông báo từ Momo
    public function notifyPayment(Request $request)
    {
        // Xử lý thông báo từ Momo
        Log::info('Momo payment notify: ', $request->all());

        return response()->json(['status' => 'success']);
    }

    // ====================END THANH TOÁN MOMO==================== //

    // ================================================================================ //

    // ====================THANH TOÁN ZALOPAY==================== //

    public function zaloPayPayment(Request $request)
    {
        $config = [
            "app_id" => 2553,
            "key1" => "PcY4iZIKFCIdgZvA6ueMcMHHUbRLYjPL",
            "key2" => "kLtgPl8HHhfvMuDHPwKfgfsY4Ydm9eIz",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
        ];
        
        $embeddata = json_encode(['redirecturl' => 'http://datn-hn5.test']); // Merchant's data
        $items = '[]'; // Merchant's data
        $transID = rand(0,1000000); //Random trans id
        $order = [
            "app_id" => $config["app_id"],
            "app_time" => round(microtime(true) * 1000), // miliseconds
            "app_trans_id" => date("ymd") . "_" . $transID, // translation missing: vi.docs.shared.sample_code.comments.app_trans_id
            "app_user" => "user123",
            "item" => $items,
            "embed_data" => $embeddata,
            "amount" => 150000,
            "description" => "Lazada - Payment for the order #$transID",
            "bank_code" => "",
            // "callback_url" => "http://localhost/zalopay/callback.php",   //
        ];
        
        // appid|app_trans_id|appuser|amount|apptime|embeddata|item
        $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"]
            . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);
        
        $context = stream_context_create([
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order)
            ]
        ]);
        
        $resp = file_get_contents($config["endpoint"], false, $context);
        $result = json_decode($resp, true);
        
        if($result['return_code'] == 1){ //
            header("Location:" .$result['order_url']);
            exit;
        }
        
        foreach ($result as $key => $value) {
            echo "$key: $value<br>";
        }
    }

    // ====================END THANH TOÁN ZALOPAY==================== //
}
