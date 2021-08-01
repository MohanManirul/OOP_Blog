

<?php
	/**
	 * format class
	 */
	class format{
		public function formatDate($date){
			return date('F j, Y, g:i a', strtotime($date));	
		}
		public function textShorten($text , $limit=400){
				$text = $text." ";
				$text = substr($text, 0,$limit);
				$text = substr($text, 0,strrpos($text, " "));
				$text = $text."...";
				return $text;
		}
		public function validation($data){
				$data = trim($data);// trim spaces
				$data = stripcslashes($data);//remove back slashess
				$data = $data;//convert html special cheracters
				return $data;
		}
		public function title(){
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($path,'.php');
			if($title == 'index'){
				$title = 'Home';
			}elseif($title == 'contact'){
				$title = 'contact';
			}
			return $title =ucfirst($title);
		}
	}

?>