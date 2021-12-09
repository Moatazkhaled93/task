<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class UserValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user = DB::select("SELECT * FROM users inner join entity_user on entity_user.user_id = users.id and entity_user.deleted_at is null
                            where (entity_user.email = '{$request->input('email')}' or entity_user.user_id = '{$request->input('user_id')}' 
                            or entity_user.rfid_number ='{$request->input('rfid_number')}' 
                            or entity_user.phone ='{$request->input('phone')}') 
                            and entity_user.entity_id = '{$request->input('entity_id')}'");
        if ($user) {
            $message = [];
            foreach ($request->all() as $key => $input) {
                if ($key == 'email' && $input == $user[0]->email) {
                    $message['email'] = ['The user email field already used'];
                }
                if ($key == 'user_id' && $input == $user[0]->user_id) {
                    $message['userId'] = ['The user userId field already used'];
                }
                if ($key == 'rfid_number' && trim($input) == $user[0]->rfid_number) {
                    $message['RFID'] = ['The user RFID field already used'];
                }
                if ($key == 'phone' && $input == $user[0]->phone) {
                    $message['phone'] = ['The user phone field already used'];
                }
            }
            if (count($message) > 0) {
                return new JsonResponse(['message' => 'The given data was invalid.', 'errors' => $message], 400);
            }
        }
        return $next($request);
    }

}
