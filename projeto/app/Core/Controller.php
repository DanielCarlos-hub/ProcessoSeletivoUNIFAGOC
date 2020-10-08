<?php

namespace App\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Core\Session;
use App\Model\Auth;
use App\Support\Message;
use Firebase\JWT\JWT;

/**
 * Classe Controller base
 */
class Controller
{

    protected $request;
    protected $message;
    protected $session;
    protected $response;
    protected $json;

    public function __construct()
    {
        
        $this->request = Request::createFromGlobals();
        $this->message = new Message();
        $this->session = new Session();
        $this->response = new Response();
        $this->json = new JsonResponse();
    }

    /**
     * @param string $view
     * @param array $params
     * 
     * Twig load views
     */
    protected function load(string $view, $params = [])
    {
        
        $twig = new \Twig\Environment((new \Twig\Loader\FilesystemLoader('../app/View/')), 
            ['cache' => false, 'debug' => true]
        );
        $twig->addGlobal('ASSET', ASSET);
        $twig->addGlobal('user', user());

        echo $twig->render($view . '.twig.php', $params);
    }

    /**
     * Verifica se usuário está autenticado ou não;
     */
    public function authenticated()
    {
        if(!Auth::user()){
            redirect("/");
        }
    }

    public function tokenVerify()
    {
        $auth = $this->request->headers->get('Authorization');
        if($auth){

            list($jwt) = sscanf( $auth, 'Bearer %s');
            
            if ($jwt) {
                
                try {

                    $decode = JWT::decode($jwt, SECRET, [ALGORITHM]);

                    $token = [
                        'token' => $decode,
                        'http' => 200
                    ];
    
                } catch (\Exception $e) {
                    
                    $token = [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage(),
                        'http' => 401

                    ];
                }
            } else {
                $token = [
                    'message' => 'Token não encontrado',
                    'http' => 400
                ];
            }
        } else {
            $token = [
                'message' => 'Token não encontrado no cabeçalho HTTP',
                'http' => 400
            ];
        }

        return $token;
    }

}