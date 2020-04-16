<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableBootstrap extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $results;
    public array  $columns = [];
    public array  $values  = [];
    public string $resource = '';

    public function __construct($results, $columns=[], $values=[], $resource)
    {
        //
        $this->results   = $results;
        $this->columns   = $columns;
        $this->values    = $values;
        $this->resource  = $resource;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $results  = $this->results;
        $column   = $this->render_column();
        $values   = $this->values;
        // dd($column);

        return view('components.table-bootstrap', compact('results','column','values'));
    }


    function render_column() {
        $html = "";

        foreach($this->columns as $value) {
            if($value == "NUM") {
                $title = "#";
            } elseif($value == 'ACT') {
                $title = "Action";
            } else {
                $title = $value;
            }
            $html .= '<th>'.$title.'</th>'.PHP_EOL;
        }

        return $html;
    }
}
