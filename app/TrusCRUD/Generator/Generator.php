<?php
namespace App\TrusCRUD\Generator;


/*
    Base trait Generator
*/

trait Generator {
    
    public $name;
    public $name_underscore;
    public $columns          = [];
    public $relations        = [];
    public $viewDir;
    public $searchable       = 'name';
    public $controller       = '';
    public $location         = 'TrusCRUD/Generator';
    public $column_key       = '';

    public $generate_menu    = true;


    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setGenerateMenu($boolean) {
        $this->generate_menu = $boolean;

        return $this;
    }

    public function setSearchable($column) {
        $this->searchable = $column;
        return $this;
    }

    public function addColumn($name, $type) {
        $this->columns[$name] = [
            "name"          => $name,
            "type"          => $type,
            "nullable"      => 0,
            "related"       => []
        ];
        $this->column_key = $name;
        return $this;
    }

    public function relation($type, $className) {
        $data = [
            'type'  => $type,
            'class' => $className,
            'fk'    => $this->column_key,
        ];
        $this->columns[$this->column_key]['related'] = $data;
        $this->relations[]  = $data;
        return $this;
    }

    public function formAs($formType) {
        $data = [
            "type" => $formType //upload
        ];
        
        $this->columns[$this->column_key]['form_as'] = $data;
    }

    public function getStub($path) {
        $path = app_path($this->location.'/Stubs/'.$path.'.stub');
        if(!file_exists($path)) {
            return false;
        }

        return file_get_contents($path);
    }

    public function from_camel_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }
    

    public function underscore_to_space($input) {
        return str_replace('_', ' ', $input);
    }
}