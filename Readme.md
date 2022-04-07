# 情報共有サイト　アプリ名『kouchdelivery』
このアプリは私が働いている「デリバリー専門店　KOUCH」というお店のデリバリー店員に向けて作ったものです。  
デリバリー店員は配達が基本業務なので基本的にお店にいることは少なく忙しくなればなるほど一回で配達する件数も必然的に増えていきます。  
そうなるとその日いるメンバー(平均4.5人)で時間に合わせるように効率が求められます。  
そこで使用するのがこの情報共有アプリです。  
時間順で並んでいるのでひと目で時間・場所の把握ができ、レスポンシブに対応しているのでスマホから確認することも可能です。  
金額を打ち込めば日別、月別での売り上げ表示が可能です。  

<img width="1680" alt="スクリーンショット 2022-04-07 15 11 32" src="https://user-images.githubusercontent.com/77727362/162132086-e6ab4b0e-e565-4c5e-834e-b545d642971e.png">

# ER図
<img width="492" alt="20001" src="https://user-images.githubusercontent.com/77727362/162131822-73da1619-26a5-496c-9dbe-b39d02160caf.png">

# 大戸屋とkouchの関係性
このアプリを紹介するにはこの二つの店の関係性を説明しなくてはいけない。  
kouchは大戸屋所沢プロペ通り店をフランチャイズしたオーナーが１から新しい事業として始めたものです。  
大戸屋でもイートインとは別にデリバリー事業があり、    
お店の場所も2,300mの場所にあるため配達員は4,5人で二つの店を行き来し配達を行っている。  
その為、注文内容のカテゴリー内の大戸屋やコラボのボタンが存在している

# 使い方
・注文を受ける流れ  
1、ログインを行う  
<img width="1680" alt="スクリーンショット 2021-12-20 3 37 13" src="https://user-images.githubusercontent.com/77727362/162132847-a3900f91-630b-4551-b19b-8a64f2f0687e.png">  

2,電話がかかってきたらハンバーガーメニューの「顧客一覧」を選択  
<img width="1353" alt="スクリーンショット 2022-04-07 14 35 39" src="https://user-images.githubusercontent.com/77727362/162127668-4532cea9-1492-40b2-82bc-14bee41a9edf.png"> 

3,お客様にkouchの注文は初めてか確認。初めてなら新規登録、２回目以降なら電話番号を伺う  
<img width="1353" alt="スクリーンショット 2022-04-07 14 35 39" src="https://user-images.githubusercontent.com/77727362/162133084-cac0f807-5e10-4002-88c1-bb566ee30895.png">  

4,新規登録、または検索を行い詳細ページ中にある「新規注文画面へ」を選択 
<img width="1680" alt="スクリーンショット 2021-12-20 3 06 36" src="https://user-images.githubusercontent.com/77727362/162130008-81c25b51-9581-4b1f-9e75-132d8567847e.png">  

5,新規注文に移行したら、残りの注文内容、金額、カテゴリー、企業、民家を打ち込みし「登録完了する」を選択  
<img width="1680" alt="スクリーンショット 2021-12-20 3 09 47" src="https://user-images.githubusercontent.com/77727362/162130288-22eec363-56a6-445b-a7a5-fb54ffc8cf2f.png">

6,予約一覧表に日付・時間順に表示されているので住所、時間、大戸屋とのコラボなどを確認することができる。    
<img width="1680" alt="スクリーンショット 2021-12-20 3 31 38" src="https://user-images.githubusercontent.com/77727362/162131471-6a07713a-6073-4cd8-a730-7f9be7b75f49.png">  

・検索機能の使い方  
　予約一覧表の検索では日付と名前・電話番号・住所のどれかを記入することで検索できるようになっている  
　日付は自動的に使用している日に設定されているので注意   
<img width="1680" alt="スクリーンショット 2021-12-20 3 31 38" src="https://user-images.githubusercontent.com/77727362/162130630-21552735-4cf6-46b8-82c6-e0a03d7cc2fd.png">  

・売上の使い方   
売上ページは日別、月別ごとに表示されており、検索、ページネーションをつけることで見やすくしました
<img width="1680" alt="スクリーンショット 2021-12-20 3 31 38" src="https://user-images.githubusercontent.com/77727362/162130972-e42738c1-44a0-4c36-a100-2dd951889be7.png">

# こだわりポイント
こだわりポイントは注文内容の中にある省略ボタンです。   
これはスマートフォン、タブレット端末で操作する時に使用することを想定しておりパソコンだとあまり意味がないです。  
このアプリを使うのはkouchのキッチン、デリバリーメンバー、大戸屋の方の三者で、
kouchキッチン、デリバリーは平均年齢が20歳ほどなので電話対応しながら打つのも可能だと思った。  
しかし大戸屋の方は平均年齢30-40歳で特に注文内容を聞きながら打ち込むのが困難だと感じたときに省略ボタンを考えた。  
これを使うことでお客様からの注文をよりスムーズに打ち込むことができお客様のストレス軽減、電話対応短縮が可能となった。  
実際にパートの方に使用してもらったところボタンを使う時と使わない時では30−40秒ほどの短縮ができた。

# 機能一覧
ユーザー登録、ログイン機能  
検索機能  
CRUD機能   
ページネーション  
画像投稿  
天気取得機能(google api)  

# 使用技術 
・php 7.3     
・MySQL  5.7      
・AWS     
　• EC2等  
・Docker/docker-compose  
・CircleCi CI/CD


# テスト
・phpunit  
・dusk    