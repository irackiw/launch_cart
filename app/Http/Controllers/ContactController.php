<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvImportRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Jobs\CsvContactImportJob;
use App\Jobs\SyncButtonEventJob;
use App\Jobs\SyncContactJob;
use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // @TODO: pagination
        $contacts = Contact::withManager(Auth::user())->get();

        return view('contact.index', ['contacts' => $contacts]);
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]
        );
        Auth::user()->contacts()->create($request->all());

        return redirect()->route('contact.index')->with('cuccess', 'Contact created');
    }

    public function edit(Contact $contact)
    {
        Gate::authorize('update', $contact);

        return view('contact.edit', compact('contact'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        Gate::authorize('update', $contact);
        $contact->fill($request->except('owner_id'));
        $contact->save();

        return redirect()->route('contact.index')->with('status', 'Contact updated');
    }

    public function destroy(Contact $contact)
    {
        Gate::authorize('destroy', $contact);
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Contact deleted ');
    }

    public function track(Contact $contact)
    {
        Gate::authorize('track', $contact);
        SyncButtonEventJob::dispatch($contact, time());

        return redirect()->route('contact.index')->with('success', 'Contact tracked');

    }

    public function csvImport(CsvImportRequest $request)
    {
        $file = $request->file('file');
        $fileName = sprintf('local/csv_contact_import/%s/%s', Auth::user()->id, time());
        $request->file('file')->storeAs($fileName, $file->getClientOriginalName());

        CsvContactImportJob::dispatch($fileName.'/'.$file->getClientOriginalName(), Auth::user()->id);

        return redirect()->route('contact.index')->with('success', 'Import of contacts queued');
    }
}
