<?php
    class URLCHECK {
        private $geturl = '';
        private $urlcheckresult = false;
        public function urlchecker() {
            $this->geturl = empty($_GET['url']) ? 'http://sample.com' : $_GET['url'];


            if( $this->urlcheckresult = filter_var( $this->geturl, FILTER_VALIDATE_URL ) ){
                return $this->geturl;
            }
            else {
                return '/';
            }
        }
        public function geturl() {
            if( $this->urlcheckresult ) {
                return $this->geturl;
            }
            else {
                return "Wrong URL: '".$this->geturl."'";
            }
        }
    }
    $urlcheck = new URLCHECK();
?>

<html>
    <head>
        <h1>XSS By Wrong URL Check</h1>
    </head>
    <body>
        <form action="/" method="get">
            <p>
                Input URL : <input type="text" name="url"><br>
                <input type="submit" value="送信">
            </p>
            <p>
                <a href="<?php print( $urlcheck->urlchecker() ) ?>"><?php print( $urlcheck->geturl() ) ?></a>
            </p>
    </body>
</html>