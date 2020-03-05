<?php

namespace App\Libraries;

use App\Models\Affiliate;
use App\Models\AffiliateGroupUser;
use App\Models\EventsUser;
use App\Models\LoginsLog;
use App\Models\QuotesUser;
use App\Models\QuoteUsers;
use App\User;
use Closure;
use Illuminate\Support\Facades\DB;

class UserAffiliateAssociate
{
    /**
     * @param \App\User $user
     * @param \App\User $affiliate_user
     * @param \App\Models\Affiliate $affiliate
     * @return array
     */
    public function swapAffiliate(User $user, User $affiliate_user, Affiliate $affiliate) {

        // re-associate tables that belong to user with new affiliate

        if ($affiliate) {

            $affiliate_group_user = AffiliateGroupUser::where('user_id', '=', $affiliate_user->id)->first();

            DB::beginTransaction();

            try {
                // assign user to affiliates default group
                $this->associateGroupUser($user, $affiliate, $affiliate_group_user);

                // re-associate user's event with affiliate
                $this->associateUserEvents($user, $affiliate);

                // re-associate user's login logs with affiliate
                $this->associateUserLoginsLog($user, $affiliate);

                // re-associate user's quotes with affiliate
                $this->associateUserQuotes($user, $affiliate);

                // Finally associate user with new affiliate
                $this->associateUserAffiliate($user, $affiliate);

                // if no errors let's commit our transaction


            } catch(\Exception $e) {
                DB::rollback();
                return [ "success" => false, "message" => $e->getMessage() ];
            }

            DB::commit();
            return [ "success" => true, "message" => "updated successfully." ];
        }
        return [ "success" => false, "message" => "was not able to update;affiliate incorrect." ];
    }

    /**
     * @param \App\User $user
     * @param \App\Models\Affiliate $affiliate
     * @param \App\Models\AffiliateGroupUser $affiliate_group_user
     */
    private function associateGroupUser(User $user, Affiliate $affiliate, AffiliateGroupUser $affiliate_group_user): void
    {
        AffiliateGroupUser::where('user_id', '=', $user->id)->update([
                'affiliate_id' => $affiliate->id,
                'group_id' => $affiliate_group_user->group_id
            ]);
    }

    /**
     * @param \App\User $user
     * @param $affiliate
     */
    private function associateUserEvents(User $user, $affiliate): void
    {
        EventsUser::where('user_id', '=', $user->id)->update(['affiliate_id' => $affiliate->id]);
    }

    /**
     * @param \App\User $user
     * @param $affiliate
     */
    private function associateUserLoginsLog(User $user, $affiliate): void
    {
        LoginsLog::where('user_id', '=', $user->id)->update(['affiliate_id' => $affiliate->id]);
    }

    /**
     * @param \App\User $user
     * @param $affiliate
     */
    private function associateUserQuotes(User $user, $affiliate): void
    {
        QuoteUsers::where('user_id', '=', $user->id)->update(['affiliate_id' => $affiliate->id]);
    }

    /**
     * @param \App\User $user
     * @param $affiliate
     */
    private function associateUserAffiliate(User $user, $affiliate): void
    {
        User::where('id', '=', $user->id)->update(['affiliate_id' => $affiliate->id]);
    }
}