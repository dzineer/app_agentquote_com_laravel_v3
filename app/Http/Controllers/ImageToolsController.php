<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

// http://127.0.0.1:8000/imagetool/ratio?func=rect&width=400&top=6&bottom=9&color_type=h&rrr=255&ggg=0&bbb=0&test=

class ImageToolsController extends Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    var $rows;

    function __construct() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }

    function html2rgb($color) {
        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                $color[2].$color[3],
                $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;

        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

        return array($r, $g, $b);
    }

    function rgb2html($r, $g=-1, $b=-1) {
        if (is_array($r) && sizeof($r) == 3)
            list($r, $g, $b) = $r;

        $r = intval($r); $g = intval($g);
        $b = intval($b);

        $r = dechex($r<0?0:($r>255?255:$r));
        $g = dechex($g<0?0:($g>255?255:$g));
        $b = dechex($b<0?0:($b>255?255:$b));

        $color = (strlen($r) < 2?'0':'').$r;
        $color .= (strlen($g) < 2?'0':'').$g;
        $color .= (strlen($b) < 2?'0':'').$b;
        return '#'.$color;
    }

    public function ratio(Request $request) {
        // Create a 200 x 200 image

        $data = $this->validate($request, [
            'func' => 'required',
            'width' => 'required',
            'top' => 'required',
            'bottom' => 'required',
            'color_type' => 'required',
            'rrr' => 'required',
            'ggg' => 'required',
            'bbb' => 'required',
            'text'
        ]);

        /*

         */

/*        return response()->json([
            "data" => $data
        ]);*/

        $fn = $data['func'];

        //	printf("<pre>fn: %s", $fn);

        switch($fn) {
            case 'rect':

                $ratio = $data['top']/$data['bottom'];

                $height = round($data['width'] / $ratio);

                $font = intval( 16 );

                $color = $data['color_type'];

                if( strlen($color) == 'hex') {
                    list($rrr, $ggg, $bbb) = $this->html2rgb( $color );
                }

                //$canvas = imagecreatetruecolor(intval($w), intval($h));

                $im = ImageCreate($data['width'], $height);

                // white background and blue text
                $bg = ImageColorAllocate($im, $data['rrr'], $data['ggg'], $data['bbb']);

                //imagelinedotted ($im, $x1, $y1, $x2, $y2, $dist, $col)
                /*
                                y2-y1
                                -----
                                x2-y1

                */
                $dist = sqrt($height/$data['width']);
                $im = $this->imagelinedotted ($im, 0, 0, $data['width'], $height, $dist, $bg, 5);
                $im = $this->imagelinedotted ($im, 0, $height, $data['width'], 0, $dist, $bg, 5);


                /*
                                $im = $this->imagelinedotted ($im, 0, $height, $width+1, 0, $dist, $bg, 5);
                                $im = $this->imagelinedotted ($im, 0, 0, $width+1, $height, $dist, $bg, 5);

                                $im = $this->imagelinedotted ($im, 0, $height, $width+2, 0, $dist, $bg, 5);
                                $im = $this->imagelinedotted ($im, 0, 0, $width+2, $height, $dist, $bg, 5);

                                $im = $this->imagelinedotted ($im, 0, $height, $width+4, 0, $dist, $bg, 5);
                                $im = $this->imagelinedotted ($im, 0, 0, $width+4, $height, $dist, $bg, 5);*/

                // grey border
                //$border = ImageColorAllocate($im, 207, 199, 199);
                //ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);

                $text = 'This is my photo description text.';
                $text = sprintf("%s x %s", $data['width'], $height);

                $textcolor = ImageColorAllocate($im, 255, 255, 255);

                // Font Size

                $font_width = ImageFontWidth($font);
                $font_height = ImageFontHeight($font);

                /*
                -----------
                Text Width
                -----------
                */

                $text_width = $font_width * strlen($text);

                // Position to align in center
                $position_center = ceil(($data['width'] - $text_width) / 2);

                /*
                -----------
                Text Height
                -----------
                */

                $text_height = $font_height;

                // Position to align in abs middle
                $position_middle = ceil(($height - $text_height) / 2);

                /*
                -----------------
                Write the string
                -----------------
                */

                $image_string = ImageString($im, $font, $position_center, $position_middle, $text, $textcolor);

                /*
                --------------------------------------
                Output our image (PNG in our example)
                --------------------------------------
                */
                header("Content-type: image/png");
                ImagePNG($im);

                exit(0);
                break;

        }
    }

    public function golden() {
        // Create a 200 x 200 image

        $fn = $this->uri->segment(3);

        //	printf("<pre>fn: %s", $fn);

        switch($fn) {
            case 'rect':

                $width = $this->uri->segment(4);
                $height = round($width/1.618);

                $font = intval( 16 );

                $color = $this->uri->segment(5);

                if( strlen($color) == '6') {
                    list($rrr, $ggg, $bbb) = $this->html2rgb( $color );

                } else {
                    $rrr = $this->uri->segment(5);
                    $ggg = $this->uri->segment(6);
                    $bbb = $this->uri->segment(7);
                }

                //$canvas = imagecreatetruecolor(intval($w), intval($h));

                $im = ImageCreate($width, $height);

                // white background and blue text
                $bg = ImageColorAllocate($im, $rrr, $ggg, $bbb);

                //imagelinedotted ($im, $x1, $y1, $x2, $y2, $dist, $col)
                /*
                                y2-y1
                                -----
                                x2-y1

                */
                $dist = sqrt($height/$width);
                $im = $this->imagelinedotted ($im, 0, 0, $width, $height, $dist, $bg, 1);
                $im = $this->imagelinedotted ($im, 0, $height, $width, 0, $dist, $bg, 1);


                /*
                                $im = $this->imagelinedotted ($im, 0, $height, $width+1, 0, $dist, $bg, 5);
                                $im = $this->imagelinedotted ($im, 0, 0, $width+1, $height, $dist, $bg, 5);

                                $im = $this->imagelinedotted ($im, 0, $height, $width+2, 0, $dist, $bg, 5);
                                $im = $this->imagelinedotted ($im, 0, 0, $width+2, $height, $dist, $bg, 5);

                                $im = $this->imagelinedotted ($im, 0, $height, $width+4, 0, $dist, $bg, 5);
                                $im = $this->imagelinedotted ($im, 0, 0, $width+4, $height, $dist, $bg, 5);*/

                // grey border
                //$border = ImageColorAllocate($im, 207, 199, 199);
                //ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);

                $text = 'This is my photo description text.';
                $text = sprintf("%s x %s", $width, $height);

                $textcolor = ImageColorAllocate($im, 255, 255, 255);

                // Font Size

                $font_width = ImageFontWidth($font);
                $font_height = ImageFontHeight($font);

                /*
                -----------
                Text Width
                -----------
                */

                $text_width = $font_width * strlen($text);

                // Position to align in center
                $position_center = ceil(($width - $text_width) / 2);

                /*
                -----------
                Text Height
                -----------
                */

                $text_height = $font_height;

                // Position to align in abs middle
                $position_middle = ceil(($height - $text_height) / 2);

                /*
                -----------------
                Write the string
                -----------------
                */

                $image_string = ImageString($im, $font, $position_center, $position_middle, $text, $textcolor);

                /*
                --------------------------------------
                Output our image (PNG in our example)
                --------------------------------------
                */
                header("Content-type: image/png");
                ImagePNG($im);

                exit(0);
                break;

        }
    }

    public function shape() {
        // Create a 200 x 200 image

        $fn = $this->uri->segment(3);

        //	printf("<pre>fn: %s", $fn);

        switch($fn) {
            case 'rect':

                $width = $this->uri->segment(4);
                $height = $this->uri->segment(5);

                $font = intval( 16 );

                $color = $this->uri->segment(6);

                if( strlen($color) == '6') {
                    list($rrr, $ggg, $bbb) = $this->html2rgb( $color );

                } else {
                    $rrr = $this->uri->segment(6);
                    $ggg = $this->uri->segment(7);
                    $bbb = $this->uri->segment(8);
                }

                //$canvas = imagecreatetruecolor(intval($w), intval($h));

                $im = ImageCreate($width, $height);

                // white background and blue text
                $bg = ImageColorAllocate($im, $rrr, $ggg, $bbb);

                //imagelinedotted ($im, $x1, $y1, $x2, $y2, $dist, $col)
                /*
                    y2-y1
                    -----
                    x2-y1
                */
                $dist = sqrt($height/$width);
                $im = $this->imagelinedotted ($im, 0, 0, $width, $height, $dist, $bg, 5);
                $im = $this->imagelinedotted ($im, 0, $height, $width, 0, $dist, $bg, 5);

                /*
                $im = $this->imagelinedotted ($im, 0, $height, $width+1, 0, $dist, $bg, 5);
                $im = $this->imagelinedotted ($im, 0, 0, $width+1, $height, $dist, $bg, 5);

                $im = $this->imagelinedotted ($im, 0, $height, $width+2, 0, $dist, $bg, 5);
                $im = $this->imagelinedotted ($im, 0, 0, $width+2, $height, $dist, $bg, 5);

                $im = $this->imagelinedotted ($im, 0, $height, $width+4, 0, $dist, $bg, 5);
                $im = $this->imagelinedotted ($im, 0, 0, $width+4, $height, $dist, $bg, 5);*/

                // grey border
                //$border = ImageColorAllocate($im, 207, 199, 199);
                //ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);

                $text = 'This is my photo description text.';
                $text = sprintf("%s x %s", $width, $height);

                $textcolor = ImageColorAllocate($im, 255, 255, 255);

                // Font Size

                $font_width = ImageFontWidth($font);
                $font_height = ImageFontHeight($font);

                /*
                -----------
                Text Width
                -----------
                */

                $text_width = $font_width * strlen($text);

                // Position to align in center
                $position_center = ceil(($width - $text_width) / 2);

                /*
                -----------
                Text Height
                -----------
                */

                $text_height = $font_height;

                // Position to align in abs middle
                $position_middle = ceil(($height - $text_height) / 2);

                /*
                -----------------
                Write the string
                -----------------
                */

                $image_string = ImageString($im, $font, $position_center, $position_middle, $text, $textcolor);

                /*
                --------------------------------------
                Output our image (PNG in our example)
                --------------------------------------
                */
                header("Content-type: image/png");
                ImagePNG($im);

                exit(0);
                break;

        }
    }

    private function imagelinedotted ($im, $x1, $y1, $x2, $y2, $dist, $col, $thick=1) {
        $transp = imagecolortransparent ($im);

        $style = array ($col, $col, $col);

        for ($i=0; $i<$dist; $i++) {
            array_push($style, $transp);        // Generate style array - loop needed for customisable distance between the dots
        }

        /*
        if($thick > 1) {
        imagefilledrectangle($im, round(min($x1, $x2) - $thick), round(min($y1, $y2) - $thick), round(max($x1, $x2) + $thick), round(max($y1, $y2) + $thick), $col);
        return $im;
        }*/

        imagesetstyle ($im, $style);
        imageline ($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);
        // imagesetstyle ($im, array($col));        // Reset style - just in case...
        return $im;
    }


}
