<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Lib\Helper;

use Firebase\JWT\JWT;

class JwtAuthentication
{
    private $_jwtKey;

    protected $requestAttribute;

    protected $algorithm = ["HS256", "HS512", "HS384"];

    public function __construct($jwtKey, $requestAttribute = '')
    {
        $this->_jwtKey = $jwtKey;
        $this->requestAttribute = $requestAttribute;
    }

    public function getRequestAttribute()
    {
        return $this->requestAttribute;
    }

    public function createToken($privateClaim = array())
    {
        $now = new \DateTime();
        $expirationDate = new \DateTime("now +50 minute");
        $jti = base64_encode(random_bytes(16));
        $payload = [
            'iat' => $now->getTimestamp(),
            'exp' => $expirationDate->getTimestamp(),
            'jti' => $jti
        ];
        $payload = array_merge($payload, $privateClaim);

        return JWT::encode($payload, $this->_jwtKey, 'HS256');
    }

    public function decodeToken($token)
    {
        try {
            return JWT::decode(
                $token,
                $this->_jwtKey,
                (array) $this->algorithm
            );
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            return false;
        }
    }
}