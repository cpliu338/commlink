<?php
namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\Network\Http\Client;

class Itnrs3Authenticate extends BaseAuthenticate {

	public function authenticate(Request $request, Response $response) {
		$sid = urlencode($request->data['sid']);
		$password = urlencode($request->data['password']);
    	$http = new Client(['headers'=>['Accept'=>'application/json']]);
    	$resp = $http->get("http://10.29.3.87/pcard/users/authenticate?sid=$sid&pwd=$password");
		$json = $resp->body('json_decode');
		if ($json)
			return ['user'=>$json->user];
		else
			return ["user"=>[]];
	}

}
