<?php
	require('../../global.php');
	require('inc/setting.inc.php');
	
	switch($ac){
		case 'edit':
			$issetbar = $kindid == 1 ? 0 : 1;
			$set = array(
				"icon = '$val_icon'",
				"name = '$val_name'",
				"kindid = $val_kindid",
				"url = '$val_url'",
				"width = $val_width",
				"height = $val_height",
				"isresize = $val_isresize",
				"issetbar = $issetbar",
				"isflash = $val_isflash",
				"remark = '$val_remark'"
			);
			if($id == ''){
				$set[] = "dt = now()";
				$db->insert(0, 0, 'tb_app', $set);
			}else{
				$sqlwhere = "and tbid = $id";
				$db->update(0, 0, 'tb_app', $set, $sqlwhere);
			}
			break;
		case 'uploadImg':
			include('libs/Uploader.class.php');
			$config = array(
				"savePath" => 'dofiles/shortcut/', //保存路径
				"allowFiles" => array('.jpg', '.jpeg', '.png', '.gif', '.bmp'), //文件允许格式
				"maxSize" => 1000 //文件大小限制，单位KB
			);
			$up = new Uploader('xfile', $config);
			$info = $up->getFileInfo();
			echo '{"url":"'.$info['url'].'","fileType":"'.$info['type'].'","original":"'.$info['originalName'].'","state":"'.$info['state'].'"}';
			break;
	}
?>