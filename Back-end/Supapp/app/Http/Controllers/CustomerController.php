<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
     $lista = Customer::all();
     return response()->json([$lista]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function rate(CustomerRequest $request){
      $user = Auth::user();
      $customer = $user->customer;
      $customer->rateSupplier($request);
      return response()->json['Nota dada'];
    }

    public function store(CustomerRequest $request)
    {
      $customer = new Customer;
      $customer->updateCustomer($request);
      return response()->json([$customer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $showCustomer = Customer::find($id);
      return response()->json([$showCustomer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {

      $customer = Customer::findOrFail($id);
      $customer->updateCustomer($request);

      return response()->json([$customer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->destroyCustomer($id);

        return response()->json(['DELETADO']);
    }
}
