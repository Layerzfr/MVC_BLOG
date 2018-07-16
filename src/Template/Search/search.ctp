<?php
use Cake\ORM\TableRegistry;

if(isset($_GET['p'])){
    $page = $_GET['p'];
}else{
    $page = 1;
}
$search = explode('/', $_SERVER['REQUEST_URI']);
$query = TableRegistry::get('Billet')->find('all', array(
    'conditions' => array(
      'or' => array(
        'content LIKE' => '%'.$search[2].'%',
        'tags LIKE' => '%'.$search[2].'%',
        'title LIKE' => '%'.$search[2].'%'
      )
    )
  ))->limit(5)->page($page);
$lev = $query->func()->levenshtein([$search[2], 'Billet.tags' => 'literal']);
$query->where(function ($exp) use ($lev) {
    return $exp->between($lev, 0, 5 );
});
$queryNonLeven = TableRegistry::get('Billet')->find('all', array(
    'conditions' => array(
      'or' => array(
        'content LIKE' => '%'.$search[2].'%',
        'tags LIKE' => '%'.$search[2].'%',
        'title LIKE' => '%'.$search[2].'%'
      )
    )
  ))->limit(5)->page($page);

foreach($query as $searchQuery){
    echo "<a href='/billet/".$searchQuery->id."/search/".$search[2]."'>".$searchQuery->title."</a>";
    echo "<p>Content: ".substr($searchQuery->content, 0, 200)."</p>";
}
foreach($queryNonLeven as $searchNonLeven){
    echo "<a href='/billet/".$searchNonLeven->id."/search/".$search[2]."'>".$searchNonLeven->title."</a>";
    echo "<p>Content: ".substr($searchNonLeven->content, 0, 200)."</p>";
}

?>