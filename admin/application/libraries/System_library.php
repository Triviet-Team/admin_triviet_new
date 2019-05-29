<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'phpmailer/class.phpmailer.php';

class System_library {

    var $CI = '';

    function __construct() {
        $this->CI = & get_instance();
    }

 public function send_mail($to, $setForm, $titleForm, $subject, $body) {
        $mail = new PHPMailer();
        // Gọi đến lớp SMTP
        $mail->IsSMTP();
         
        $mail->SMTPDebug	= 0; 	// Hiển thị thông báo trong quá trình kết nối SMTP
        // 1 = Hiển thị message + error
        // 2 = Hiển thị message
         
        $mail->SMTPAuth		= true;
        $mail->SMTPSecure	= 'ssl';
        $mail->Host			= 'smtp.gmail.com';
        $mail->Port			= 465;
    
        $mail->Username		= 'designweb122995@gmail.com';
        $mail->Password		= 'ongut0966890064';
         
        // Thiết lập thông tin người gửi và email người gửi
        $mail->SetFrom($setForm, $titleForm);
         
        // Thiết lập thông tin người nhận và email người nhận
        $mail->AddAddress($to);
         
        // Thiết lập email reply
        $mail->AddReplyTo($setForm);
         
        // Đính kèm tập tin
        //$mail->AddAttachment('Lighthouse.zip');
         
        // Thiết lập tiêu đề
        $mail->Subject = $subject;
         
        // Thiết lập charset
        $mail->CharSet = 'utf-8';
         
        //$mail->Body = $body;
        $mail->MsgHTML($body);
         
        if($mail->Send()){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    function pagination() {

        $config['enable_query_strings'] = TRUE;
        $config['first_tag_open'] = '<div>';
        $config['first_tag_open'] = '</div>';
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><a class="page-link active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        return $config;
    }

    function pagination_site() {

        $config['reuse_query_string'] = TRUE;

        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        
        $config['first_link'] = 'Đầu';
        $config['first_tag_open'] = '<li class="page-item dkm">';
        $config['first_tag_close'] = '</li>';
         
        $config['last_link'] = 'Cuối';
        $config['last_tag_open'] = '<li class="page-item dkm">';
        $config['last_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item"><a class="page-link active">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');

        return $config;
    }

    function upload($upload_path = '', $file_upload = '') {

        $files = $_FILES[$file_upload];

        if ($files['tmp_name']) {

            $file_name = time() . '_' . addslashes($this->filterName($files['name'], '_'));
            //Thực hiện upload và lưu vào biến tạm
            move_uploaded_file($files['tmp_name'], $upload_path . $file_name);

            $image_link = $file_name;
        }

        return isset($image_link) ? $image_link : '';
    }

    function upload_file($upload_path = '', $file_name = '') {
        $files = $_FILES[$file_name];
        if ($files['name'][0] != null) {
            for ($i = 0; $i < count($files['name']); $i++) {
                $img = addslashes((time() . "_" . $this->filterName($files['name'][$i])));
                $tmp_img = $files['tmp_name'][$i];

                // Thực hiện upload và lưu vào biến tạm
                if(move_uploaded_file($tmp_img, $upload_path . $img)) {
                    $image_list[] = $img;
                }else {
                    $image_list[] = '';
                }
            }
        }
        
        return isset($image_list) ? $image_list : '';
    }

    public function resize_image_crop($image, $width, $height) {
        $w = @imagesx($image); //current width
        $h = @imagesy($image); //current height
        if ((!$w) || (!$h)) {
            $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
            return false;
        }
        if (($w == $width) && ($h == $height)) {
            return $image;
        } //no resizing needed
        //try max width first...
        $ratio = $width / $w;
        $new_w = $width;
        $new_h = $h * $ratio;

        //if that created an image smaller than what we wanted, try the other way
        if ($new_h < $height) {
            $ratio = $height / $h;
            $new_h = $height;
            $new_w = $w * $ratio;
        }

        $image2 = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($image2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

        //check to see if cropping needs to happen
        if (($new_h != $height) || ($new_w != $width)) {
            $image3 = imagecreatetruecolor($width, $height);
            if ($new_h > $height) { //crop vertically
                $extra = $new_h - $height;
                $x = 0; //source x
                $y = round($extra / 2); //source y
                imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
            } else {
                $extra = $new_w - $width;
                $x = round($extra / 2); //source x
                $y = 0; //source y
                imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
            }
            imagedestroy($image2);
            return $image3;
        } else {
            return $image2;
        }
    }

    public function resize_image_max($image, $max_width, $max_height) {
        $w = imagesx($image); //current width
        $h = imagesy($image); //current height
        if ((!$w) || (!$h)) {
            $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
            return false;
        }

        if (($w <= $max_width) && ($h <= $max_height)) {
            return $image;
        } //no resizing needed
        //try max width first...
        $ratio = $max_width / $w;
        $new_w = $max_width;
        $new_h = $h * $ratio;

        //if that didn't work
        if ($new_h > $max_height) {
            $ratio = $max_height / $h;
            $new_h = $max_height;
            $new_w = $w * $ratio;
        }

        $new_image = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
        return $new_image;
    }

    public function resize_image_force($image, $width, $height) {
        $w = @imagesx($image); //current width
        $h = @imagesy($image); //current height
        if ((!$w) || (!$h)) {
            $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
            return false;
        }
        if (($w == $width) && ($h == $height)) {
            return $image;
        } //no resizing needed

        $image2 = imagecreatetruecolor($width, $height);
        imagecopyresampled($image2, $image, 0, 0, 0, 0, $width, $height, $w, $h);

        return $image2;
    }

    public function resize_image($method, $image_loc, $new_loc, $width, $height) {
        if (!is_array(@$GLOBALS['errors'])) {
            $GLOBALS['errors'] = array();
        }

        if (!in_array($method, array('force', 'max', 'crop'))) {
            $GLOBALS['errors'][] = 'Invalid method selected.';
        }

        if (!$image_loc) {
            $GLOBALS['errors'][] = 'No source image location specified.';
        } else {
            if ((substr(strtolower($image_loc), 0, 7) == 'http://') || (substr(strtolower($image_loc), 0, 7) == 'https://')) { /* don't check to see if file exists since it's not local */
            } elseif (!file_exists($image_loc)) {
                $GLOBALS['errors'][] = 'Image source file does not exist.';
            }
            $extension = strtolower(substr($image_loc, strrpos($image_loc, '.')));
            if (!in_array($extension, array('.jpg', '.jpeg', '.png', '.gif', '.bmp'))) {
                $GLOBALS['errors'][] = 'Invalid source file extension!';
            }
        }

        if (!$new_loc) {
            $GLOBALS['errors'][] = 'No destination image location specified.';
        } else {
            $new_extension = strtolower(substr($new_loc, strrpos($new_loc, '.')));
            if (!in_array($new_extension, array('.jpg', '.jpeg', '.png', '.gif', '.bmp'))) {
                $GLOBALS['errors'][] = 'Invalid destination file extension!';
            }
        }

        $width = abs(intval($width));
        if (!$width) {
            $GLOBALS['errors'][] = 'No width specified!';
        }

        $height = abs(intval($height));
        if (!$height) {
            $GLOBALS['errors'][] = 'No height specified!';
        }

        if (count($GLOBALS['errors']) > 0) {
            $this->echo_errors();
            return false;
        }
        
        if (in_array($extension, array('.jpg', '.jpeg'))) {
            $image = @imagecreatefromjpeg($image_loc);
        } elseif ($extension == '.png') {
            $image_loc;
            $image = @imagecreatefrompng($image_loc);
        } elseif ($extension == '.gif') {
            $image = @imagecreatefromgif($image_loc);
        } elseif ($extension == '.bmp') {
            $image = @imagecreatefromwbmp($image_loc);
        }

        if (!$image) {
            $GLOBALS['errors'][] = 'Image could not be generated!';
        } else {
            $current_width = imagesx($image);
            $current_height = imagesy($image);
            if ((!$current_width) || (!$current_height)) {
                $GLOBALS['errors'][] = 'Generated image has invalid dimensions!';
            }
        }
        if (count($GLOBALS['errors']) > 0) {
            @imagedestroy($image);
            $this->echo_errors();
            return false;
        }

        if ($method == 'force') {
            $new_image = $this->resize_image_force($image, $width, $height);
        } elseif ($method == 'max') {
            $new_image = $this->resize_image_max($image, $width, $height);
        } elseif ($method == 'crop') {
            $new_image = $this->resize_image_crop($image, $width, $height);
        }

        if ((!$new_image) && (count($GLOBALS['errors'] == 0))) {
            $GLOBALS['errors'][] = 'New image could not be generated!';
        }
        if (count($GLOBALS['errors']) > 0) {
            @imagedestroy($image);
            $this->echo_errors();
            return false;
        }

        $save_error = false;
        if (in_array($extension, array('.jpg', '.jpeg'))) {
            imagejpeg($new_image, $new_loc) or ( $save_error = true);
        } elseif ($extension == '.png') {
            imagepng($new_image, $new_loc) or ( $save_error = true);
        } elseif ($extension == '.gif') {
            imagegif($new_image, $new_loc) or ( $save_error = true);
        } elseif ($extension == '.bmp') {
            imagewbmp($new_image, $new_loc) or ( $save_error = true);
        }

        if ($save_error) {
            $GLOBALS['errors'][] = 'New image could not be saved!';
        }
        if (count($GLOBALS['errors']) > 0) {
            @imagedestroy($image);
            @imagedestroy($new_image);
            $this->echo_errors();
            return false;
        }

        @imagedestroy($image);
        @imagedestroy($new_image);

        return true;
    }

    public function echo_errors() {
        if (!is_array(@$GLOBALS['errors'])) {
            $GLOBALS['errors'] = array('Unknown error!');
        }
        foreach ($GLOBALS['errors'] as $error) {
            echo '<p style="color:red;font-weight:bold;">Error: ' . $error . '</p>';
        }
    }

    public function filterName($string, $separator = "_") {
        // remove unnecessary spaces and make everything lower case
        $string = preg_replace("/ +/", " ", strtolower($string));
        // removing a set of reserved characters (rfc2396: ; / ? : @ & = + $ ,)
        $string = str_replace(array(';', '/', '?', ':', '@', '&', '=', '+', '$', ','), $separator, $string);
        $string = str_replace(array("Ã", "Ã€", "áº¢", "Ãƒ", "áº ", "Ã‚", "áº¤", "áº¦", "áº¨", "áºª", "áº¬", "Ä‚", "áº®", "áº°", "áº²", "áº´", "áº¶", "Ã¡", "Ã ", "áº£", "Ã£", "áº¡", "Ã¢", "áº¥", "áº§", "áº©", "áº«", "áº­", "Äƒ", "áº¯", "áº±", "áº³", "áºµ", "áº·"), "a", $string);
        $string = str_replace(array("Ä", "Ä'",), "d", $string);
        $string = str_replace(array("Ã‰", "Ãˆ", "áºº", "áº¼", "áº¸", "ÃŠ", "áº¾", "á»€", "á»‚", "á»", "á»†", "Ã©", "Ã¨", "áº»", "áº½", "áº¹", "Ãª", "áº¿", "á»", "á»ƒ", "á»…", "á»‡"), "e", $string);
        $string = str_replace(array("Ã", "ÃŒ", "á»ˆ", "Ä¨", "á»Š", "Ã­", "Ã¬", "á»‰", "Ä©", "á»‹"), "i", $string);
        $string = str_replace(array("Ã", "Ã", "á»Ž", "Ã•", "á»Œ", "Ã", "á»", "á»'", "á»", "á»–", "á»˜", "Æ ", "á»š", "á»œ", "á»ž", "á» ", "á»¢", "Ã³", "Ã²", "á»", "Ãµ", "á»", "Ã´", "á»'", "á»", "á»•", "á»—", "á»™", "Æ¡", "á»›", "á»", "á»Ÿ", "á»¡", "á»£"), "o", $string);
        $string = str_replace(array("Ãš", "Ã™", "á»¦", "Å¨", "á»¤", "Æ¯", "á»¨", "á»ª", "á»¬", "á»®", "á»°", "Ãº", "Ã¹", "á»§", "Å©", "á»¥", "Æ°", "á»©", "á»«", "á»­", "á»¯", "á»±"), "u", $string);
        $string = str_replace(array("Ã", "á»²", "á»¶", "á»¸", "á»´", "Ã½", "á»³", "á»·", "á»¹", "á»µ"), "y", $string);
        // replace some characters to similar ones
        $search = array(' ', 'ä', 'ö', 'ü', 'é', 'è', 'à', 'ç', 'à', 'è', 'ì',
            'ò', 'ù', 'á', 'é', 'í', 'ó', 'ú', 'ë', 'ï');
        $replace = array($separator, 'a', 'o', 'u', 'e', 'e', 'a', 'c', 'a', 'e', 'i',
            'o', 'u', 'a', 'e', 'i', 'o', 'u', 'e', 'i');
        $string = str_replace($search, $replace, $string);
        $good_characters = "a-z0-9.\\" . $separator;
        $string = preg_replace('/[^' . $good_characters . ']/', '', $string);
        $string = preg_replace("/[" . $separator . "]+/", $separator, $string);
        $string = trim($string, $separator);

        return $string;
    }
    
    public function rand_string( $length ) {
    
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    
        $size = strlen( $chars );
    
        for( $i = 0; $i < $length; $i++ ) {
    
            $str .= $chars[ rand( 0, $size - 1 ) ];
    
        }
    
        return $str;
    
    }

}
