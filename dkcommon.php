<?php
function filter_money($money, $accuracy = 2)
{
    $str_ret = 0;
    if (empty($money) === false) {
        $str_ret = sprintf("%.".$accuracy."f", substr(sprintf("%.".($accuracy+1)."f", floatval($money)), 0, -1));
    }

    return floatval($str_ret);
}

function debx($dkm, $dkTotal, $dknl)  
{  
    $emTotal = $dkTotal * $dknl / 12 * pow(1 + $dknl / 12, $dkm) / (pow(1 + $dknl / 12, $dkm) - 1); //每月还款金额  
    $lxTotal = 0; //总利息  
    return filter_money($emTotal);
    /*
    for ($i = 0; $i < $dkm; $i++) {  
        $lx      = $dkTotal * $dknl / 12;   //每月还款利息  
        $em      = $emTotal - $lx;  //每月还款本金  
        echo "第" . ($i + 1) . "期", " 本金:", $em, " 利息:" . $lx, " 总额:" . $emTotal, "\n";  
        $dkTotal = $dkTotal - $em;  
        $lxTotal = $lxTotal + $lx;  
        //break;
    }  */
}  
      
function debj($dkm, $dkTotal, $dknl)  
{  
    $em      = $dkTotal / $dkm; //每个月还款本金  
    $lxTotal = 0; //总利息  
    for ($i = 0; $i < $dkm; $i++) {  
        $lx      = $dkTotal * $dknl / 12; //每月还款利息  
        echo "第" . ($i + 1) . "期", " 本金:", $em, " 利息:" . $lx, " 总额:" . ($em + $lx), "\n";  
        $dkTotal -= $em;  
        $lxTotal = $lxTotal + $lx;  
        return filter_money($em + $lx);
    }  
}

function format_request_dk_value($slotName,$value)
{
	$result = null;
	switch($slotName)
	{
	case "loan":
		$result = intval($value);
		$result = $result > 0 ? $result : null;
		break;
	case "years":
		$result = intval($value) * 12;
		$result = ($result > 0 && $result < 1200) ? $result : null;
		break;
	case "method":
		$result = empty($value) ? null : $value;
		break;
	default:
		$result = null;
	}
	return $result;
}
?>