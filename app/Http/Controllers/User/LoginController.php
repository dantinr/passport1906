<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{

    /**
     * 处理Web网站登录 view
     */
    public function webLogin()
    {
        return view('user.web-login');
    }

    /**
     * 处理WEB登录
     */
    public function webLoginDo()
    {
        // TODO 登录逻辑

        //验证用户名密码

        $uid = 1234;

        // 生成token , 写入 cookie中
        $token = Str::random(16);

        //设置cookie
        setcookie('token',$token,time() + 3600,'/','.1906.com',NULL,true);

        //将token存入Redis
        $user_token_key = 'str:user:token:web:'.$uid;
        Redis::set($user_token_key,$token);

        // 跳回到登录之前的页面
        //header("Location:http://shop.1906.com");
        header("refresh:3;url=http://shop.1906.com");
        echo  "登录成功，正在跳转";

    }


    /**
    *   处理API登录
    */
    public function apiLogin(Request $request)
    {
        $user = $request->input('user');
        $pass = $request->input('pass');

        

        //echo "我是passport<hr>";
        //echo "u: ".$user;echo '<br>';
        //echo "p: ".$pass;echo '<br>';

        // 验证用户信息
        //$user = UserModel::where(['user_name'=>user])->first();

        // if(user){
        //     //验证密码

        // }else{

        // }

        $uid = 1234;
        // 生成token
        $token = Str::random(16);
        //将token存入Redis
        $user_token_key = 'str:user:token:app:'.$uid;
        Redis::set($user_token_key,$token);

        $data = [
            'errno' => 0,
            'data'  => [
                'token' => $token,
                'uid'   => $uid
            ]
        ];

        return $data;


    }
}
