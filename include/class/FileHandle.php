<?php
	class FileHandle{
		public static function Upload($FileObj,$FileRoot,$FileName){
			// 存入暫存區的檔名
			$File_tmp = $FileObj['tmp_name'];
			//判斷欄位是否指定上傳檔案…
			if(is_uploaded_file($File_tmp)){
				//如果沒有輸入檔名，則用物件原來的檔名
				if($FileName==""){$FileName=$FileObj['name'];}
				//將檔名空白部分取代為'_'
				$FileName = str_replace(' ', '_', $FileName);
				//一律改為以日期時間命名
				$ExtendName = strtolower(FileHandle::GetExtendName($FileName));
				if(strrpos($ExtendName,'php') === false){
					if(FileHandle::GetExtendName($FileName)!=""){
						$FileName = date("Ymdhis",time()+8*60*60).".".FileHandle::GetExtendName($FileName);	
					}else{
						$FileName = date("Ymdhis",time()+8*60*60);
					}
					//查看此檔名是否已存在，若存在，則產生新檔案名稱	
					$NewFileName = FileHandle::MakeFile($FileRoot,$FileName);
					if(!@move_uploaded_file($File_tmp,iconv("utf-8", "big5",$FileRoot.$NewFileName))){
						//move_uploaded_file() 不能處理 utf-8 中文編碼，需利用 iconv() 函數作轉碼
						echo "檔案：".$FileName."上傳失敗";
						return "";
					}else{
						return $NewFileName;
					}
				}else{
					notify("檔案：".$FileName."上傳失敗",'','window.history.back()');
					return "";
				}
			}else{
				return "";
			}
		}
		
		public static function Delete($FileRoot,$FileName){
			if($FileName!=""){
				if(@fopen(iconv("utf-8", "big5",$FileRoot.$FileName),"rb")){
					if(!(@unlink(iconv("utf-8", "big5",$FileRoot.$FileName)))){
						echo "檔案：".$FileName."刪除失敗";
						return $FileName;
					}else{
						return "";	
					}
				}
			}
		}
		
		public static function Move($SourceFolder,$SourceFileName,$TargetFolder){
			//一律改為以日期時間命名
			if(FileHandle::GetExtendName($SourceFileName)!=""){
				$FileName = date("Ymdhis",time()+8*60*60).".".FileHandle::GetExtendName($SourceFileName);	
			}else{
				$FileName = date("Ymdhis",time()+8*60*60);
			}
			//查看此檔名是否已存在，若存在，則產生新檔案名稱	
			$NewFileName = FileHandle::MakeFile($TargetFolder,$FileName);			
			copy($SourceFolder.$SourceFileName,$TargetFolder.$NewFileName);
			FileHandle::Delete($SourceFolder,$SourceFileName);
			return $NewFileName;
		}
		
		//取得副檔名
		public static function GetExtendName($FileName){
			$RtnVal = "";
			if(strrpos($FileName,".")!=false){
				$RtnValArray = explode(".", $FileName);
				$RtnVal = $RtnValArray[count($RtnValArray) - 1];
			}
			return $RtnVal;
		}
		
		//取得除副檔名之外的名稱
		public static function GetFileName($FileName){
			if(strrpos($FileName,".")!=false){
				$RtnValArray = explode(".", $FileName);
				$RtnVal = "";
				for($i=0;$i<=count($RtnValArray)-2;$i++){
					$RtnVal .= $RtnValArray[$i];
					if($i!=count($RtnValArray)-2){$RtnVal .=".";}
				}
			}
			return $RtnVal;
		}		
		
		public static function MakeFile($TargetFilePath,$TargetFileName){
			$MakeFileSuccess = false;
			$MakeFileFlag = 0 ;
			$FileExtendName = FileHandle::GetExtendName($TargetFileName);
			$FileSourceName = FileHandle::GetFileName($TargetFileName);
		
			while(!$MakeFileSuccess){
				if($MakeFileFlag > 0){
					$TestResult = file_exists(iconv("utf-8", "big5",$TargetFilePath.$FileSourceName."(".$MakeFileFlag.").".$FileExtendName));
				}else{
					$TestResult = file_exists(iconv("utf-8", "big5",$TargetFilePath.$FileSourceName.".".$FileExtendName));
				}
				if(!$TestResult){
					if($MakeFileFlag > 0){
						return 	$FileSourceName."(".$MakeFileFlag.").".$FileExtendName;
					}else{
						return 	$FileSourceName.".".$FileExtendName;
					}
					$MakeFileSuccess = true;
				}else{
					$MakeFileFlag++;
				}
			}
		}
		
		//檔案下載
		public static function Downloadfile($file,$filename){
			// Must be fresh start
			$filename = mb_convert_encoding($filename, 'BIG-5','UTF-8');
			if( headers_sent()){die('Headers Sent');}
			// Required for some browsers
			if(ini_get('zlib.output_compression')){ini_set('zlib.output_compression', 'Off');}

			// File Exists?
			if( file_exists($file) ){
				// Parse Info / Get Extension
				$fsize = filesize($file);
				$path_parts = pathinfo($file);
				$ext = strtolower($path_parts["extension"]);

				// Determine Content Type
				switch ($ext) {
					case "pdf": $ctype="application/pdf"; break;
					case "exe": $ctype="application/octet-stream"; break;
					case "zip": $ctype="application/zip"; break;
					case "doc": $ctype="application/msword"; break;
					case "xls": $ctype="application/vnd.ms-excel"; break;
					case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
					case "gif": $ctype="image/gif"; break;
					case "png": $ctype="image/png"; break;
					case "jpeg":
					case "jpg": $ctype="image/jpg"; break;
					case "php": die('File Not Found'); break;
					default: $ctype="application/force-download";
				}

				header("Pragma: public"); // required
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false); // required for certain browsers
				header("Content-Type: $ctype");
				header("Content-Disposition: attachment; filename=\"".$filename."\";" );
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".$fsize);
				ob_clean();
				flush();
				// 讀取來源檔案資料
				if ($stream = fopen($file, 'rb')){
					while(!feof($stream) && connection_status() == 0){
						echo(fread($stream,1024*8));
						flush();
					}
					fclose($stream);
				}							
			}else{
				die('File Not Found');
			}
		}
		//刪除資料夾
		public static function Deltree($dir){
			if(is_dir($dir)){
				$TrackDir = opendir($dir);
				while ($file = readdir($TrackDir)){
					if (!($file == "." || $file == "..")){
						if(is_dir($dir.$file)){
							FileHandle::Deltree($dir.$file.'/');
						}else if(is_file($dir.$file)){
							unlink($dir.$file);
						}
					}	
				}
				closedir($TrackDir);
				rmdir($dir);
			}
		}
	}
?>