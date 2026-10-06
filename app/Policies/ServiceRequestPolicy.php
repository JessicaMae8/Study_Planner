<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->role === 'admin'
            || $serviceRequest->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'student';
    }

    /**
     * Determine whether the user can update request status.
     */
    public function updateStatus(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Other update operations are not allowed.
     */
    public function update(User $user, ServiceRequest $serviceRequest): bool
    {
        return false;
    }

    /**
     * Requests cannot be deleted through this policy.
     */
    public function delete(User $user, ServiceRequest $serviceRequest): bool
    {
        return false;
    }

    /**
     * Requests cannot be restored through this policy.
     */
    public function restore(User $user, ServiceRequest $serviceRequest): bool
    {
        return false;
    }

    /**
     * Requests cannot be permanently deleted through this policy.
     */
    public function forceDelete(User $user, ServiceRequest $serviceRequest): bool
    {
        return false;
    }
}