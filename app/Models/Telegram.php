<?php
namespace App\Models;

use Illuminate\Support\Facades\Log;

/**
 * Class Telegram
 */
class Telegram
{
    public static function ans($who, $text)
    {
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $telegram_uri = 'https://api.telegram.org/bot';
        $telegram_bot_token = env('TELEGRAM_BOT_TOKEN');
        $chat_id_dima = $who;
        $parse_mode = 'HTML';

        $message = $text;

        try {
            $url = $telegram_uri.$telegram_bot_token.'/sendMessage?parse_mode='.$parse_mode.'&chat_id='.$chat_id_dima.'&text='.urlencode($message);
            $out = file_get_contents($url);
        } catch (Exception $e) {
            echo 'Выброшено исключение: '.$e->getMessage()."\n";
        }
    }
}