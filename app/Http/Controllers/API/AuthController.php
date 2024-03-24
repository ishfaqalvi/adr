<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\OTPMail;
use App\Models\Token;
use App\Models\Trial;
use App\Models\User;
use App\Models\Subscription;
use Carbon\Carbon;
use Auth;
use DB;

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
                'email'            => 'required|string',
                'password'         => 'required|min:8|max:16',
                'confirm_password' => 'required|min:8|max:16|same:password',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $message = DB::transaction(function () use ($input) {
                $checkUser = User::where('email',$input['email'])->first();
                if ($checkUser) {
                    if(!empty($checkUser->email_verified_at))
                    {
                        return $this->sendError('Validation Error.', ['error' => 'User already registerd against this email.']);    
                    }else{
                        $user = $checkUser;
                        $message = 'Your account is already exist but not varified. Check your email for account verification.';
                    }   
                }else{
                    $user = User::create($input);
                    $message = 'Your account has been created successfully. Check your email for account verification.';
                }
                $otp = rand(100000, 999999);
                Mail::to($input['email'])->send(new OTPMail($otp, 'Account Varification'));
                Token::updateOrCreate(['email' => $input['email']], ['otp' => $otp]);
                DB::commit();
                return $message;
            });
            
            return $this->sendResponse('', $message);
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
                'email'    => 'required|string|email|exists:customers',
                'password' => 'required|min:8|max:16'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                if(empty($user->email_verified_at))
                {
                    return $this->sendError('Varification.', ['error' => 'Oops! your account is not varified.']);    
                }
                if(empty($user->trial)){
                    $s_date = Carbon::today();
                    $e_date = Carbon::today()->addDays(14);
                    Trial::create(['user_id' => $user->id, 'start_date'=> $s_date, 'end_date'  => $e_date]);
                }
                $user->load('trial');
                $user->load('subscription');
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
            Mail::to($request->email)->send(new OTPMail($otp,'Forgot Password'));
            Token::updateOrCreate(['email' => $request->email], ['otp' => $otp]);
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
            $savedOTP = Token::where('email',$request->email)->first()->otp;
            $data = false;
            if ($savedOTP && $savedOTP == $request->otp) {
                $data = true;
                return $this->sendResponse($data, 'OTP Verified successfully.');    
            }
            return $this->sendResponse($data, 'OTP Not Verified.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Resend otp api
     *
     * @return \Illuminate\Http\Response
     */
    public function resendOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $otp = rand(100000, 999999);
            Mail::to($request->email)->send(new OTPMail($otp,'Account Varification'));
            Token::updateOrCreate(['email' => $request->email], ['otp' => $otp]);
            return $this->sendResponse('', 'OTP send successfully.');
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
            Token::where('email',$request->email)->first()->delete();
            return $this->sendResponse('', 'Your password reset successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Account varification api
     *
     * @return \Illuminate\Http\Response
     */
    public function accountVarify(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = User::where('email', $request->email)->first();
            $user->email_verified_at = now();
            $user->save();
            Token::where('email',$request->email)->first()->delete();
            return $this->sendResponse('', 'Your account verified successfully.');
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
     * Remove account api
     *
     * @return \Illuminate\Http\Response
     */
    public function subscription(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $email = $request->email;
            $currentDate = Carbon::now();
            $endDate = $currentDate->copy()->addYear();

            $subscription = Subscription::updateOrCreate(
                ['email' => $email],
                ['start_date' => $currentDate, 'end_date' => $endDate]
            );
            return $this->sendResponse('', 'Subscription saved against this email successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
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