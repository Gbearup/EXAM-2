<fieldset style="width:75% ;margin:auto;">
<legend>帳號管理</legend>
<table class='ct' style="width:75%;margin:auto;">
    <tr>
        <td>帳號</td>
        <td>密碼</td>
        <td>刪除</td>
    </tr>
    <?php 
    $rows=$User->all();
    foreach($rows as $row):?>
    <tr>
        <td><?=$row['acc'];?></td>
        <td><?=str_repeat("*",strlen($row['pw']));?></td>
        <td>
            <input type="checkbox" name="del[]" 
            value="<?=$row['id'];?>">
        </td>
    </tr>
    <?php endforeach;?>
</table>

<div class="ct"><button onclick='del()'>確定刪除</button><button onclick='resetChk()'>清空選取</button></div>
<h2>新增會員</h2>

    <div style="color:red">
        *請設定您要註冊的帳號及密碼(最長12個字元)
    </div>
    <table>
        <tr>
            <td>Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="註冊" onclick='reg()'>
                <input type="button" value="清除" onclick='resetForm()'>
            </td>
            <td></td>
            
        </tr>

    </table>


    
    <!-- 使用 jQuery 來選取頁面上 ID 分別為 acc、pw、pw2 和 email 的 HTML 元素，
    並使用 .val() 方法來獲取這些元素的值。這些值被存儲在 user 物件中。 -->
    
    <script>

         function del(){
             let dels=$("input[name='del[]']:checked");
             let ids=new Array();
             dels.each((idx,item)=>{
                 ids.push($(item).val())
             })
             /* console.log(ids) */
             $.post('./api/del_user.php',{ids},()=>{
                 location.reload();
             })
         }




        function reg(){
            let user={
            acc:$("#acc").val(),  // 獲取帳號輸入框的值
            pw:$("#pw").val(),    // 獲取密碼輸入框的值
            pw2:$("#pw2").val(),       // 獲取確認密碼輸入框的值
            email:$("#email").val(),   // 獲取電子郵件輸入框的值
        }
        
        // console.log(user) 確認輸入功能是正常的 
        
        if(user.acc=="" || user.pw=="" || user.pw2=="" || user.email==""){
            alert("不可空白");
        }else if(user.pw!=user.pw2){
            alert("密碼錯誤");
        }else{
            $.get("./api/chk_acc.php",{acc:user.acc},(res)=>{         //資訊取得 所以用get  如果會動到資料庫，會用post
                if(parseInt(res)>0){                                    //本來==1,改成>0
                alert("帳號重複")                                      // JavaScript 中，parseInt() 是用來將一個字串轉換成整數的函數。其用途是將一個字串（例如："123"）轉換成相應的數字（例如：123）
            }else{
                $.post("./api/reg.php",user,(res)=>{
                    location.reload();
                    // if(parseInt(res)==1){
                        //     alert("註冊完成，歡迎加入")
                        // }
                    })
                }
            })  
        }        
    }
    
    function resetForm(){
        $("#acc").val("")  
        $("#pw").val("")    
        $("#pw2").val("")
        $("#email").val("")
    }
    
    function resetChk(){
        $("input[type='checkbox']").prop("checked",false)
    }

</script>
   
</fieldset>