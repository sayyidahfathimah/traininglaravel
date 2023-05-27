<?php

namespace App\Http\Controllers;

//import Model customers
use App\Models\Customers;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        //get customers
        /*$customers = Customers::latest()->paginate(5);*/

        if($request->filled('search')){
            $customers = Customers::search($request->search)->get();
        }else{
            $customers = Customers::get();
        }

        $customers = Customers::latest()->paginate(5);

        //render view with customers
        return view('customers.index', compact('customers'));
        
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'customername'     => 'required|min:5',
            'phone'            => 'required|min:10'
        ]);

        //create customers
        Customers::create([
            'customername'      => $request->customername,
            'phone'             => $request->phone,
            'city'              => $request->city,
            'state'             => $request->state,
            'postalcode'        => $request->postalcode,
            'country'           => $request->country
        ]);

        //redirect to index
        return redirect()->route('customers.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get customers by ID
        $customers = Customers::findOrFail($id);

        //render view with post
        return view('customers.show', compact('customers'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get customers by ID
        $customers = Customers::findOrFail($id);

        //render view with post
        return view('customers.edit', compact('customers'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'customername'     => 'required|min:5',
            'phone'            => 'required|min:10'
        ]);

        //get customers by ID
        $customers = Customers::findOrFail($id);

        //update customers
        $customers->update([
            'customername'      => $request->customername,
            'phone'             => $request->phone,
            'city'              => $request->city,
            'state'             => $request->state,
            'postalcode'        => $request->postalcode,
            'country'           => $request->country
        ]);

        //redirect to index
        return redirect()->route('customers.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $customers
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get customers by ID
        $customers = Customers::findOrFail($id);

        //delete customers
        $customers->delete();

        //redirect to index
        return redirect()->route('customers.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}