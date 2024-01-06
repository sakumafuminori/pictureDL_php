<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>画像表示ページ</title>
  <style>
    /* スタイルの追加（任意） */
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 50px;
    }
    .imageContainer {
      position: relative;
      margin-top: 20px;
      display: inline-block; /* 画像が左に並ぶようにするために追加 */
    }
    img {
      max-width: 100%;
      height: auto;
    }
    .imageNumber {
      position: absolute;
      top: 0;
      left: 0;
      background-color: rgba(255, 255, 255, 0.7);
      padding: 5px;
      border-radius: 5px;
      font-size: 2.5em; /* 修正：文字サイズを2.5倍に設定 */
      /* 修正：透過度を設定 */
      background-color: rgba(0, 128, 0, 0.5);
    }
    /* フォームのスタイル調整 */
    #textInput {
      width: 30%; /* テキスト入力フォームの幅を30%に設定 */
      margin-bottom: 10px; /* 下部に余白を追加 */
    }
    #pageInput {
      width: 70px; /* ページ数入力フォームの幅を70pxに設定 */
      margin-bottom: 10px; /* 下部に余白を追加 */
    }
    /* 使用方法のスタイル調整 */
    #usageBox {
      border: 2px solid #ddd; /* ボーダーのスタイル */
      background-color: #f9f9f9; /* 背景色 */
      padding: 15px; /* 内側の余白 */
      border-radius: 10px; /* 角丸 */
      margin-top: 10px; /* 修正：上部に余白を追加 */
      text-align: left; /* テキストを左寄せに設定 */
    }
    ol {
      margin: 0; /* マージンをリセット */
      padding-left: 20px; /* 左側の余白 */
    }
    /* 修正：再読み込みボタンのスタイル */
    #reloadButton {
      position: fixed;
      right: 10px;
      bottom: 10px;
      width: 120px; /* 修正：ボタンの幅を指定 */
      height: 40px; /* 修正：ボタンの高さを指定 */
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      /* 修正：透過度を設定 */
      background-color: rgba(0, 128, 0, 0.7);
    }
  </style>
</head>
<body>

  <h1>画像表示ページ</h1>

  <div id="usageBox">
    <p><strong>使用方法:</strong></p>
    <ol>
      <li>対象画像サイトの1ページ目の画像を右クリックし、「検証」を押下します。</li>
      <li>画像URLをコピーし、下の「画像URL入力フォーム」にペーストします。</li>
      <li>対象画像サイトの最大ページ数を下の「指定ページ数」に入力します。</li>
      <li>「画像表示」ボタンを押下します。</li>
      <li>すべての画像が表示されたら、何もないところで右クリックし「名前を付けて保存」を選択します。</li>
      <li>ダウンロードの「画像表示ページ_files」フォルダに画像が保存されるので、中身を切り取りして別フォルダへペーストします。</li>
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
