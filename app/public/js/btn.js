    //領収書の印刷
    $(function(){
    $('.print-btn').on('click', function(){
    
    var printArea = document.getElementsByClassName("print-area");
    
    $('body').append('<div id="print" class="printBc"></div>');
    $(printArea).clone().appendTo('#print');
    
    $('body > :not(#print)').addClass('print-off');
    window.print();
    $('#print').remove();
    $('.print-off').removeClass('print-off');
     });
    });
    var i = 1 ;
    function addForm() {
      var input_data = document.createElement('input');
      input_data.type = 'text';
      var parent = document.getElementById('form_area');
      parent.appendChild(input_data);
      i++ ;
    }


//注文内容の表示、計算
  textarea=$('#textarea')
  pri=$('#pri')

    function menu(btn) {
      let btns=btn.split("-"); 
      textarea.val(textarea.val() +btns[0]+"\n");
      pri.val(pri.val() +btns[1]+"+");
    }

    function sum() {
        document.getElementById('sumpri').value=eval(document.getElementById('pri').value.slice(0,-1));
    }

    function prican() {
        pri.val(pri.val().slice(0,-4));
        textarea.val(textarea.val().slice(0,-7))
    }

  //メニューの開閉
  $(document).ready(function(){
      $('.shop-name').on('click',function(){
          $(this).next().toggleClass('click-btn')
      });
  });
  
  //ここからログアウト、削除、作成時のダイアログ//

  $(function(){
    $("#logout-btn").click(function(){
      let logout= window.confirm('ログアウトします。よろしいですか？');
      if(logout){
        document.getElementById('logout-form').submit();
      }
      else{
        return false;
      }
    })
  });
  
  $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    }else{
    return false;
    }
    });
  });
   
    $(function(){
    $(".btn-completion").click(function(){
    if(confirm("この情報で登録しますか？")){
    }else{
    return false;
    }
    });
  });

  //クリックしたら色と文字を変える
  // <td><p class="check alert alert-warning" style="cursor: pointer;">配達準備中</p></td>
  //   $('.check').on('click', function() {
  //     if($(this).hasClass('alert alert-warning')) {
  //       $(this).text('配達準備完了').addClass('alert alert-danger').removeClass('alert alert-warning');
  //     } else if($(this).hasClass('alert-danger')) {
  //       $(this).text('配達中').addClass('alert alert-success').removeClass('alert-danger');
  //     }else if($(this).hasClass('alert-success')){
  //       $(this).text('配達完了').addClass('alert alert-primary').removeClass('alert-success');
  //     }else {
  //       $(this).text('配達準備中').addClass('alert alert-warning').removeClass('alert-primary');
  //     }
  // });
    