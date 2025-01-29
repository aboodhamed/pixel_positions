<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
   // app/Policies/JobPolicy.php
// app/Policies/JobPolicy.php
public function update(User $user, Job $job): Response
{
    return $user->employer->employer === $job->employer->employer
        ? Response::allow()
        : Response::deny('You do not own this job.');
}
public function delete(User $user, Job $job): Response
{
    return $this->update($user, $job);
}
}
