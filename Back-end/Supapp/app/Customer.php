<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
  use SoftDeletes;
  use Notifiable;

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function purchases()
  {
    return $this->hasMany('App\Purchase');
  }

  public function suppliers()
  {
    return $this->belongsToMany('App\Supplier')->withPivot('rating');
  }

  public function rateSupplier($request)
  {
    $this->suppliers()->attach($request->id,['rating' => $request->rating]);

  }

  public function updateCustomer($request, $user = null)
  {
    if($user)
      $this->user_id = $user->id;
    if($request->cnpj)
      $this->cnpj = $request->cnpj;
    if($request->name)
      $this->name = $request->name;
    if($request->address)
      $this->address = $request->address;
    if($request->phone)
      $this->phone = $request->phone;
    if($request->email)
      $this->email = $request->email;
     $this->save();
  }

  public function destroyCustomer($id)
  {
    Customer::destroy($id);
  }

  protected $dates = ['deleted_at'];
}
