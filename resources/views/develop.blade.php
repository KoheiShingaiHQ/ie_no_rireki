@extends('layout')

@section('content')
<div id="side-nav" class="qp-ui-side-nav-drawer">
    <nav>
        <dl>
          @if (empty($access_token))
              <dt class="login" onClick="login()">ログイン</dt>
          @else
              <dt class="article">記事管理</dt>
              <dt class="data">データベース</dt>
              <dt class="logout" onClick="href('/develop')">ログアウト</dt>
          @endif
        </dl>
    </nav>
</div>
<div id="grid-cont" style="">
    <div class="user-label">
        <span>
            @if (!empty($mail_address))
                {{$mail_address}}
            @endif
        </span>
    </div>
    <div class="main-cont">
        @if (empty($mail_address))
            <article style="display:none">
                <section>
                    <h2>チケット + 詳細手順</h2>
                    <div class="section-item">
                        <img src="https://developers.google.com/identity/images/sign-in.svg" class="right">
                    </div>
                </section>
                <section>
                    <h2>クローリング記事 + 実装</h2>
                    <div class="section-item">
                        <img src="https://lh3.googleusercontent.com/KwadAWh-5RyVmzsvkkBc5CLAmWKd-XOqFGpaXm7Ik4GMHRlzW6AfirtxbdewhjytcA9w_p7ljOYPin1aCGz2vx5l2Tk3YLOc=s888" class="left">
                    </div>
                </section>
                <section>
                    <h2>社内サーバデータベース + 実装</h2>
                    <div class="section-item">
                        <img src="https://firebase.google.com/docs/auth/images/auth-providers.png" class="right">
                    </div>
                </section>
            </article>
        @else
            <article>
                <section class="main"></section>
                <section class="detail" id="detail">
                  @include('close')
                  <div class="header"><div><h3></h3><p></p></div></div>
                  <div class="content"></div>
                </section>
                <section class="article">
                  <?php
                    function unicode_encode($str) {
                      return preg_replace_callback('/\\\\u([0-9a-zA-Z]{4})/', 'encode_callback', $str);
                    }
                    function encode_callback($matches) {
                      return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UTF-16');
                    }
                  ?>
                  @foreach ($article_dates as $date_array)
                    <?php $date = array_flatten($date_array)[0] ?>
                    <h1 data="{{ $date }}">{{ date("Y年m月d日",strtotime($date)) }}</h1>
                    <section class="contents">
                      @foreach ($article_lists as $list)
                        @if ($list["date"] == $date)
                          <a onClick="showDetail('{{ $list["hash"] }}', {{ $list["date"] }})">
                            <div class="list-card">
                              <div class="list-caption"><h2>{{ unicode_encode($list["title"]) }}</h2></div>
                            </div>
                          </a>
                        @endif
                      @endforeach
                    </section>
                  @endforeach
                </section>
                <section class="data">
                  @include('reload')
                  @foreach ($tables as $table_array)
                    <?php $table = array_flatten($table_array)[0] ?>
                    <h1 class="table-name" data="{{ $table }}">{{ ucfirst(trans($table)) }}</h1>
                    <section class="contents">
                      <table border=1 data="{{ $table }}">
                        <thead>
                          <tr>
                            @foreach($columns[$table] as $column)
                              <th>{{$column}}</th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody class="table-content" data="{{ $table }}">
                        </tbody>
                      </table>
                    </section>
                  @endforeach
                </section>
            </article>
            <script>
              $table_name = document.getElementsByClassName("table-name");
              $detail_close = document.getElementsByClassName("close")[0];
              $detail_close.addEventListener("click", function(){closeDetail()}, true);

              function closeDetail() {
                $article.className = $article.className.replace(" detail", "");
                $body.className = $body.className.replace(" detail", "");
              }

              function showData(table, datas) {
                $tables = document.getElementsByTagName("table");
                $table_contents = document.getElementsByClassName("table-content");
                for ($table of $tables) {
                  if ($table.getAttribute('data') === table) {
                    $columns = [];
                    for ($th of $table.getElementsByTagName("th")) {
                      $columns.push($th.innerText);
                    }
                    var content = [];
                    for (data of datas) {
                      var row = [];
                      for($column of $columns) {
                        if (typeof data[$column] === "string") {
                          $value = unescape(decodeURIComponent(data[$column]).split("\\").join("%"));
                        } else {
                          $value = data[$column];
                        }
                        row += "<td>" + $value + "</td>";
                      }
                      content.push("<tr>" + row + "</tr>");
                    }
                    for ($table_content of $table_contents) {
                      if ($table_content.getAttribute("data") === table) {
                        $table_content.innerHTML = content.join("");
                      }
                    }
                  }
                }
              } 

              function getData(table) {
                var xmlhttp = new XMLHttpRequest();
                var param = "table=" + table;
                xmlhttp.onreadystatechange = function() {
                  if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
                    if (xmlhttp.status == 200) {
                      showData(table, JSON.parse(xmlhttp.response));
                    }
                  }
                };
                xmlhttp.open("GET", "/develop/data?" + param, true);
                xmlhttp.send();
              }

              function getDatas() {
                for (var e of $table_name) {
                  getData(e.getAttribute('data'));
                }
              }

              getDatas();
            </script>
        @endif
    </div>
