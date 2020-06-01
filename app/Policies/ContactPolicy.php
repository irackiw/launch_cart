<?php

namespace App\Policies;

use App\Contact;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
    }

    public function view(User $user, Contact $contact): bool
    {
        return $user->id === $contact->manager_id;
    }

    public function create(User $user): bool
    {

    }

    public function update(User $user, Contact $contact): bool
    {
        return $user->id == $contact->manager_id;
    }

    public function destroy(User $user, Contact $contact): bool
    {
        return $user->id === $contact->manager_id;
    }

    public function track(User $user, Contact $contact): bool
    {
        return $user->id === $contact->manager_id;
    }
}
