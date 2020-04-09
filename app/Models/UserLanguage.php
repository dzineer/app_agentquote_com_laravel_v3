<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:56:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
use App\Models\CarriersCategoryUser;
/**
 * Class UserLanguage
 *
 * @package App\Models
 */
class UserLanguage extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'user_languages';

    /**
     * @var array
     */
    protected $fillable = [
	    'id',
		'language_id',
		'user_id'
	];

    static function languages( $userId ) {
        $query = "l.name, ul.language_id, l.prefix, l.subtag, 1 as selected
					FROM languages l
						LEFT JOIN user_languages ul ON(l.id = ul.language_id)
							WHERE ul.user_id = {$userId} ORDER BY l.name ASC";

        //echo "<pre>" . $query . "</pre>";

        return DB::select($query);
    }

    static function removeLanguage( $userId, $languageId) {
        return UserLanguage::where([
            ["user_id", "=", $userId],
            ["language_id", "=", $languageId],
            ["primary", "!=", 1]
        ])->delete();
    }

    static function addLanguage( $userId, $languageId ) {

        if (! UserLanguage::where([
            ["user_id", "=", $userId],
            ["language_id", "=", $languageId],
        ])->first() ) {

            return UserLanguage::create([
                ["user_id", "=", $userId],
                ["language_id", "=", $languageId],
            ]);

        }

        return null;
    }

}

/**
 *
-- Languages --
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(1, 'English', 'en', 'en');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(2, 'Afar', 'aa', 'aa');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(3, 'Abkhazian', 'ab', 'ab');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(4, 'Afrikaans', 'af', 'af');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(5, 'Amharic', 'am', 'am');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(6, 'Arabic', 'ar', 'ar');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(7, 'Assamese', 'as' 'as');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(8, 'Aymara', 'ay', 'ay');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(9, 'Azerbaijani', 'az', 'az');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(10, 'Bashkir', 'ba', 'ba');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(11, 'Belarusian', 'be', 'be');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(12, 'Bulgarian', 'bg', 'bg');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(13, 'Bihari', 'bh', 'bh');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(14, 'Bislama', 'bi', 'bi');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(15, 'Bengali/Bangla', 'bn', 'bn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(16, 'Tibetan', 'bo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(17, 'Breton', 'br');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(18, 'Catalan', 'ca');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(19, 'Corsican', 'co');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(20, 'Czech', 'cs');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(21, 'Welsh', 'cy');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(22, 'Danish', 'da');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(23, 'German', 'de');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(24, 'Bhutani', 'dz');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(25, 'Greek', 'el');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(26, 'Esperanto', 'eo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(27, 'Spanish', 'es');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(28, 'Estonian', 'et');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(29, 'Basque', 'eu');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(30, 'Persian', 'fa');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(31, 'Finnish', 'fi');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(32, 'Fiji', 'fj');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(33, 'Faeroese', 'fo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(34, 'French', 'fr');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(35, 'Frisian', 'fy');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(36, 'Irish', 'ga');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(37, 'Scots/Gaelic', 'gd');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(38, 'Galician', 'gl');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(39, 'Guarani', 'gn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(40, 'Gujarati', 'gu');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(41, 'Hausa', 'ha');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(42, 'Hindi', 'hi');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(43, 'Croatian', 'hr');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(44, 'Hungarian', 'hu');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(45, 'Armenian', 'hy');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(46, 'Interlingua', 'ia');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(47, 'Interlingue', 'ie');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(48, 'Inupiak', 'ik');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(49, 'Indonesian', 'in');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(50, 'Icelandic', 'is');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(51, 'Italian', 'it');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(52, 'Hebrew', 'iw');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(53, 'Japanese', 'ja');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(54, 'Yiddish', 'ji');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(55, 'Javanese', 'jw');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(56, 'Georgian', 'ka');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(57, 'Kazakh', 'kk');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(58, 'Greenlandic', 'kl');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(59, 'Cambodian', 'km');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(60, 'Kannada', 'kn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(61, 'Korean', 'ko');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(62, 'Kashmiri', 'ks');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(63, 'Kurdish', 'ku');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(64, 'Kirghiz', 'ky');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(65, 'Latin', 'la');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(66, 'Lingala', 'ln');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(67, 'Laothian', 'lo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(68, 'Lithuanian', 'lt');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(69, 'Latvian/Lettish', 'lv');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(70, 'Malagasy', 'mg');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(71, 'Maori', 'mi');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(72, 'Macedonian', 'mk');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(73, 'Malayalam', 'ml');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(74, 'Mongolian', 'mn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(75, 'Moldavian', 'mo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(76, 'Marathi', 'mr');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(77, 'Malay', 'ms');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(78, 'Maltese', 'mt');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(79, 'Burmese', 'my');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(80, 'Nauru', 'na');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(81, 'Nepali', 'ne');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(82, 'Dutch', 'nl');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(83, 'Norwegian', 'no');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(84, 'Occitan', 'oc');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(85, '(Afan)/Oromoor/Oriya', 'om');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(86, 'Punjabi', 'pa');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(87, 'Polish', 'pl');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(88, 'Pashto/Pushto', 'ps');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(89, 'Portuguese', 'pt');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(90, 'Quechua', 'qu');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(91, 'Rhaeto-Romance', 'rm');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(92, 'Kirundi', 'rn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(93, 'Romanian', 'ro');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(94, 'Russian', 'ru');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(95, 'Kinyarwanda', 'rw');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(96, 'Sanskrit', 'sa');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(97, 'Sindhi', 'sd');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(98, 'Sangro', 'sg');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(99, 'Serbo-Croatian', 'sh');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(100, 'Singhalese', 'si');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(101, 'Slovak', 'sk');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(102, 'Slovenian', 'sl');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(103, 'Samoan', 'sm');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(104, 'Shona', 'sn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(105, 'Somali', 'so');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(106, 'Albanian', 'sq');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(107, 'Serbian', 'sr');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(108, 'Siswati', 'ss');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(109, 'Sesotho', 'st');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(110, 'Sundanese', 'su');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(111, 'Swedish', 'sv');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(112, 'Swahili', 'sw');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(113, 'Tamil', 'ta');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(114, 'Telugu', 'te');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(115, 'Tajik', 'tg');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(116, 'Thai', 'th');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(117, 'Tigrinya', 'ti');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(118, 'Turkmen', 'tk');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(119, 'Tagalog', 'tl');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(120, 'Setswana', 'tn', 'tn');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(121, 'Tonga', 'to');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(122, 'Turkish', 'tr', 'tr');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(123, 'Tsonga', 'ts', 'ts');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(124, 'Tatar', 'tt', 'tt');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(125, 'Twi', 'tw', 'tw');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(126, 'Ukrainian', 'uk', 'uk');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(127, 'Urdu', 'ur', 'ur');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(128, 'Uzbek', 'uz', 'uz');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(129, 'Vietnamese', 'vi', 'vi');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(130, 'Volapuk', 'vo', 'vo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(131, 'Wolof', 'wo', 'wo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(132, 'Xhosa', 'xh', 'xh');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(133, 'Yoruba', 'yo', 'yo');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(134, 'Chinese', 'zh', 'zh');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(135, 'Zulu', 'zu', 'zu');
INSERT INTO `languages` (`id`, `name`, `prefix`, `subtag`) VALUES(136, 'Chinese', 'zh', 'tw');

 */
