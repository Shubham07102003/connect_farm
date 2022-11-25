<?php
namespace Options;
class Options{
    private $opt;
    private $indexes;

    /**
     * @return mixed
     */
    public function getOpt()
    {
        return $this->opt;
    }

    /**
     * @return mixed
     */
    public function getIndexes()
    {
        return $this->indexes;
    }

    public function __construct($opt,$indexes)
    {
        $this->indexes = $indexes;
        $this->opt = $opt;

        foreach ($opt as $item){
        ${'this->validate'.$item} = true;
        }


    }
}