# PHP+AJAX 实现自动聊天机器人
这是一个运用腾讯AI开放平台的智能闲聊机器人做的一个小项目  
需要自己去AI平台创建一个应用，然后申请APPID和APPKEY才能使用  
申请链接：[腾讯AI开放平台](https://ai.qq.com/)  
文档链接：[智能闲聊开发文档](https://ai.qq.com/doc/nlpchat.shtml)  
### 先上图看看效果  
![聊天](https://raw.githubusercontent.com/MuGongziya/Chat-robot/master/images/liaotian.png)  
大概就是这个样子，此机器人接口没有配额限制和并发限制  
所以有时候使用时会发生系统超时的情况，属于正常现象，重新调用即可   
具体的实现思路就是，前台发送一句话，然后由ajax传入到后台进行调用、查询  
然后后台再将获取到的json信息进行解析再传到前台显示  
聊天页面模板取自[HTML,CSS,JS实现网页聊天窗口](https://blog.csdn.net/wf134/article/details/78837998)  
聊天的气泡和头像以及昵称可根据需求自行修改
