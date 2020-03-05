<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace Dzineer\CustomModules\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MonitorLinkLog
 *
 * @property int $id
 * @property int $monitor_link_id
 * @property int $count
 * @property string $ip_address
 *
 * @package App\Models
 */
class LinkMonitor extends Eloquent
{
	protected $table = 'link_monitoring';

	protected $with = [
		'monitor_link'
	];

	protected $fillable = [
		'monitor_type',
		'monitor_link_id',
		'ip_address',
	];

	public function monitor_link() {
		return $this->belongsTo(UserModuleMonitorLink::class, 'monitor_link_id', 'id');
	}

}
