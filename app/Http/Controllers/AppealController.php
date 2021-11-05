<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Sanitizers\DigitOnlySanitizer;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class AppealController extends Controller
{
    function __invoke(Request $request) {
        $success = $request->session()->get('success', false);

        if ($request->getMethod() == 'POST') {

            $validated = $request->validate([
                'name' => ['required','string','max:20'],
                'surname' => ['required','string','max:40'],
                'patronymic' => ['nullable','string','max:20'],
                'age' =>[ 'required','integer','max:125','min:14'],
                'phone' => ['nullable', 'string','regex:/^(\+7|8|7)[0-9]{10}$/i'],
                'email' => ['nullable','string','max:100','regex:/^[a-z0-9_]+@[a-z0-9]+\.[a-z0-9]{2,6}$/i'],
                'message' => ['required','string','max:100'],
                'gender' => ['required','integer','in:0,1']
            ]);
            $appeal = new Appeal();
            $appeal->name = $validated['name'];
            $appeal->email = $validated['email'];
            $appeal->message = $validated['message'];
            $appeal->phone = DigitOnlySanitizer::sanitize($validated['phone']);
            $appeal->surname = $validated['surname'];
            $appeal->patronymic = $validated['patronymic'];
            $appeal->age = $validated['age'];
            $appeal->gender = $validated['gender'];
            $appeal->save();

            $success = true;

            return redirect()->route('appeal')->with('success', $success);
        }

        return view('appeal', [
            'success' => $success
        ]);
    }
}
