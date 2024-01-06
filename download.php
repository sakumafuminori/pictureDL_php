<?php
// Zipクラスロード
$zip = new ZipArchive();

// Zipファイル名
$zipFileName = "file_" . date("Ymds") .'.zip';

// Zipファイル一時保存ディレクトリ
$zipTmpDir = '/tmp/zip/';

// Zipファイルオープン
$result = $zip->open($zipTmpDir.$zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
if ($result !== true) {
  // 失敗した時の処理
  exit("Failed to create a zip file.");
}

// 画像ファイルのパスの配列
$filepaths = glob('path/to/your/images/*');

// zipに複数のファイルを詰めていく
foreach ($filepaths as $filepath) {
  $zip->addFile($filepath, basename($filepath));
}

$zip->close();

// 上記で作ったZIPをダウンロードします。
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: Binary");
header("Content-Disposition: attachment; filename=\"".basename($zipTmpDir.$zipFileName)."\"");

// ファイルを出力する前に、バッファの内容をクリア（ファイルの破損防止）
ob_end_clean();

// ファイルを読み込んでダウンロード
readfile($zipTmpDir.$zipFileName);

//一時ファイルを削除しておく
unlink($zipTmpDir.$zipFileName);
?>
