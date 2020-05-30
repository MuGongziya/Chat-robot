<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>机器人</title>
</head>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script type="text/javascript">
    function question(){
        var Words = document.getElementById("words");
        var TalkWords = document.getElementById("talkwords");
            var jqrText='';
            var str = document.getElementById('talkwords').value;
            //定义空字符串
            if(TalkWords.value == ""){
                // 消息为空时弹窗
                alert("消息不能为空");
                return;
            }
            if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {
                //IE6, IE5 浏览器执行的代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {

                    jqrText = xmlhttp.responseText;
                    console.log("ajax:"+jqrText);
                    str = '<div class="btalk"> <span class="btaName">我</span>  <span class="btaSpan"><span class="btaSpanText">' +TalkWords.value +' </span></span> <img src="you.png" height="35px" width="35px" class="btaImg"/> </div> <div class="atalk"> <img src="mgz.png" height="35px" width="35px" class="ataImg"/> <span class="ataName">慕公子</span>  <span class="ataSpan"><span class="ataSpanText">' + jqrText +'</span></span></div>' ;
                    Words.innerHTML = Words.innerHTML + str;
                    clean();
                    dropdown();
                }
            }
            xmlhttp.open("GET","jqr.php?q="+str,true);
            xmlhttp.send();

    }
    // 绑定回车键事件
    function keydownEvent() {
        var e = window.event || arguments.callee.caller.arguments[0];
        if (e && e.keyCode == 13 ) {
             question();
        }
    }
// 让聊天框始终在最底部
    function dropdown() {
        var Words = document.getElementById("words");
        Words.scrollTop = Words.scrollHeight;
    }
// 清除内容
    function clean() {
        var talk = document.getElementById("talkwords");
        talk.value = "";
    }

window.onload=function () {
    //手机端打开强制跳转到H5页面
    var isAndroid = (/android/gi).test(navigator.appVersion);
    var isIPadDevice = (/ipad/gi).test(navigator.appVersion);
    var isIDevice = (/iphone/gi).test(navigator.appVersion);
    var isPlaybook = (/playbook/gi).test(navigator.appVersion);
    var isTouchPad = (/hp-tablet/gi).test(navigator.appVersion);
    var isWindowsPhone = (/windows phone/gi).test(navigator.appVersion);
    var isHasLinux = (/linux/gi).test(navigator.appVersion);
    var isGecko = (/gecko/gi).test(navigator.appVersion);
    if (isAndroid || isIDevice || isWindowsPhone || (isHasLinux && isGecko)) {
        window.location.href = 'robotH5.php';
    }
}
</script>
<body>


    <div class="talk_con">
        <div class="talk_show" id="words"></div>
        <div class="talk_input">

            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <input type="text" class="form-control" id="talkwords" name="question" onkeydown="keydownEvent()">
                    </div>

                    <div class="col-2">
                        <input type="button" value="发送" class="btn btn-outline-success" onclick="question()">
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>