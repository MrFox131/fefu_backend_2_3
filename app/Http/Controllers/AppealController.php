<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppealPostRequest;
use App\Models\Appeal;
use App\Sanitizers\PhoneNumberSanitizer;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class AppealController extends Controller
{
    function postAppeal(AppealPostRequest $request) {
        $validated = $request->validated();
        $appeal = new Appeal();
        $appeal->name = $validated['name'];
        $appeal->email = $validated['email'];
        $appeal->message = $validated['message'];
        $appeal->phone = PhoneNumberSanitizer::sanitize($validated['phone']);
        $appeal->surname = $validated['surname'];
        $appeal->patronymic = $validated['patronymic'];
        $appeal->age = $validated['age'];
        $appeal->gender = $validated['gender'];
        $appeal->save();

        $success = true;
        $request->session()->put('appeal_submitted', true);

        return redirect()->route('appeal')->with('success', $success);
    }
    function getAppealPage(Request $request) {
        $success = $request->session()->get('success', false);

        return view('appeal', [
            'success' => $success,
            'redirect' => $request->session()->get('isRedirect', false),
            'prev_url' => $request->session()->get('prev_url', '')
        ]);
    }
}
