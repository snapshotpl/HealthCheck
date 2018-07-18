<?php
/**
 * Created by PhpStorm.
 * User: witold
 * Date: 18.07.18
 * Time: 22:51
 */

namespace HealthCheck;


class ResultArraySerializer
{
    public static function toArray(Result $result): array
    {
        return [
            'message' => $result->getMessage(),
            'title' => $result->getCheck()->getTitle(),
            'data' => $result->getData(),
        ];
    }
}