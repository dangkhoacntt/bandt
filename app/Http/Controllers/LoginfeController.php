<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Userfe;
use App\Models\Baner;

use Illuminate\Support\Facades\Auth;

class LoginfeController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Hiển thị form đăng nhập.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        $data['banners'] = Baner::all();
        return view('frontend.login',$data); // Thay 'frontend.login' bằng tên view của form đăng nhập của bạn
    }

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Xử lý hành động sau khi đăng nhập thành công.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        $userName = $user->name;
        $userEmail = $user->email;
        return redirect('/')->with('status', 'Bạn đã đăng nhập thành công.');
    }

    /**
     * Xử lý đăng xuất người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Sau khi đăng xuất, bạn có thể chuyển hướng người dùng đến trang cụ thể hoặc trang chính
        return redirect()->route('frontend.home')->with('status', 'Bạn đã đăng xuất thành công.');
    }
    public function loginfe(Request $request)
{
    // Validate dữ liệu đầu vào
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Thực hiện đăng nhập
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Nếu đăng nhập thành công, chuyển hướng về trang chính hoặc trang mong muốn
        return redirect()->intended('/');
    }

    // Nếu không đăng nhập thành công, chuyển hướng trở lại form đăng nhập với thông báo lỗi
    return redirect()->route('loginfe')->with('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại email và mật khẩu.');
}

}
