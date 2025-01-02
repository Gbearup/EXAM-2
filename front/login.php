<fieldset style="width:50%;margin:auto;">
    <legend>會員登入 </legend>
    <table>
        <tr>
            <td>帳號管理</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="登入" onclick="login()">
                <input type="reset" value="清除" onclick="resetForm()">
            </td>
            <td>
                <a href="?do=forgot">忘記密碼</a>
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>

    </table>
</fieldset>

<script>

function login(){
        let user={
            acc:$("#acc").val(),  // 獲取帳號輸入框的值
            pw:$("#pw").val(),    // 獲取密碼輸入框的值
            
        }

        $.get("./api/chk_acc.php",{acc:user.acc},(res)=>{     // 發送 GET 請求到 chk_acc.php 檢查帳號是否存在
            // console.log("chk acc => ",res)
            if(parseInt(res)==0){                              // 如果回傳的結果為 0，表示查無帳號
                alert("查無帳號")
                resetForm()
            }else{
                $.post("./api/chk_pw.php",user,(res)=>{        // 發送 POST 請求到 chk_pw.php 檢查帳號密碼是否正確
                    // console.log("login => ",res)
                    if(parseInt(res)==1){                      // 如果回傳的結果為 1，表示密碼正確
                        if(user.acc=='admin'){
                            location.href='admin.php';         // 如果帳號為 'admin'，導向後台頁面
                        }else{
                            location.href='index.php';         // 否則導向首頁
                        }
                    }else{
                        alert("密碼錯誤")
                        resetForm()
                    }
                })
            }
        })
}        
    

function resetForm(){
        $("#acc").val("")  
        $("#pw").val("")    
    }


</script>