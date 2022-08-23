<?php

class Pagination {
    public $total_row;
    public $page;
    public $limit; 
    public $offset;
    public $total_page;
    public $url = "";
    public $type = "";
    public $btnClass;
    public function setValue($total_row, $page=1, $limit=10, $url='') {
        $this->total_row  = $total_row;
        $this->page       = $page > 0 ? $page : 1;
        $this->total_page = ceil($total_row/$limit);
        $this->page       = $this->total_page == 1 || $this->total_page < $page ? 1 : $this->page;
        $this->limit      = $limit;
        $this->offset     = ($this->page-1)*$limit;
        $this->url        = $url;
    }

    public function printPage($i) {
        $hightlight = $this->page==$i ? "hightlight":"no_hightlight";
        if(strtolower($this->type)=='ajax'){
            if($this->page==$i){
                echo "<button class='$hightlight btn_hightlight' value='".($i)."'>$i</button>";                
            }else{
                echo "<button class='".$this->btnClass."' value='".($i)."'>$i</button>";                
            }
        }else{
            if($this->page==$i){
                echo '<a class='."$hightlight".' href="#">'."$i".'</a>'; 
            }else{
                echo '<a class='."$hightlight".' href="?'.$this->url.'page='.($i).'">'."$i".'</a>'; 
            }
        }
    }

    public function printNext() {
        $p = $this->page;
        if(strtolower($this->type)=='ajax')
            echo "<button class='".$this->btnClass." btn_asc' value='".($p+1)."'>Next</button>";
        else
            echo '<a class="a_asc" href="?'.$this->url.'page='.($p+1).'">Next</a>';
    }

    public function printPrev() {
        $p = $this->page;
        if(strtolower($this->type)=='ajax')
            echo "<button class='".$this->btnClass." btn_desc' value='".($p-1)."'>Prev</button>";
        else
            echo '<a class="a_desc" href="?'.$this->url.'page='.($p-1).'">Prev</a>';
    }

    public function printdot() {
        if(strtolower($this->type)=='ajax')
            echo "<button class='dotdot'>...</button>";
        else
            echo '<a class="dotdot" href="#">...</a>';
    }


    public function getPage($type = 'noAjax', $btnClass = 'btn_page') {
        $this->type = $type;
        $this->btnClass = $btnClass;
        echo "<div class='page'>";
        // nếu page > 1 và total_page > 1 mới hiển thị nút prev
        $p = $this->page;
        if ($p > 1 && $this->total_page > 1){
            $this->printPrev();
        }    
        if($this->total_page<=6):                     
            for ($i=1 ; $i <= $this->total_page; $i++) { 
                $this->printPage($i);
            }     
        elseif($this->total_page>6):
            for ($i=1; $i <=3 ; $i++) { 
                $this->printPage($i);
            }
            if($p>6) $this->printdot();
            $dk = ($p+2)<=$this->total_page-3?$p+2:$this->total_page-3;
            for ($i=($p-2)>3?$p-2:4; $i<=$dk ; $i++) {                     
                $this->printPage($i);                    
            }
            if($p<$this->total_page-5) $this->printdot();               
            for ($i=$this->total_page-2; $i <= $this->total_page ; $i++) { 
                $this->printPage($i);
            }             
        endif;
        // nếu page < total_page và total_page > 1 mới hiển thị nút next
        if ($p < $this->total_page && $this->total_page > 1){
            $this->printNext();
        }
        echo "</div>";
    }

    public function getPageMobile($type = 'noAjax', $btnClass = 'btn_page') {
        $this->type = $type;
        $this->btnClass = $btnClass;
        echo "<div class='page'>";
        // nếu page > 1 và total_page > 1 mới hiển thị nút prev
        $p = $this->page;
        if ($p > 1 && $this->total_page > 1){
            $this->printPrev();
        }  

        if($this->total_page<=4):                     
            for ($i=1 ; $i <= $this->total_page; $i++) { 
                $this->printPage($i);
            }     
        elseif($this->total_page>4):
            for ($i=1; $i <=2 ; $i++) { 
                $this->printPage($i);
            }
            if($p>4) $this->printdot();
            $dk = ($p+1)<=$this->total_page-3?$p+1:$this->total_page-2;
            for ($i=($p-1)>2?$p-1:3; $i<=$dk ; $i++) {                     
                $this->printPage($i);                    
            }
            if($p<$this->total_page-3) $this->printdot();               
            for ($i=$this->total_page-1; $i <= $this->total_page ; $i++) { 
                $this->printPage($i);
            }             
        endif;


        // nếu page < total_page và total_page > 1 mới hiển thị nút next
        if ($p < $this->total_page && $this->total_page > 1){
            $this->printNext();
        }
        echo "</div>";
    }
}
?>