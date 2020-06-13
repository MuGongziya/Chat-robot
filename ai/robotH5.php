<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>机器人</title>
</head>
<link rel="stylesheet" href="css/styles.css">
<script src="../layui/layui/layui.js"></script>
<link rel="stylesheet" href="../layui/layui/css/layui.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    .ltTitle{
        position: sticky;
        top: 0;
        height: 50px;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        flex-direction: column;
    }
    .ltTitleName{
        font-size: 18px;
    }
</style>
<script type="text/javascript">
    function question(){
        var Words = document.getElementById("words");
        var TalkWords = document.getElementById("talkwords");
            var jqrText='';
            var str = document.getElementById('talkwords').value;
            //定义空字符串
            if(TalkWords.value == ""){
                // 消息为空时弹窗
                layui.use('layer', function(){
                    layer.msg('内容不能为空！', function () {
                    });
                });
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
                    // document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
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
        var bigBox = document.getElementById("bigBox");
        var words = document.getElementById("words");

        var width = window.screen.width;
        var height = window.screen.height;
        bigBox.style.width = width+'px';
        bigBox.style.height = height+'px';

        words.style.width = width*0.9+'px';
        words.style.height = height*0.7+'px';

    }
</script>
<body>

    <div style="
      background:#f9f9f9;" id="bigBox">

        <div style="
        border:1px dashed #666;
        background:pink;
        margin:10px auto 0;
        overflow:auto;"
             id="words" >
            <div class="ltTitle">
                <span class="ltTitleName">慕公子
                    <span class="layui-icon  layui-icon-release"></span>
                </span>
                <span class="layui-badge">对方6G在线</span>
            </div>
        </div>

        <div class="inpH5">

            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="form-control" id="talkwords" name="question" onkeydown="keydownEvent()">
                    </div>

                    <div class="col-3">
                        <input type="button" value="发送" class="btn btn-outline-success" onclick="question()">
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>