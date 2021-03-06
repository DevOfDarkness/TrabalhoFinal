<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;

class Supplier extends Model
{
  use SoftDeletes;
  use Notifiable;

  public function merchandises()
  {
    return $this->hasMany('App\Merchandise');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }


  public function customers()
  {
      return $this->belongsToMany('App\Customer')->withPivot('rating');
  }

  public function updateSupplier($request, $user = null)
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
        

 public function destroySupplier($id){
  
    Supplier::destroy($id);
  }

  protected $dates = ['deleted_at'];
}
