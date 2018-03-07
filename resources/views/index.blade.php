@extends('layout')

@section('content')
<div class="partial_content">
    <div class="top_bg">
        <img src="assets/images/top2.jpg">
        <img src="assets/images/top2.jpg">
    </div>
    <div class="top_content">
        <div class="title">History from Google Home<span class="narrow-hide">.</span></div>
        <div class="body">
            Google Home の History を集計します<span class="narrow-hide">。</span>
        </div>
    </div>
</div>
<div class="partial_content">
    <section>
        <img class="image" src="assets/images/various.png">
        <div class="title">多彩な配信元</div>
        <div class="body">ITニュースを中心に、多彩な配信元を網羅<span class="narrow-hide">。リアルタイムに確認できます。</span></div>
    </section>
    <section>
        <img class="image" src="assets/images/recommend.png">
        <div class="title">おすすめができる</div>
        <div class="body">社員同士で記事をシェアできる、おすすめ機能を搭載<span class="narrow-hide">。普段関わらない人にもおすすめができます。</span></div>
    </section>
    <section>
        <img class="image" src="assets/images/trend.png">
        <div class="title">話題の記事を配信</div>
        <div class="body"><span class="narrow-hide">Opnewなら、いま</span>IT界隈で話題になっている記事が、大量に届きます<span class="narrow-hide">。</span></div>
    </section>
</div>
<script>
$header = document.getElementsByTagName("header")[0];
window.onscroll = function(){
  if (window.pageYOffset > 40) {
      $header.className = "white";
  } else {
      $header.className = "";
  }
};
</script>
@endsection
