<?php
    /*
     *  Base Controller
     *
     *  loads models and views
     */

    class Controller {
        // load Model

        public function model($model) {
            // require model file
            require_once '../app/_models/' . $model . '.php';
            //instantiate
            return new $model();
        }

        public function view($view, $data = []) {
            //Check view file
            if(file_exists('../app/_views/' . $view . '.php')){
                require_once '../app/_views/' . $view . '.php';
            }else{
                die('View does not exist!');
            }
        }
    }
