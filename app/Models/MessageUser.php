<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserMessage
 *
 * @property int $id
 * @property int $message_type_id
 * @property int $originator_id
 * @property int $user_id
 * @property string $subject
 * @property string $body
 * @property int $importance
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class MessageUser extends Eloquent
{
    protected $table = 'messages_user';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'message_type_id',
		'originator_id',
		'user_id',
		'subject',
		'body',
		'importance',
	];

    /**
     * Carbon date setup
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }
}
