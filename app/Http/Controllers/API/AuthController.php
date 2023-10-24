<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\OTPMail;
use App\Models\User;
use Auth;

class AuthController extends BaseController
{
    /**
     * Register API
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|max:50',
                'email'            => 'required|string|email|unique:users',
                'password'         => 'required|min:8|max:16',
                'confirm_password' => 'required|min:8|max:16|same:password',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = User::create($request->all());
            return $this->sendResponse($user, 'Your account has been created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email|exists:users',
                'password' => 'required|min:8|max:16'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $user->token = $user->createToken("API TOKEN")->plainTextToken;
                return $this->sendResponse($user, 'User login successfully.');
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Email and password you provided is incorrect.']);
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * View user api
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return $this->sendResponse(auth()->user(), 'Profile data get successfully');
    }

    /**
     * Update user api
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'             => 'required',
                'email'            => 'required|string|email|unique:users,email,' . auth()->user()->id,
                'current_password' => 'nullable|required_with:new_password',
                'new_password'     => 'nullable|min:8|max:16',
                'confirm_password' => 'nullable|min:8|max:16|same:new_password'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = auth()->user();
            $input = $request->all();
            if ($request->new_password) {
                if (Hash::check($input['current_password'], $user->password)) {
                    $input['password'] = $request->new_password;
                } else {
                    return $this->sendError('Password Error.', 'Oops! current password is incorrect.');
                }
            }
            $user->update($input);
            return $this->sendResponse($user, 'Your profile updated successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Forgot user password api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $otp = rand(100000, 999999);
            Mail::to($request->email)->send(new OTPMail($otp));
            Session::put($request->email, $otp);
            return $this->sendResponse('', 'Reset password OTP send to given email successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Verify otp api
     *
     * @return \Illuminate\Http\Response
     */
    public function verifiOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
                'otp'   => 'required',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $savedOTP = Session::get($request->email);

            if ($savedOTP && $savedOTP == $request->otp) {
                return $this->sendResponse('', 'OTP Verified successfully.');    
            }
            return $this->sendResponse('', 'OTP Not Verified.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Reset user password api
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'           => 'required|email|exists:users',
                'new_password'    => 'required|min:8|max:16',
                'confirm_password'=> 'required|min:8|max:16|same:new_password'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = User::where('email', $request->email)->first();
            $user->update(['password' => $request->new_password]);
            Session::forget($request->email);
            return $this->sendResponse('', 'Your password reset successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse('', 'You have successfully logout');
    }

    /**
     * Remove account api
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->tokens()->delete();
        $user->delete();
        return $this->sendResponse('', 'Your account removed successfully.');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkUser(Request $request)
    {
        $user = Null;
        if ($email = $request->email) {
            $user = User::where('email', $email)->first();    
        }
        if (empty($user)) {
            return $this->sendError('Record Not Found.', ['No record found against this email!']);
        }else{
            return $this->sendResponse($user, 'User data get successfully.');
        }
    }
}
