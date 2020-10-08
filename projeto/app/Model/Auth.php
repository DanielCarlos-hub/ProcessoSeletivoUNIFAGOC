<?php

namespace App\Model;

use App\Core\Model;
use App\Core\Session;
use App\Model\User;
use Firebase\JWT\JWT;

/**
 * Class Autenticação
 */
class Auth extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["id"], ["email", "password"]);
    }

    /**
     * @return null|User
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * log-out
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    public function attempt(string $username, string $password): ?User
    {
        if (!hash_password($password)) {
            return null;
        }

        $user = (new User())->findByUsername($username);
        if (!$user) {
            return null;
        }

        if (!hash_verify($password, $user->password)) {
            return null;
        }
        
        if (password_rehash($user->password)) {
            $user->password = $password;
            $user->save();
        }

        return $user;
    }
    /**
     * @param string $email
     * @param string $password
     * @param bool $save
     * @return bool
     */
    public function login(string $username, string $password): bool
    {
        $user = $this->attempt($username, $password);
        if (!$user) {
            return false;
        }

        //LOGIN
        (new Session())->set("authUser", $user->id);
        return true;
    }

    public function jwt_encode()
    {
        if($this->user()){            
            $payload = [
                'iat'  => time(),
                'jti'  => base64_encode(openssl_random_pseudo_bytes(32)),
                'iss'  => BASE,
                'nbf'  => time()+2,
                'exp'  => time()+3600,
                'data' => [
                    'userId'   => $this->user()->id, // userid from the users table
                    'userName' => $this->user()->username,
                    'userRole' => $this->user()->role // User role
                ]
            ];

            $user = [                  // Data related to the signer user
                'userId'   => $this->user()->id, // userid from the users table
                'userName' => $this->user()->username,
                'userRole' => $this->user()->role // User role
            ];
    
            $jwt = JWT::encode(
                $payload,   
                SECRET,
                ALGORITHM
            );

            $unencodedArray = ['jwt' => $jwt, 'user' => $user];
            return json_encode($unencodedArray);

        } else {
            header('HTTP/1.0 401 Unauthorized');
        }
        
    }

}
