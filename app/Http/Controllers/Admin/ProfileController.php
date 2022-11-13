<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 【PHP/Laravel】09　4
use App\Models\Profile;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }
        public function create(Request $request)
    {
    // 以下を追記
        // Validationを行う
        $this->validate($request, Profile::$rules);

        $profile = new Profile;
        $form = $request->all();


        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);


        // データベースに保存する
        $profile->fill($form);
        $profile->save();    
        
        
        return redirect('admin/profile/create');
    }
    public function edit(Request $profile)
    {
        // Profile Modelからデータを取得する
        $profile = Profile::find($profile->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile' => $profile]);
    }


        public function update()
    {
        return redirect('admin/profile/edit');
    }
        
}
