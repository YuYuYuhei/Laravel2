<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

// 18章追記
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
  public function add()
  {
      return view('admin.profile.create');
  }

  public function create(Request $request)
  {
      // Validation
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      //トークンのunset
      unset($form['_token']);
      //データベースへの保存
      $profile->fill($form)->save();

      return redirect('admin/profile/create');
  }


  public function edit(Request $request)
  {
      //Profile Modelからデータを取得
      $profile = Profile::find($request->id);
      if (empty($profile)) {
         abort(404);
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
  }


  public function update(Request $request)
  {
      //Validation
      $this->validate($request, Profile::$rules);
      //Profile Modelからデータを取得
      $profile = Profile::find($request->id);
      //送信されてきたフォームデータの格納
      $profile_form = $request->all();

      unset($profile_form['_token']);
      unset($profile_form['remove']);
      //該当データを上書きして保存
      $profile->fill($profile_form)->save();

      //18章で追記
      $history = new ProfileHistory;
      $history->profile_id = $profile->id;
      $history->edited_at = Carbon::now();
      $history->save();

      return redirect('admin/profile/edit?id=' . $profile->id);
      /*
      return redirect()->action(
     'Admin\UserController@profile', ['id' => 1]
);でもOK！！

      */

  }

}
