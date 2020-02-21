<?php
    /*
     * App Core Class
     *
     * Creates URL & loads core Controller
     * URL FORMAT - /controller/method/params
     */

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getUrl();

            if (file_exists('../app/_controllers/' . ucwords($url[0]) . ".php")){
                $this->currentController = ucwords($url[0]);

                //unset zero index
                unset($url[0]);
            }

            // Require controller
            require_once '../app/_controllers/' . $this->currentController . '.php';

            //instantiate
            $this->currentController = new $this->currentController;

            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];

                    unset($url[1]);
                }
            }

            // get params
            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        }

        public function getUrl(){
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }
    }
