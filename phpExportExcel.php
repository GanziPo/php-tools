<?php

/**
 * 创建(导出)Excel数据表格
 * @param array $list 要导出的数组格式的数据
 * @param string $filename 导出的Excel表格数据表的文件名
 * @param array $header Excel表格的表头
 * @param array $index $list数组中与Excel表格表头$header中每个项目对应的字段的名字(key值)
 * 比如: $header = array('编号','姓名','性别','年龄');
 *  $index = array('id','username','sex','age');
 *  $list = array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24));
 * @return [array] [数组]
 */
function export_excel1($list,$filename,$header=array(),$index = array(),$se_time = null){
    if (!empty($se_time["start_time"]) && !empty($se_time["end_time"])) {
     $filename.=implode("  ", $se_time);
    }
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=".$filename.".xls");
    $teble_header = implode("\t",$header);
    $strexport = $teble_header."\r";
    foreach ($list as $row){
        foreach($index as $val){
            $strexport.=$row[$val]."\t";
        }
        $strexport.="\r";

    }
    $strexport=iconv('UTF-8',"GB2312//IGNORE",$strexport);
    exit($strexport);
}

//----------------excel2 start-----------------------------
/**
 * @param $datas  具体数据
 * @param $titles 列名
 * @param $filename 文件名
 * vnd.ms-excel.numberformat:@: 规定输出格式为纯文本
 */
function export_to_excel2($datas, $filename,$titles)
{
    $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
    $str .= "<table border=1>";
    //表头
    $str .= "<tr>";
    foreach ($titles as $title) {
        $str .= "<td style='width: 160px;'>{$title}</tdw>";
    }
    $str .= "</tr>\n";
    //具体数据
    foreach ($datas as $key => $rt) {
        $str .= "<tr>";
        foreach ($rt as $k => $v) {
            $str .= "<td style='width: 160px;vnd.ms-excel.numberformat:@'>{$v}</td>";
        }
        $str .= "</tr>\n";
    }
    $str .= "</table></body></html>";
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=".$filename.".xls");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/download");;
    header("Pragma: no-cache");
    exit($str);
}
