<fieldset style="width:70%; margin:auto">
    <legend>新增問卷</legend>
    <table style="width:100%">
        <tr>
            <td>問卷名稱</td>
            <td>
                <input type="text" name="subject" id="subject" style="width:80%">
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <div id="options">
                    選項<input type="text" name="option[]" id=""  style="width:80%">
                    <button onclick="more()">更多</button>
                </div>
            </td>
            
        </tr>
    </table>

<div class="ct">
    <button onclick=send()>新增</button>
    <button onclick="resetForm()">清空</button>
</div>

</fieldset>

<script>
    function more(){
        let el=`<div>
                   選項<input type="text" name="option[]" id="" style="width:80%">
                </div>`
            $("#options").before(el)   // 在選項區域前插入新選項  el 是新增的選項輸入框的 HTML 代碼。
    }

    function send(){
        let subject=$("subject").val()  // 獲取問卷名稱
        let options=$("input[name='option[]']").map((id,item)=>$(item).val()).get()
                                        //options 變量使用了 jQuery 的 map() 函數來抓取所有 name="option[]" 的輸入框的值，並將其轉換成一個數組。
        $.post("./api/add_que.php",{subject,options},(res)=>{
            location.reload()        // 提交後重新載入頁面
        })                           // $.post() 發送一個 POST 請求到 ./api/add_que.php，並將 subject 和 options 作為資料發送。
    }


    function resetForm(){
        $("input[type='text']").val("")   // 清空所有的文本框
    }
</script>