<?php

namespace App;

use App\Models\Affiliate;
use App\Models\AffiliateGroupUser;
use App\Models\AffiliateType;
use App\Models\LoginsLog;
use App\Models\NotificationsUser;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\WhmcsUser;
use App\Models\WhmcsUserUser;
use App\Traits\UserRoleTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    const AFFILIATE_USER = 2;
    const ADMIN_USER = 3;
    const MANGER_USER = 4;
    const AGENT_USER = 5;

    protected $table = 'users';

    use Notifiable, UserRoleTrait, HasPushSubscriptions;// , HasRoles;

    // protected $with = [/*'type', */'profile'/*, 'affiliate'*/];

    // protected $appends = ['is_affiliate'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'name', 'email', 'type_id', 'affiliate_id', 'password', 'time_zone', 'typeable_id', 'typeable_type', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'login_at',
        'last_login_at'
    ];

    // User has a profile
    // User has a role
    // Role has many permissions

    // User has a type
    // type has many users
    // user has one to many relationship
    // with type user

    protected $with = [
        'whmcs_user'
    ];

    public function is_affiliate() {
        return $this->type_id === self::AFFILIATE_USER;
    }

    public function is_admin() {
        return $this->type_id === self::ADMIN_USER;
    }

    public function is_manager() {
        return $this->type_id === self::MANGER_USER;
    }

    public function is_agent() {
        return $this->type_id === self::AGENT_USER;
    }

    public function not_agent() {
        return ! ($this->is_affiliate() || $this->is_admin()  || $this->is_manager());
    }

    public function profile() {
    	return $this->hasOne(Profile::class);
    }

    public function owns($related) {
        return $this->id == $related->id;
    }

    public function affiliate() {
        return $this->belongsTo(Affiliate::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function group() {
        return \DB::table('users')
            ->select('affiliate_groups.description as group')
            ->leftJoin('affiliates', 'users.affiliate_id', '=', 'affiliates.id')
            ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
            ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
            ->where('users.id', '=', $this->id)
            ->get()->first();
    }

    public function logs() {
        return LoginsLog::where('user_id', '=', $this->id)->get();
    }

    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized');
    }

    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function getIsAffiliateAttribute()
    {
        return $this->attributes['is_affiliate'] = Affiliate::whereUserId($this->id)->exists();
    }

    public function isAffiliate() {
        return $this->append('is_affiliate')->toArray();
    }

    public function addPermission($name, $label = '') {
        $permission = new Permission;
        $permission->name = $name;
        $permission->label = $label;
        $permission->save();
        return $permission;
    }

    public function notification_permission() {
        return $this->hasOne(NotificationsUser::class);
    }

    public function type() {
        return $this->belongsTo(AffiliateType::class, 'type_id', 'id');
    }

    public function assignUserType($userType)
    {
        $type_id = AffiliateType::whereName($userType)->first()->id;
        $this->type_id = $type_id;
        $this->update();
    }

    public function assignToAffiliate($affiliate)
    {
        $affiliateRecord = Affiliate::whereName($affiliate)->first();
        return AffiliateUser::create([
            'affiliate_id' => $affiliateRecord->id,
            'user_id' => auth()->id(),
        ]);
    }

    /**
     * Carbon date setup
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    public function getCreatedAtAttribute()
    {
       return \Carbon\Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getUpdatedAtAttribute()
    {
       return \Carbon\Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getCustomLoginAtAttribute()
    {
       return \Carbon\Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getCustomLastLoginAtAttribute()
    {
       return \Carbon\Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function associateWithWHMCS(WhmcsUser $whmcs_user) {
        $whmcs_user->assignUser( $this );
    }

    public function whmcs_user() {
        return $this->hasOne(WhmcsUserUser::class);
    }

    /**
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function subscribe(Product $product) {
        return $this->subscriptions()->create([
            'user_id' => $this->id,
            'product_id' => $product->id
        ]);
    }

    /**
     * @param \App\Models\Product $product
     *
     * @return void
     */
    public function unSubscribe(Product $product) {
        if (($subscription = $this->subscriptions()->where([ 'product_id' => $product->id, 'user_id' => $this->id ]))->exists()) {
            $subscription->delete();
        }
    }

}
