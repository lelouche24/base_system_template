<?php

namespace App\Helpers;



use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
// use App\Swep\Helpers\__static;
// use App\Swep\Helpers\__dynamic;
// use App\Helpers\__dataType;
use Illuminate\Cache\CacheManager;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Filesystem\FilesystemManager as Storage;
use Illuminate\Support\Facades\App;

class BaseService{



    protected $auth;
    protected $session;
    protected $carbon;
    protected $str;
    protected $__static;
    protected $__dataType;
    protected $event;
    protected $mail;
    protected $storage;
    protected $cache;



    public function __construct(){

        $this->auth = auth()->guard(session('auth_guard', 'web'));
        $this->session = session();
        $this->carbon = App::make(Carbon::class);
        $this->str = App::make(Str::class);
        // $this->__static = App::make(__static::class);
        // $this->__dynamic = App::make(__dynamic::class);
        // $this->__dataType = App::make(__dataType::class);
        $this->event = App::make(Dispatcher::class);
        $this->mail = App::make(Mailer::class);
        $this->storage = App::make(Storage::class);
        $this->cache = App::make(CacheManager::class);
    }

    static $haveUnicode = false;


    public static function html_attribute_encode($str, $default = ''){

		if(empty($str)){
			$str = $default;
		}

	 	settype($str, 'string');

		$out = '';
		$len = mb_strlen($str);

		for($cnt = 0; $cnt < $len; $cnt++){
			$c = BaseService::uniord(BaseService::unicharat($str, $cnt));
			if( ($c >= 97 && $c <= 122) ||
				($c >= 65 && $c <= 90 ) ||
				($c >= 48 && $c <= 57 ) )
			{
				$out .= BaseService::unicharat($str, $cnt);
			}
			else{
				$out .= "&#$c;";
			}
		}

		return $out;

	}

    public static function uniord($u){

		if(BaseService::$haveUnicode == true){
			$c = unpack("N", mb_convert_encoding($u, 'UCS-4BE', 'UTF-8'));
			return $c[1];
		}

		return ord($u);

	}

    public static function unicharat($str, $cnt){

		if(BaseService::$haveUnicode == true){
			return mb_substr($str, $cnt, 1);
		}

		return substr($str, $cnt, 1);

	}




}