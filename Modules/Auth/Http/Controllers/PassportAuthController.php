<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\User;

class PassportAuthController extends Controller
{
    /**
     * Registration
     * @param Request $request http request
     * @return ResponseFactory response in Json format
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'name' => 'required|min:4|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Send failed response if validation fails
        if ($validator->fails()) {
            return $this->sendInvalidFieldResponse($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->sendCustomResponse(200,
            [
                'message' => __('auth::auth.register_success'),
                'data'=>[
                    'id'=>$user->id,
                    'email'=>$user->email,
                    'name'=>$user->name
                ]
            ]
        );
    }

    /**
     * Login
     * @param Request $request http request
     * @return ResponseFactory response in Json format
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
        ]);

        // Send failed response if validation fails
        if ($validator->fails()) {
            return $this->sendInvalidFieldResponse($validator->errors());
        }

        //attempts login
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $request->headers->set('Authorization', 'Basic xxxxx');
            $token = auth()->user()->createToken('SMTToken')->accessToken;
            return $this->sendCustomResponse(200,
                [
                    'message' => __('auth::auth.login_success'),
                    'data'=>[
                        'token'=>$token,
                    ]
                ]
            );
        } else {
            return $this->sendUnauthorizedResponse(__('auth::auth.failed'));
        }
    }
}
