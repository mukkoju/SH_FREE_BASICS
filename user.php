<?php

class User {
  
  public function getRecent(){
    $db =  new PDO('mysql:host=localhost;dbname=saddahaq_facebook_apps', 'root', 'dambo');
    $tmp = $db->query("SELECT _ID_ id FROM table_free_basics_saddahaq ORDER BY _Tme_ DESC LIMIT 0,40");
    $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
    return $res[0];
  }
  
}
