function checkinput()
{
    if(myform.username.value=="")
    {
        alert("请输入用户名");
        myform.username.focus();
        return false;
    }
    if (myform.password.value=="")
    {
        alert("请输入密码");
        myform.password.focus();
        return false;
    }
    if(myform.password.value != myform.pwdconfirm.value){
        alert("你输入的两次密码不一致，请重新输入！");
        myform.password.focus();
        return false;
    }
}