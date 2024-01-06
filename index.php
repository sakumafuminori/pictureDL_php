<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>画像表示ページ</title>
  <!-- スタイルの追加（任意） -->
  <!-- 省略 -->
</head>
<body>

  <h1>画像表示ページ</h1>

  <div id="usageBox">
    <p><strong>使用方法:</strong></p>
    <ol>
      <li>省略</li>
    </ol>
  </div>

  <label for="textInput">画像URL入力フォーム:</label>
  <input type="text" id="textInput" placeholder="画像URLを入力">

  <label for="pageInput">指定ページ数:</label>
  <input type="number" id="pageInput" placeholder="ページ数" max="999">

  <button onclick="displayImages()">画像表示</button>
  <button onclick="downloadImages()">画像ダウンロード</button>

  <div id="imageContainer"></div>
  <div id="errorContainer"></div>

  <button id="reloadButton" onclick="displayImages()">再読み込み</button>

  <script>
    function displayImages() {
      // テキスト入力値の取得
      var inputText = document.getElementById("textInput").value;

      // 末尾が "1.jpg" でない場合
      if (!inputText.endsWith("1.jpg")) {
        document.getElementById("errorContainer").innerHTML = "画像URLを入力してください。";
        return;
      } else {
        document.getElementById("errorContainer").innerHTML = "";
      }

      // 末尾の「1.jpg」を取り除く
      var baseInputText = inputText.slice(0, -5);

      // 指定ページ数の取得
      var pageCount = parseInt(document.getElementById("pageInput").value);

      // 画像を表示するための要素取得
      var imageContainer = document.getElementById("imageContainer");

      // 画像をクリア
      imageContainer.innerHTML = "";

      // 1.jpg から指定ページ数までの画像を表示
      for (var i = 1; i <= pageCount; i++) {
        var imageUrl = baseInputText + i + ".jpg";

        // 画像と連番を表示する要素を組み合わせてコンテナに追加
        var container = document.createElement("div");
        container.className = "imageContainer";

        // 画像要素の生成
        var imgElement = document.createElement("img");
        imgElement.src = imageUrl;

        // 連番を表示する要素の生成
        var numberElement = document.createElement("div");
        numberElement.className = "imageNumber";
        numberElement.innerHTML = i;

        container.appendChild(imgElement);
        container.appendChild(numberElement);
        
        imageContainer.appendChild(container);
      }
    }

    function downloadImages() {
      // PHPスクリプトを呼び出す
      window.location.href = 'download.php';
    }
  </script>

</body>
</html>
