<?php

class User {
  
  public function getRecent($tp){
    $db =  new PDO('mysql:host=localhost;dbname=saddahaq_facebook_apps', 'root', 'vivenfarms');
    $tmp = $db->query("SELECT _ID_ id FROM table_free_basics_saddahaq WHERE _Typ_ = ".$db->quote($tp)." ORDER BY _Tme_ DESC LIMIT 0,42");
    $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
    return $res[0];
  }
  
}
