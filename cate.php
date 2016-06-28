<?php 
	header("Content-Type: text/html; charset=UTF-8");
	Class Category {
		//组合一维数组
		Static Public function unlimitedForLevel ($cate, $html = '--', $pid = 0, $level = 0) {
			$arr = array();
			foreach ($cate as $k => $v) {
				if ($v['pid'] == $pid) {
					$v['level'] = $level + 1;
					$v['html']  = str_repeat($html, $level);
					$arr[] = $v;
					$arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
				}
			}
			return $arr;
		}
		//组合多维数组
		Static Public function unlimitedForLayer ($cate, $name = 'child', $pid = 0) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
					$arr[] = $v;
				}
			}
			return $arr;
		}
		//传递一个子分类ID返回所有的父级分类  
		Static Public function getParents ($cate, $id) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['id'] == $id) {
					$arr[] = $v;
					$arr = array_merge(self::getParents($cate, $v['pid']), $arr); 
				}
			}
			return $arr;
		}
		//传递一个父级分类ID返回所有子分类ID
		Static Public function getChildsId ($cate, $pid) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$arr[] = $v['id'];
					$arr = array_merge($arr, self::getChildsId($cate, $v['id']));
				}
			}
			return $arr;
		}
		//传递一个父级分类ID返回所有子分类
		Static Public function getChilds ($cate, $pid) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$arr[] = $v;
					$arr = array_merge($arr, self::getChilds($cate, $v['id']));
				}
			}
			return $arr;
		}

	}

$cate = array(
    0 => array('id' => 1, 'pid' => 0, 'name' => '江西省'),
    1 => array('id' => 2, 'pid' => 0, 'name' => '浙江省'),
    2 => array('id' => 3, 'pid' => 1, 'name' => '上饶市'),
    3 => array('id' => 4, 'pid' => 3, 'name' => '广丰县'),
    4 => array('id' => 5, 'pid' => 2, 'name' => '杭州市'),
    5 => array('id' => 6, 'pid' => 5, 'name' => '西湖'),
    6 => array('id' => 7, 'pid' => 6, 'name' => '断桥'),
);
//print_r(Category::unlimitedForLevel($cate));
print_r(Category::unlimitedForLayer($cate));
//print_r(Category::getParents($cate,7));
//print_r(Category::getChildsId($cate,2));
//print_r(Category::getChilds($cate,2));

 ?>