<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $creator;

    public function __construct(CreateNewUser $creator)
    {
        $this->creator = $creator;
    }

    public function store(Request $request)
    {
        $user = $this->creator->create($request->all());
        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
