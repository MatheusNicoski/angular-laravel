<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\ResponseService;
use App\Transformers\Contacts\ContactResource;

class ContactController extends Controller
{

    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return Contact::where('user_id', '=', auth()->user()->id)->get();
    }

    public function show($id)
    {
        $contact =  Contact::where('user_id', '=', auth()->user()->id)->find($id);
        
        return new ContactResource($contact, [
            'type'  => 'show',
            'route' => 'contact.show'
        ]);
    }

    public function store(ContactRequest $request)
    {
        try {

            $contact = $this->contact->create($request->all());

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('contact.store', null, $e);

        }

        return new ContactResource($contact, [
            'type'  => 'store',
            'route' => 'contact.store'
        ]);
    }

    public function update(ContactRequest $request, $id)
    {
        $contact = Contact::whereNull('deleted_at')->find($id);

        try {

            $contact->update($request->all());

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('contact.update', $id, $e);

        }

        return new ContactResource($contact, [
            'type'  => 'update',
            'route' => 'contact.update'
        ]);
    
    }

    public function destroy($id)
    {
        $contact = Contact::whereNull('deleted_at')->find($id);

        try {

            $contact->delete();

        } catch (\Throwable|\Exception $e) {

            return ResponseService::exception('contact.delete', $id, $e);

        }

        return new ContactResource($contact, [
            'type'  => 'destroy',
            'route' => 'contact.delete'
        ]);
    }
}
