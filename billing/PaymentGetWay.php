<?php

namespace Billing;

use Illuminate\Support\Facades\Http;

class PaymentGetWay
{

	public function url()
	{
		return config('services.mpesa.auth.url');
	}

	public function token()
	{
		$response = Http::withBasicAuth(
			config('services.mpesa.auth.username'),
			config('services.mpesa.auth.secret')
		)
			->get($this->url())
			->json();


		return $response['access_token'];
	}

	public function payTo($number, $amount)
	{
		$response = Http::withToken($this->token())
			->post($this->payPillUrl(), [
				"BusinessShortCode" =>  config('services.mpesa.paybill.business_code'),
				"Password" =>  config('services.mpesa.paybill.password'),
				"Timestamp" => "20160216165627",
				"TransactionType" =>  config('services.mpesa.paybill.type'),
				"Amount" => $amount,
				"PartyA" => $number,
				"PartyB" => config('services.mpesa.paybill.business_code'),
				"PhoneNumber" => $number,
				"CallBackURL" => config('services.mpesa.paybill.callback_url'),
				"AccountReference" => config('services.mpesa.paybill.refrence'),
				"TransactionDesc" => "Test"
			]);

		return $response;
	}

	public function payPillUrl()
	{
		return config('services.mpesa.paybill.url');
	}
}
