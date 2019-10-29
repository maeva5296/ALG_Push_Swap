<?php

class pushswap
{
    public $la;
    public $lb;
    public $tab = [];

	public function __construct($argv)
	{
        $this->la = $argv;
        $this->lb = [];
    }

    public function sa()
    {
        if (count($this->la) >= 2) 
        {
            $tmp = $this->la[1];
            $this->la[1] = $this->la[0];
            $this->la[0] = $tmp;
            $this->tab[] = "sa";
        }
    }

    public function sb()
    {
        if (count($this->lb) >= 2) 
        {
            $tmp = $this->lb[1];
            $this->lb[1] = $this->lb[0];
            $this->lb[0] = $tmp;
            $this->tab[] = "sb";
        }
    }

    public function sc()
    {
        $this->sa();
        $this->sb();
        $this->tab[] = "sc";
    }

    public function pa()
    {
        if (!empty($this->lb)) 
        {
            $element = array_shift($this->lb);
            array_unshift($this->la, $element);
            $this->tab[] = "pa";
        }
    }

    public function pb()
    {
        if (!empty($this->la)) 
        {
            $element = array_shift($this->la);
            array_unshift($this->lb, $element);
            $this->tab[] = "pb";
        }
    }

    public function ra()
    {
        $element = array_shift($this->la);
        array_push($this->la, $element);
        $this->tab[] = "ra";
    }
    
    public function rb()
    {
        $element = array_shift($this->lb);
        array_push($this->lb, $element);
        $this->tab[] = "rb";
    }

    public function rr()
    {
        $this->ra();
        $this->rb();
        $this->tab[] = "rr";
    }

    public function rra()
    {
        $element = array_pop($this->la);
        array_unshift($this->la, $element);
        $this->tab[] = "rra";
    }

    public function rrb()
    {
        $element = array_pop($this->lb);
        array_unshift($this->lb, $element);
        $this->tab[] = "rrb";
    }

    public function rrr()
    {
        $this->rra();
        $this->rrb();
        $this->tab[] = "rrr";
    }

    public function small($la)
    {
        if(current($this->la) < next($this->la))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function sortla()
    {
        for ($i=0; $i < count($this->la); $i++) 
        { 
            $small = $this->small($this->la);
  
            if($small == false)
            {
                $this->ra();
            }
            else
            {
                $this->sa();
                $this->ra();
            }
        }
        $this->pb();
        
        if (!empty($this->la)) 
        {
            $this->sortla();
        }
        $this->pa();
    }

    public function space()
    {
        $dollar = implode(" ", $this->tab);
        echo $dollar;
    }
}

unset($argv[0]);
$la = array_values($argv);

$pushswap = new pushswap($la);
$pushswap->sortla();

$la = $pushswap->la;
$lb = $pushswap->lb;
$pushswap->space();
echo PHP_EOL;

?>