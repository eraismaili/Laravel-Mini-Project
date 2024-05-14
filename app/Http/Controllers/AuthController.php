<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;


class AuthController extends Controller
{

    public function registrationForm()
    {
        $companies = Company::all();
        return view('auth.register', compact('companies'));
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = new User();
        //e  thirr funksionin validated para se me i perdor requestat --
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($request->password);
        $user->save();

        $companyId = $validatedData['company_id'];
        // Create an employee record for the user
        $employee = new Employee();
        $employee->first_name = $user->name;
        $employee->last_name = $request->input('last_name');
        $employee->email = $user->email;
        $employee->phone = $request->input('phone');
        $employee->company_id = $validatedData['company_id'];
        $employee->save();

        $user->employee_id = $employee->id;
        $user->save();

        $user->assignRole('user');

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function loginForm()
    {
        return view('auth.login');
    }//nese kthen veq view me kqyr qysh kthehet direkt te web.php e mos me shtu ne controller hiq

    public function login(LoginRequest $request)
    {
        //perdor form request --
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return redirect()->route('profile.show');
        } else {
            return redirect()->back()->withErrors(['login_error' => 'Invalid email or password.']);
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}