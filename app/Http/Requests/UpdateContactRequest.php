<?php

namespace App\Http\Requests;

use App\Contact;

class UpdateContactRequest extends CreateContactRequest
{
    public function authorize(): bool
    {
        $contact = Contact::find($this->route('contact'))->first();
        return $contact && $this->user()->can('update', $contact);
    }
}
