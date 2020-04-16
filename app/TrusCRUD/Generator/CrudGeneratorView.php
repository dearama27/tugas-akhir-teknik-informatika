<?php
namespace App\TrusCRUD\Generator;

use Illuminate\Support\Facades\File;

trait CrudGeneratorView {

    // public $name;
    // public $name_underscore = '';
    // public $columns         = [];
    // public $viewDir;
    use Generator;
    use GeneratorAssets;

    private $style_urls    = [];
    private $script_urls   = [];

    private $styles        = '';
    private $scripts       = ''; //URL with tag

    private $script_code   = '';

    private $unique_types  = [];
    private $assets        = [];
    private $multipart     = false;

    public function initView() {
        // dd($this->columns);
        $this->assets_loader();
        $this->createDir();
        $this->createIndex();
        $this->createForm();
    }

    public function createDir() {
        $path = base_path('resources/views/adminLTE/'.$this->name_underscore);
        
        if(!is_dir($path)) {
            mkdir($path);
        }

        $this->viewDir = $path;
    }

    public function createIndex() {
        $file_name = 'index.blade.php';
        $path      = $this->viewDir.'/'.$file_name;

        $title     = ucwords(str_replace('_', ' ', $this->name_underscore));
        $stub      = $this->getStub('views/index');
        $head      = $this->indexFieldHead();
        $row       = $this->indexFieldRow();
        $col_span  = count($this->columns)+3; //3 default column 
        $stub      = str_replace([
            "{{title}}","{{field}}","{{field_row}}", "{{colspan}}", "{{page-name}}"],[
            $title,     $head,      $row,            $col_span,     $title], $stub);
        File::put($path, $stub);
    }

    public function indexFieldHead() {
        $header = '';
        foreach($this->columns as $col) {
            $name    = ucwords($this->underscore_to_space($this->from_camel_case($col['name'])));
            $header .= "\t\t\t\t\t\t\t\t\t\t<th>$name</th>\n";
        }

        return $header;
    }

    public function indexFieldRow() {
        $row   = '';
        foreach($this->columns as $col) {

            if(isset($col['form_as']) && $col['form_as']['type'] == 'upload') {
                $name    = $col['name'];
                $row    .= "\t\t\t\t\t\t\t\t\t\t<td><img width=\"20\" class=\"rounded-circle\" src=\"{{ \$item->get_".$name."->url }}\" /></td>\n";
            } else {
                $name    = $col['name'];
                $row    .= "\t\t\t\t\t\t\t\t\t\t<td>{{ \$item->$name }}</td>\n";
            }
        }
    
        return $row;
    }


    public function createForm() {
        $file_name = 'form.blade.php';
        $path      = $this->viewDir.'/'.$file_name;

        $title     = ucwords(str_replace('_', ' ', $this->name_underscore));
        $stub      = $this->getStub('views/form');

        $fieldForm = $this->formField();

        $multipart = $this->multipart ? 'enctype="multipart/form-data"':'';
        $script    = $this->scripts.PHP_EOL."<script>\n".$this->script_code."\n</script>";

        $formInput = str_replace([
            "{{form_input}}","{{title}}", '{{scripts}}', '{{styles}}',      '{{multipart}}', '{{page-name}}'], [
            $fieldForm,       $title,      $script,      $this->styles,     $multipart,      $title], $stub);

        File::put($path, $formInput);
    }

    public function formField() {
        $field      = '';
        $types      = [];
        foreach($this->columns as $col) {
            $types[]    = $col['type'];
            $label      = ucwords(str_replace('_', ' ', $col['name']));
            $field_name = $col['name'];


            if(isset($col['related']['class'])) {
                //Add Relation to Form
                $stub = $this->formFieldRelated($label, $field_name, $col['related']['class']);
                
            } else if(isset($col['form_as'])) {
                //Manipulate Form
                $stub = $this->formAsType($col['form_as']['type'], $label, $field_name);
                $this->multipart = true;
            } else {
                $stub       = $this->getStub('views/Form/'.$col['type']);
                if(!$stub) {
                    $stub       = $this->getStub('views/Form/string');
                }
    
                $stub       = str_replace(["{{label}}", "{{field}}"],[$label, $field_name],$stub);
            }

            $field     .= $stub;
        }

        $this->unique_types = array_unique($types);

        return $field;
    }

    function formFieldRelated($label, $field_name, $class) {
        $stub           = $this->getStub('views/Form/related');
        $class_lower    = strtolower($this->from_camel_case($class));
        $stub           = str_replace(["{{label}}", "{{field}}", "{{class}}", "{{class_lower}}"],[$label, $field_name, $class, $class_lower], $stub);

        return $stub;
    }

    function formAsType($type, $label, $field_name) {
        $name = $type;
        $stub = $this->getStub('views/Form/as/'.$name);

        $stub = str_replace(["{{label}}", "{{field}}"],[$label, $field_name],$stub);

        return $stub;
    } 

    function build_assets() {
        //Build Script
        foreach($this->script_urls as $uri_js) {
            $this->scripts .= "<script src='$uri_js'></script>".PHP_EOL;
        }

        foreach($this->style_urls as $uri_css) {
            $this->styles .= "<link rel='stylesheet' href='$uri_css' />".PHP_EOL;
        }
        // dd($this->columns);
        foreach($this->columns as $col) {
            $code = $this->getStub('views/assets/'.$col['type'].'/js');
            if($code) {
                $this->script_code .= $code.PHP_EOL;
            }
            if(isset($col['form_as']['type']) && $col['form_as']['type'] == 'upload') {
                $code = $this->getStub('views/assets/upload/js');
                $this->script_code .= $code.PHP_EOL;
            }
        }

        if(count($this->relations)) {
            $code = $this->getStub('views/assets/select/js');
            $this->script_code .= $code.PHP_EOL;
        }

    }

    function assets_loader() {
        $types = [
            "text" => 'summernote',
            "date" => 'jQueryUI',
        ];

        $assets_loader = [];

        if(count($this->relations)) {
            $assets_loader[] = 'selectpicker';
        }

        foreach($this->columns as $col) {
            if(isset($types[$col['type']])) {
                $assets_loader[] = $types[$col['type']];
            }

            if(isset($col['form_as']['type']) && $col['form_as']['type'] == 'upload') {
                $assets_loader[] = 'custom-upload';
            }
        }

        $assets_name   = array_unique($assets_loader);
        $assets_config = require __DIR__ . '/Config/assets.php';

        foreach($assets_name as $name) {
            $_assets          = $assets_config[$name];
            
            //Build StyleUrls
            $css              = $_assets['css_url'];
            if(!is_null($css)) {
                $this->style_urls = array_merge($this->style_urls, $css);
            }

            //Build ScriptUrls
            $js                = $_assets['js_url'];
            if(!is_null($js)) {
                $this->script_urls = array_merge($this->script_urls, $js);
            }
        }

        $this->build_assets();
    }
}