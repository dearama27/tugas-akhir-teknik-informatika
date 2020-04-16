<?php
namespace App\TrusCRUD\Generator;


trait GeneratorAssets {

    public $js_url    = [];
    public $css_url   = [];

    function assets() {
        $assets = require __DIR__ . '/Config/assets.php';

        return $assets;
    }

    function assets_loader($component) {

        $find = $this->find($component);

        $this->js_url  = array_merge($this->js_url, $find['js']);
        $this->css_url = array_merge($this->js_url, $find['css']);

    }

    function find($component) {
        $js   = [];
        $css  = [];
        $type = '';
    
        foreach($this->assets() as $t => $param) {

            if(in_array($component, $param['component'])) {
                $type  = $t;
                $js    = array_merge($js, $param['js_url']);
                $css   = array_merge($css, $param['css_url']);
            }
        }

        return ['js' => $js, 'css' => $css, 'type' => $type];
    }

}