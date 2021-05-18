<?php
namespace Core;

/**
 * Class Helper
 */
class Url
{
    /**
     * @param $path
     * @param $name
     * @param array $params
     * @return string
     */
    public static function getLink($path, $name, $params = [])
    {
        if (!empty($params)) {
            $firts_key = array_keys($params)[0];
            foreach($params as $key=>$value) {
                $path .= ($key === $firts_key ? '?' : '&');
                $path .= "$key=$value";
            }
        }
        return '<a href="' . Route::getBP() . $path .'">' .$name . '</a>';
    }

}