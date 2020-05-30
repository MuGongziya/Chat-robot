<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/30 0030
 * Time: 9:45
 */
//    这里填写你在腾讯AI开放平台申请的appkey
    $appkey = ' ';
    $params = array(
        'app_id'     => ' ', //    这里填写你在腾讯AI开放平台申请的appid
        'session'    => strval(rand()),//    这里随机生成session的会话标识
        'question'   => $_GET["q"],//    获取传入的信息
        'time_stamp' => strval(time()),//    时间戳
        'nonce_str'  => strval(rand()),// 随机字符串
        'sign'       => '',//    签名信息
    );
        function getReqSign($params /* 关联数组 */, $appkey /* 字符串*/)
        {
            // 1. 字典升序排序
            ksort($params);

            // 2. 拼按URL键值对
            $str = '';
            foreach ($params as $key => $value)
            {
                if ($value !== '')
                {
                    $str .= $key . '=' . urlencode($value) . '&';
                }
            }

            // 3. 拼接app_key
            $str .= 'app_key=' . $appkey;

            // 4. MD5运算+转换大写，得到请求签名
            $sign = strtoupper(md5($str));
            return $sign;
        }

        function doHttpPost($url, $params)
        {
            $curl = curl_init();

            $response = false;
            do
            {
                // 1. 设置HTTP URL (API地址)
                curl_setopt($curl, CURLOPT_URL, $url);

                // 2. 设置HTTP HEADER (表单POST)
                $head = array(
                    'Content-Type: application/x-www-form-urlencoded'
                );
                curl_setopt($curl, CURLOPT_HTTPHEADER, $head);

                // 3. 设置HTTP BODY (URL键值对)
                $body = http_build_query($params);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

                // 4. 调用API，获取响应结果
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_NOBODY, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                //        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($curl);
                if ($response === false)
                {
                    $response = false;
                    break;
                }

                $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                if ($code != 200)
                {
                    $response = false;
                    break;
                }
            } while (0);

            curl_close($curl);
            return $response;
        }
        $params['sign'] = getReqSign($params, $appkey);

        // 执行API调用
        $url = 'https://api.ai.qq.com/fcgi-bin/nlp/nlp_textchat';
        $response = doHttpPost($url, $params);
        $obj = json_decode($response);
        if (!empty($obj->data->answer)){
            echo $obj->data->answer;
        }else if (empty($obj->data->answer)){
            //此机器人接口没有配额限制和并发限制，所以有时候使用时会发生系统超时的情况，属于正常现象，重新调用即可
            echo "系统突然掉线，请重新输入~";
        }

    ?>