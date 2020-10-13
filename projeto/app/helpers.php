<?php

/***********
 * DEBUG
*************/
if(!function_exists('dumper')){
    function dumper($params = []){
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        die();
    }
}

/**************
 * FILES E URLS
***************/
if(!function_exists('base_path')){
    function base_path($path = '')
    {
        return __DIR__ . '/..//' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if(!function_exists('url')){
    function url(string $path = null): string
    {
    
        if ($path) {
            return "http://localhost" . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
    
        return "http://localhost";
    }
}


if(!function_exists('redirect')){
    function redirect(string $url): void
    {
        header("HTTP/1.1 302 Redirect");
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            header("Location: {$url}");
            exit;
        }
    
        if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
            $location = url($url);
            header("Location: {$location}");
            exit;
        }
    }
}



/**************
 * USER AND PASSWORD
***************/
if(!function_exists('user')){
    function user(): ?\App\Model\User
    {
        return \App\Model\Auth::user();
    }
}

if(!function_exists('is_password')){
    function is_password(string $password, $min, $max): bool
    {
        if (password_get_info($password)['algo'] || (mb_strlen($password) >= $min && mb_strlen($password) <= $max)) {
            return true;
        }

        return false;
    }
}

if(!function_exists('hash_password')){
    function hash_password(string $password): string
    {
        if (!empty(password_get_info($password)['algo'])) {
            return $password;
        }
    
        return password_hash($password, PASSWORD_DEFAULT, ["cost" => 10]);
    }
}

if(!function_exists('hash_verify')){
    function hash_verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
if(!function_exists('password_rehash')){
    function password_rehash(string $hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_DEFAULT, ["cost" => 10]);
    }
}

/**************
 * CSRF
***************/

if(!function_exists('csrf')){
    function csrf(): string
    {
        $session = new App\Core\Session();
        $session->csrf();
        return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
    }
}


/*********
 * DATAS
 **********/

if (!function_exists('ConverteData')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function ConverteData($data){
        return date("d/m/Y", strtotime($data));
    }
}

if (!function_exists('dataUS')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function dataUS($data)
    {/// converter data para padrão do banco
        $mydata = substr($data,6,4)."-".substr($data,3,2)."-".substr($data,0,2);
        return $mydata;
    }
}