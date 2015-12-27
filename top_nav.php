<?php
  function selected ($page){
    $index = null ;
    $sell = null;
    $purchase = null ;
    $mal_ferot = null;
    $baki_khata = null ;
    $reports = null;
    $inventory_configuration = null ;
    $mal_check = null;
    if($page == 'index'){
      $index = 'selected';
    } else if ($page == 'sell'){
      $sell = 'selected';
    } else if ($page == 'purchase'){
      $purchase = 'selected';
    } else if ($page == 'mal_ferot'){
      $mal_ferot = 'selected';
    } else if ($page == 'baki_khata'){
      $baki_khata = 'selected';
    } else if ($page == 'reports'){
      $reports = 'selected';
    } else if ($page == 'inventory_configuration'){
      $inventory_configuration = 'selected';
    } else if ($page == 'mal_check'){
      $mal_check = 'selected';
    }
      
  echo"
  <div class=\"top-nav\">
      <ul>
        <li>
          <a href=\"sell.php\" class=\"$sell\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            বিক্রি
          </a>
        </li>
        <li>
          <a href=\"purchase.php\"class=\"$purchase\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            গোডাউন
          </a>
        </li>
        <li>
          <a href=\"mal_ferot.php\"class=\"$mal_ferot\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            মাল ফেরতের হিসাব
          </a>
        </li>
        <li>
          <a href=\"baki_khata.php\"class=\"$baki_khata\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            খাতার তালিকা
          </a>
        </li>
        <li>
          <a href=\"inventory_view.php\"class=\"$reports\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            রিপোর্ট ও প্রোফাইল
          </a>
        </li>
        <li>
          <a href=\"inventory_configuration.php\"class=\"$inventory_configuration\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            জুতার ধরন
          </a>
        </li>
        <li>
          <a href=\"pid_print_custom.php\">
            <div class=\"fs1\" aria-hidden=\"true\" ></div>
            কাস্টম প্রিন্ট
          </a>
        </li>
        <li>
          <a href=\"mal_check.php\" class=\"$mal_check\">
              মাল চেক
          </a>
        </li>
        <li>
          
        </li>
      </ul>
      <div class=\"clearfix\">
      </div> </div>";
   
  }