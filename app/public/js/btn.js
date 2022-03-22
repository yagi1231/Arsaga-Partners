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

  
  'use strict';

// geolocation
navigator.geolocation.getCurrentPosition(success, fail);

function success(pos) {
    ajaxRequest(pos.coords.latitude, pos.coords.longitude);
}

function fail(error) {
    alert('位置情報の取得に失敗しました。エラーコード:' + error.code);
}

// UTCをミリ秒に
function utcToJSTime(utcTime) {
    return utcTime * 1000;
}

// データ取得
function ajaxRequest(lat, long) {
    const url = 'https://api.openweathermap.org/data/2.5/forecast';
    const appId = 'a8cdaf03cabca4b4743db5488df9e663';

    $.ajax({
        url: url,
        data: {
            appid: appId,
            lat: lat,
            lon: long,
            units: 'metric',
            lang: 'ja'
        }
    })
    .done(function(data) {
        // 天気予報データ
        data.list.forEach(function(forecast, index) {
            const dateTime = new Date(utcToJSTime(forecast.dt));
            const month = dateTime.getMonth() + 1;
            const date = dateTime.getDate();
            const hours = dateTime.getHours();
            const min = String(dateTime.getMinutes()).padStart(2, '0');
            const temperature = Math.round(forecast.main.temp);
            const description = forecast.weather[0].description;
            const iconPath = `/images/${forecast.weather[0].icon}.svg`;
     
            // 現在の天気とそれ以外で出力を変える
            if(index === 0) {
                const currentWeather = `
                ${month}/${date} ${hours}:${min}
                <div class="icon"><img src="${iconPath}"></div>
                <div class="info">
                    <p>
                        <span class="description">${description}</span>
                        <span class="temp">${temperature}</span>°C
                    </p>
                </div>`;
                $('#weather').html(currentWeather);
            } else if(index <= 3) {
                const tableRow = `
            <ul class="mt-4"style="display: inline-block; >
              <li>
                    <div class="info">
                        ${hours}:${min}
                    </div>
                    <div class="icon"><img src="${iconPath}"></div>
                    <div><span class="description">${description}</span></div>
                    <div><span class="temp">${temperature}°C</span></div>
                    </li>
                    </ul>`
                    ;
                $('#forecast').append(tableRow);
            }
        });
    })
    .fail(function() {
        console.log('$.ajax failed!');
    })
}

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
    