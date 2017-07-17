<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {
    
    public function getUserList()
    {
        // Init param for pagination
        $data['page'] = ( !empty(request()->get('page')) ? request()->get('page') : 1 );
        $data['limit'] = ( !empty(request()->get('limit')) ? request()->get('limit') : 10 );

        // Check has search
        if (request()->has('search')) {
            $query = User::where('username', 'LIKE', '%'.request()->get('search').'%');
            $query = $query->orWhere('email', 'LIKE', '%'.request()->get('search').'%');
            $query = $query->orWhere('role', 'LIKE', '%'.request()->get('search').'%');
        } else {
            $query = new User();
        }

        // Query and Pagination
        $data['userList'] = $query->paginate($data['limit']);
        
        return view('backoffice.pages.user.list', $data);
    }

    public function getChangePassword($id)
    {
        $data['userAccountId'] = $id;

        return view('backoffice.pages.user.change-password', $data);
    }

    public function postChangePassword($id)
    {
        // Validation
        $rules = [
            'password'  => 'required|confirmed',
        ];

        $this->validate(request(), $rules);

        // Init data before update
        request()['password'] = bcrypt(request()->get('password'));
        
        $query = User::findOrFail($id);
        
        $query->update(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.user.list.get');
    }
}