<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactRequest; 
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{

    const PATH_VIEW = 'admin.contacts.';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */


     public function create()
     {
        return view(self::PATH_VIEW . __FUNCTION__ );
     }


    public function store(StoreContactRequest $request)
    {
        try{
            $data = $request->all();

            Contact::query()->create($data);
            
            return redirect()
                ->route('admin.contacts.index')
                ->with('success', 'Thêm thành công');
        }catch(\Throwable $th){
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try{
            $contact->delete();

            return back()->with('success', 'Xóa thành công');
        }catch(\Throwable $th){
            return back()->with('error', $th->getMessage());
        }
    }
}
