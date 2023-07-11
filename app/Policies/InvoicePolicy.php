<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment as Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function changePaymentStatus(User $user, Invoice $invoice): bool
    {
        // dd($user->is_doctor(), $invoice);
        if($user->is_hospital()){
            return $user->hospital_id === $invoice->hospital_id;
        }
        if($user->is_admin()){
            return true;
        }
        return false;
    }
}
