<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function passgen() {

        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha);
        $numeric = "0123456789";
        $special = "_!@$#*%<>[]{}";
        $chars = "";

        $passLengthRequirement = 8;
        $numOfPasswords = 366;
        $useAlpha = true;
        $useUpperAlpha = true;
        $useNumeric = true;
        $useSpecial = true;

        // if you want a form like above
        if ($useAlpha == true)
            $chars .= $alpha;

        if ($useUpperAlpha == true)
            $chars .= $alpha_upper;

        if ($useNumeric == true)
            $chars .= $numeric;

        if ($useSpecial == true)
            $chars .= $special;

        $len = strlen($chars);
        $pw = '';

        //header('Content-type: text/plain');
        //header('Content-Disposition: attachment; filename="default-filename.txt"');

        $filename = "master_passwords.xls";
        $export_file = sprintf("%s_%s", date("Y_m_d_H_i_s"), $filename);

        ob_end_clean();

        ini_set('zlib.output_compression','Off');

        header('Pragma: public');
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");                 // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1
        header('Cache-Control: pre-check=0, post-check=0, max-age=0');    // HTTP/1.1
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Content-Transfer-Encoding: none');
        header('Content-Type: application/vnd.ms-excel;');                // This should work for IE & Opera
        header("Content-type: application/x-msexcel");                    // This should work for the rest
        header('Content-Disposition: attachment; filename="'.basename($export_file).'"');

        for($j=0; $j < $numOfPasswords; $j++) {

            $pw = '';
            $pwSentence = '';

            for ($i=0; $i< $passLengthRequirement;$i++) {
                $pw .= substr($chars, rand(0, $len-1), 1);
            }
            // the finished password
            $pw = str_shuffle($pw);
            $pwSentence = $this->getNatoAbbrev($pw);

            printf("\n%s\t%s", $pw, $pwSentence);
        }
    }

    public function getNatoAbbrev($s) {

        $natoAbbr['a'] = 'Alfa';
        $natoAbbr['b'] = 'Bravo';
        $natoAbbr['c'] = 'Charlie';
        $natoAbbr['d'] = 'Delta';
        $natoAbbr['e'] = 'Echo';
        $natoAbbr['f'] = 'Foxtrot';
        $natoAbbr['g'] = 'Golf';
        $natoAbbr['h'] = 'Hotel';
        $natoAbbr['i'] = 'India';
        $natoAbbr['j'] = 'Juliett';
        $natoAbbr['k'] = 'Kilo';
        $natoAbbr['l'] = 'Lima';
        $natoAbbr['m'] = 'Mike';
        $natoAbbr['n'] = 'November';
        $natoAbbr['o'] = 'Oscar';
        $natoAbbr['p'] = 'Papa';
        $natoAbbr['q'] = 'Quebec';
        $natoAbbr['r'] = 'Romeo';
        $natoAbbr['s'] = 'Sierra';
        $natoAbbr['t'] = 'Tango';
        $natoAbbr['u'] = 'Uniform';
        $natoAbbr['v'] = 'Victor';
        $natoAbbr['w'] = 'Whiskey';
        $natoAbbr['x'] = 'X-ray';
        $natoAbbr['y'] = 'Yankee';
        $natoAbbr['z'] = 'Zulu';

        $arr = str_split($s);
        $sentence = '';

        $len = strlen($s);
        for($i=0; $i < $len; $i++) {
            if(ctype_alpha($arr[$i])) {
                $char_index = strtolower($arr[$i]);
                $sentence .= $natoAbbr[$char_index];
                $sentence .= ' ';
            }
            else {
                $sentence .= $arr[$i];
                $sentence .= ' ';
            }
        }

        return $sentence;
    }

    public function randomize_array($arr, $min, $max) {
        $str = '';

        $rand_indexes = array_rand($arr, mt_rand($min, $max)); // get 1 to 4 lowercase characters

        for($i=0; $i < count($rand_indexes); $i++) {
            $str .= $arr[$i];
        }
        return $str;
    }

    // Example : instagram callback action
    public function callback()
    {
        header("content-type: application/json");

        $rtnjsonobj = new \stdClass();

        $rtnjsonobj->enc = $_GET['enc'];
        $rtnjsonobj->enc = base64_decode($rtnjsonobj->enc);

        if(!function_exists('encrypt')) {
            $rtnjsonobj->message = 'does not exist';
        }
        else {
            $cipher = encrypt($rtnjsonobj->enc, 'abcdefghijklmnop', 256);
            $data = base64_encode($cipher);
            $rtnjsonobj->message = urlencode($data);
        }

        echo $_GET['callback']. '('. json_encode($rtnjsonobj) . ')';
        return;
    }

    public function encJSONP()
    {
        $this->load->helper('url');
        $this->load->helper('secure');
        $uri = '';

        if(isset($_GET['enc'])) {
            $data = $_GET['enc'];

            $data = base64_decode($data);
            $cipher = encrypt($data, 'abcdefghijklmnop', 256);
            $data = base64_encode($cipher);
            $data = urlencode($data);
            print $data;
        }
        //$this->webutils->validate($uri);
    }


    public function enc()
    {
        $uri = 'encode this url';

        $data = base64_decode($uri);
        $cipher = encrypt($data, 'abcdefghijklmnop', 256);
        $data = base64_encode($cipher);
        $data = urlencode($data);
        print $data;
    }

    public function enc_New()
    {
        $uri = 'adsfasdfasdfa';

        $data = base64_decode($uri);
        $cipher = encrypt($data, 'abcdefghijklmnop', 256);
        $data = base64_encode($cipher);
        $data = urlencode($data);
        print $cipher;

    }

}
