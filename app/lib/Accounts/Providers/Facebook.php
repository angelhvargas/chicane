<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 13/07/2015
 * Time: 20:28
 */

namespace Sil\Accounts\Providers;


use Facebook\FacebookClient;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Sil\Accounts\Contracts\Provider as ProviderInterface;
use Facebook\Facebook as FacebookSDK;

class Facebook extends Provider implements ProviderInterface{

    protected $helper;

    /**
     * Facebook constructor.
     * @param $helper
     */
    public function __construct( $helper)
    {
        $this->helper = $helper;
    }


    public function authorize()
    {
        // TODO: Implement authorize() method.
    }

    public function login()
    {
        // TODO: Implement login() method.
    }

    protected function getAuthorizationUrl()
    {
        session_start();


        $facebook = new FacebookSDK(Config::get('facebook'));

        $helper = $facebook->getRedirectLoginHelper();


        $loginUrl = $helper->getLoginUrl(url(),['public_profile', 'email', 'user_friends']);

        return $loginUrl;
    }
}