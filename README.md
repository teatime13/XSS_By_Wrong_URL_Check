# Wrong url check
URLのチェックのみを行いSchemeがHTTPかのチェックを行わない場合のXSS  
Nahamsecさんの動画でURLを入力できる際に，スキームのチェックが正しく行われていないと簡単にXSSができるという話があった．そのためそれを再現しようとした．  
URLのチェックについては，一般的に用いられているfilter_var( $url, FILTER_VALIDATE_URL )を利用した  
ドキュメントからFILTER_VALIDATE_URLについて調べたが，Version5.2.1よりFILTER_VALIDATE_URLのデフォルトがFILTER_FLAG_SCHEME_REQUIREDとFILTER_FLAG_HOST_REQUIREDになったという記述がある  
そのため，スキームとホストが正しく含まれていさえすれば，その後ろにダブルクオーテーションなどがあったとしてもチェックはされないのだと考えられる

## PoC
Input URLに対して，`http://sample.com/"onclick="alert()` を入力する  
すると，`<a href="http://sample.com/" onclick="alert()">` になるためクリックするとXSSを行う事が可能となる．

## 対策
- htmlspecialcharを利用して記号をエスケープ
- どうしても上の対策ができない場合はスキームがhttpやhttpsであるかということを確認する