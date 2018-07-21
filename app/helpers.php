<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20/07/2018
 * Time: 9:26 AM
 */

if (! function_exists('paginate')) {
    function paginate($total,$limit=2) {
//        dd($_SERVER);
        $host=$_SERVER['HTTP_HOST'];
        $pathInfo=!empty($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'';
        $totalPage=ceil($total/$limit);
        $page=0;
        $flag=false;

        if (!empty($_SERVER['QUERY_STRING'])){
            $queryString=$_SERVER['QUERY_STRING'];
            $queryArray=explode('&',$queryString);
            foreach ($queryArray as $key1 => $item) {
                if (strpos($item,"=")!=false){
                    list($key2,$val)=explode("=",$item);
                    if ($key2=='page'){
                        $page=$val;
                        unset($queryArray[$key1]);
                        $flag=true;
                    }
                }
            }
            $queryString=implode("&",$queryArray);
        }

        if (!empty($queryString)&&$flag==true){
            $fullurl="http://".$host.$pathInfo.'?'.$queryString."&page={page}";
        }else{
            $fullurl="http://".$host.$pathInfo."?page={page}";
        }

        $page=($page<=0)?1:(($page>$totalPage)?$totalPage:$page);

//        $string = preg_replace('/&page=\d+(?=&)?/', '', $fullurl);

        $offset=($page-1)*$limit;

        $html='<ul class="pagination"><li class="page-item"><a class="page-link" href="'.str_replace("{page}",($page<0)?1:$page-1,$fullurl).'">Prev</a></li>';
        for ($i=1; $i <= $totalPage; $i++) {
            if ($page==$i) {
                $html.='<li class="page-item active"><a class="page-link" href="">'.$i.'</a></li>';
            }else{
                $html.='<li class="page-item"><a class="page-link" href="'.str_replace("{page}",$i,$fullurl).'">'.$i.'</a></li>';
            }
        }
        $html.='<li class="page-item"><a class="page-link" href="'.str_replace("{page}",$page+1,$fullurl).'">Next</a></li></ul>';

        if ($total<=$limit){
            $html='';
        }
        return [
            'offset'=>$offset,
            'html'=>$html
        ];
    }
}