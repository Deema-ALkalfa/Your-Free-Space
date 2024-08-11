<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'max:55', 'string', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Check if user creation was successful
        if (!$user) {
            return redirect()->back()->withErrors(['registration' => 'Registration failed. Please try again.']);
        }

        // Log in the user
        Auth::login($user);

        // Redirect to a specific page with a success message
        return redirect()->route('posts.index')->with('success', 'Registration successful! You are now logged in.');
    }



    public function login(Request $request)
    {
        // Validate login data
        $loginData = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        // Attempt login
        if (!Auth::attempt($loginData)) {
            return redirect()->back()->withErrors([
                'error' => 'The password you entered is wrong.'
            ])->withInput();
        }

        // Check and update user admin status
        $user = Auth::user();
        if ($user->email === 'deemakalfa@gmail.com' && !$user->isAdmin) {
            $user->isAdmin = true;
            $user->save();
        }

        // Handle remember me functionality
        $accessToken = $user->createToken('Personal Access Token');
        $user['remember_token'] = $accessToken;
        if ($request->remember_me){
            $accessToken->token->expires_at = Carbon::now()->addWeeks(1);
        }
        $accessToken->token->save();

        // Redirect to posts index or the intended route
        return redirect()->intended(route('posts.index'))->with('success', 'Successfully logged in.');
    }


    protected function authenticated(Request $request, $user)
    {
        // Store success message in session
        $request->session()->flash('success', 'You have successfully logged in!');

        // Redirect to the posts index page
        return redirect()->route('posts.index');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('posts.index')->with('status', 'Logged out successfully'); // Redirect to the posts index page with a success message
    }

}
