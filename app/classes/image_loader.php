<?php

namespace test_mvc\classes;

    class Image_Loader
    {
        public static function load_image($file)
        {
            $path = $_SERVER['SCRIPT_FILENAME'];

            $path = str_replace("index.php", '', $path);
            $path .= "images/";

            $types = array('image/jpg', 'image/png', 'image/jpeg');
            $size = 1024*1024*5;

            $err = '';
            $name = '';

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Проверяем тип файла
                if (!in_array($file['type'], $types))
                {
                    $err = 'Запрещённый тип файла.';
                }
                elseif ($file['size'] > $size)
                {
                    $err = 'Максимальный размер файла 5 Мб.';
                }

                $tmp_name = $file["tmp_name"];
                $name = date('d_m_Y__H_i_s');

                if(empty($err))
                {
                    $result = Image_Loader::img_resize($tmp_name,$path.$name);
                    if(!$result) { $err = 'Не удалось загрузить картинку'; }
                }                
           }

            if (!empty($err)) return false;
            else return $name.'.'.$result;
        }

        private static function img_resize($src, $dest, $rgb = 0xFFFFFF)
        {
            if (!file_exists($src))
                return false;

            $size = getimagesize($src);

            if ($size === false)
                return false;

            $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
            $icfunc = 'imagecreatefrom'.$format;

            if (!function_exists($icfunc))
                return false;

            $width  = 320;
            $height = 240;

            $x_ratio = $width  / $size[0];
            $y_ratio = $height / $size[1];

            if ($height == 0)
            {
                $y_ratio = $x_ratio;
                $height  = $y_ratio * $size[1];
            }
            elseif ($width == 0)
            {
                $x_ratio = $y_ratio;
                $width   = $x_ratio * $size[0];
            }

            $ratio       = min($x_ratio, $y_ratio);
            $use_x_ratio = ($x_ratio == $ratio);

            $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
            $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
            $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
            $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

            if ($size[0]<$new_width && $size[1]<$new_height)
            {
                $width = $new_width = $size[0];
                $height = $new_height = $size[1];
            }

            $isrc  = $icfunc($src);
            $idest = imagecreatetruecolor($width, $height);

            imagefill($idest, 0, 0, $rgb);
            imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

            $dest .= '.'.$format;

            switch ($format)
            {
                case 'jpeg':
                     imagejpeg($idest,$dest,100);
                    break;
                case 'gif':
                    imagegif($idest,$dest);
                    break;
                case 'png':
                    imagepng($idest,$dest);
                    break;
            }

            imagedestroy($isrc);
            imagedestroy($idest);

            return $format;
        }
    }