</div>
<script>

  $article = document.getElementsByTagName("article")[0];
  $body = document.getElementsByTagName("body")[0];
  $detail = document.getElementById("detail");
  $detail_header = $detail.getElementsByClassName("header")[0];
  $detail_content = $detail.getElementsByClassName("content")[0];

  function login() {
    window.location.href = "https://opst.backlog.jp/OAuth2AccessRequest.action?response_type=code&client_id=Uysni4pyGITEIrQLxPxhkwVgyqqfH0cw";
  }

  function href(url) {
    window.location.href = url;
  }

  function formatDate(date) {
    var $date = parseInt(date);
    $date = new Date($date / 10000, $date % 10000 / 100, $date % 100);
    var year = $date.getFullYear();
    var month = $date.getMonth();
    var day = $date.getDate();
    return year + "年" + month + "月" + day + "日"; 
  }

  function getInfo(hash) {
      var xmlhttp = new XMLHttpRequest();
      var param = "hash=" + hash;
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
              if (xmlhttp.status == 200) {
                  showInfo(JSON.parse(xmlhttp.response)[0]);
              }
          }
      };
      xmlhttp.open("GET", "/article/header?" + param, true);
      xmlhttp.send();
  }

  function getContent(hash, date) {
      var xmlhttp = new XMLHttpRequest();
      var param = "hash=" + hash + '&date=' + date;
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
              if (xmlhttp.status == 200) {
                  showContent(xmlhttp.response);
              }
          }
      };
      xmlhttp.open("GET", "/article/detail?" + param, true);
      xmlhttp.send();
  }

  function showDetail(hash, date) {
    $detail_header.getElementsByTagName("h3")[0].innerText = "";
    $detail_header.getElementsByTagName("p")[0].innerText = "";
    $detail_content.innerHTML = "";
    $article.className += " detail";
    $body.className += " detail";
    getInfo(hash);
    getContent(hash, date);
  }

  function showInfo(data) {
    $detail_header.getElementsByTagName("h3")[0].innerText = unescape(data["title"].split("\\").join("%"));
    $detail_header.getElementsByTagName("p")[0].innerText = formatDate(data["date"]);
  }

  function showContent(data) {
    $detail_content.innerHTML = data;
  }

  window.onload = function() {
    var $menu = {};
    $menu.dt = document.getElementById("side-nav").children[0].getElementsByTagName("dt");

    function initMenu() {
      $body.className = $body.className.replace(" detail", "");
      for (var e of $menu.dt) {
        e.classList.remove("selected");
      }
    }

    function selectMenu(e) {
      initMenu();
      e.className += " selected";
      $article.className = e.className.replace(" selected", "");
    }

    for (var e of $menu.dt) {
      e.addEventListener("click", function(){selectMenu(this)}, true);
    }
  }
</script>
@endsection
