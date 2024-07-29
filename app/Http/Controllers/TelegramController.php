<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTelegram;
use App\Models\Telegram;

class TelegramController extends Controller
{
    private static $sender;

    public function take(Request $request)
    {
        self::$sender = $request['message']['chat']['id'];


        // тут у тебя будет роутинг
        if(str_contains($request['message']['text'], 'USER_CODE:')){
            self::connect_user(str_replace('USER_CODE:', '', $request['message']['text']));
            die;
        }

        Telegram::ans(self::$sender, "i don't undastand");
    }

    public function connect_user($code)
    {
        $u_t = UserTelegram::where('secret', $code)->first();
        
        if(is_null($u_t)){
            Telegram::ans(self::$sender, "i don't undastand");
            die;
        }

        if($u_t->status == 0){
            $u_t->status = 1;
            $u_t->chat_id = self::$sender;
            $u_t->save();

            Telegram::ans(self::$sender, "User connected");
            die;
        }

        if($u_t->status == 1){
            Telegram::ans(self::$sender, "User already connected");
            die;
        }
    }

    public function getCode(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
        ]);

        $u_t = UserTelegram::where('user_id', $request['user_id'])->first();

        if(is_null($u_t)){
            $code = self::randomString();

            $u_t = new UserTelegram;
            $u_t->user_id = $request['user_id'];
            $u_t->secret = $code;
            $u_t->status = 0;
            $u_t->save();

            return response()->json([
                'status' => true,
                'code' => 'USER_CODE:'.$code,
            ]);
        }

        if($u_t->status == 0){
            $code = self::randomString();

            $u_t->secret = $code;
            $u_t->save();

            return response()->json([
                'status' => true,
                'code' => 'USER_CODE:'.$code,
            ]);
        }

        if($u_t->status == 1){
            return response()->json([
                'status' => false,
                'message' => 'User already connect',
            ]);
        }
    }

    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, (strlen($characters) - 1))];
        }
        return $randstring;
    }
}
