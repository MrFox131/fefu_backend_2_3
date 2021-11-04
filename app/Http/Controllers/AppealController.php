<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class AppealController extends Controller
{
    function __invoke(Request $request) {
        $validationErrors = [];
        $success = $request->session()->get('success', false);

        if ($request->getMethod() == 'POST') {
            if (!$request->filled('phone') && !$request->filled('email')) {
                $validationErrors[] = 'Please, provide any of the following: phone, email.';
            }
            if (!$request->filled('name')) {
                $validationErrors[] = 'Please, provide your name.';
            }
            if (!$request->filled('message')) {
                $validationErrors[] = 'Please, fill message field.';
            }
            if (count($validationErrors)>0) {
                $request->flash();
            } else {
                $appeal = new Appeal();
                $appeal->name = $request->input('name');
                $appeal->email = $request->input('email');
                $appeal->message = $request->input('message');
                $appeal->phone=$request->input('phone');
                $appeal->save();

                $success = true;

                return redirect()->route('appeal')->with('success', $success);
            }
        }

        return view('appeal', [
            'errors' => $validationErrors,
            'success' => $success
        ]);
    }
}
