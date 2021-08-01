
<?php include "lib/Database.php";?>
<?php include "helpers/format.php";?>
<?php include "config/config.php";?>

<?php
	$db = new Database();
	$fm = new format();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000"); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		if(isset($_GET['pageviewid'])){
				$pageviewid = $_GET['pageviewid'];
				$query = "SELECT* FROM tbl_pages WHERE id ='$pageviewid'  ";
				$gettitle =$db->select($query);
				if($gettitle){
					while($result = $gettitle->fetch_assoc()){?>
							<title><?php echo $result['title'];?>||<?php echo TITLE;?></title>
						<?php

					}
				}if(isset($_GET['id'])){
					$getPostid = $_GET['id'];
					$query = "SELECT FROM tbl_post WHERE id = '$getPostid' ";
					$getPosttitle =$db->select($query);
					if($getPosttitle){
							while($presult = $getPosttitle->fetch_assoc()){?>
									<title><?php echo $presult['title'];?>||<?php echo TITLE;?></title>
								<?php

							}
					}
				}
			}
			?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php
	if(isset($_GET['id'])){
		$keywordid = $_GET['id'];
		$query = "SELECT *FROM tbl_post WHERE id = '$keywordid'";
		$keywords = $db->select($query);
		if($keywords){
			while ($result = $keywords->fetch_assoc()) {
				?>
					<meta name="keywords" content="<?php echo $result['tags']?>">

				<?php
			}
		}else{
			?><meta name="keywords" content="<?php echo KEYWORDS;?>"><?php
		}
	}
	

	?>
	
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
				   <?php
                    $query = "SELECT* FROM tbl_title WHERE id = '1' ";
                    $blog_title = $db->select($query);
                    if($blog_title){
                        while($result = $blog_title->fetch_assoc()){

                ?> 
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			<?php }}?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php 
					$query = "SELECT * FROM tbl_social WHERE id = '1' ";
					$getSocial = $db->select($query);
						if($getSocial){
							while($result= $getSocial->fetch_assoc()){
?>
				<a href="<?php echo $result['fb'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['ln'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
					<?php }}?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="post">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php
			$path = $_SERVER['SCRIPT_FILENAME'];
			$currentpage = basename($path,'.php');

	?>
	<ul>
		<li><a <?php if($currentpage == 'index'){echo  ' id="active"';}?>href="index.php">Home</a></li>
		<?php 
			$query = "SELECT* FROM tbl_pages";
			$getPages = $db->select($query);
			if($getPages){
				while($result = $getPages->fetch_assoc()){?>

		<li><a
			<?php 
				if(isset($_GET['pageviewid']) && $_GET['pageviewid'] == $result['id']){
						echo ' id="active"';
				}
			?>
		 href = "pageview.php?pageviewid=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></li>
		<?php }}?>	
		<li><a <?php if($currentpage == 'contact'){echo  ' id="active"';}?> href="contact.php">Contact</a></li>
	</ul>
</div>

