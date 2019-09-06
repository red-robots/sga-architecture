<?php
/**
 * Template Name: Careers
 *
 */
include( get_template_directory() . '/inc/simple_html_dom.php');
//get_header('careers');
get_header(); 
?>
<div id="primary" class="full-content-area careers-content">
	<?php  
	$placeholder = get_field('video_thumbnail');
	$style = ($placeholder) ? ' style="background-image:url('.$placeholder['url'].')"' : ''; 
	$video_mp4 = get_field('video_mp4');
	$video_ogg = get_field('video_ogg');
	?>
	<div class="video-wrapper"<?php echo $style ?>>
		<?php if ($video_mp4 || $video_ogg) { ?>
			<div id="vidwrap" class="videowrap">
				<video id="video" width="400" height="300" playsinline>
					<?php if ($video_mp4) { ?><source src="<?php echo $video_mp4; ?>" type="video/mp4"><?php } ?>
					<?php if ($video_ogg) { ?><source src="<?php echo $video_ogg; ?>" type="video/ogg"><?php } ?>
					<p>Your browser doesn't support HTML5 video. 
						<?php if ($video_mp4) { ?><a href="<?php echo $video_mp4; ?>">Download</a> the video instead. <?php } ?>
					</p>
				</video>
			</div>
			<div id="video-controls">
			    <button type="button" id="play-pause" class="playpauseBtn play">Play</button>
			</div>
		<?php } ?>
	</div>
	<header class="pageheader">
		<div id="titlewrap" class="wrapper"><h1><?php echo get_the_title(); ?></h1></div>
		<span class="sidehline left"></span>
	</header>
	<main id="main" class="site-main clear" role="main">
		<div class="wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if( $intro = get_field('intro') ) { ?>
			<div class="intro"><?php echo $intro; ?></div>
			<?php } ?>
			<?php if($location_title = get_field('office_location_title')) { ?>
			<h3 class="midtitle"><?php echo $location_title; ?></h3>
			<?php } ?>
		<?php endwhile; wp_reset_postdata(); ?>
			
		<?php  
		$args = array(
			'posts_per_page'=> -1,
			'post_type'		=> 'locations',
			'post_status'	=> 'publish'
		);
		$locations = new WP_Query($args);
		if ( $locations->have_posts() ) { ?>
			<div class="office-locations clear">
				<div class="flexwrap">
				<?php $i=1; while ( $locations->have_posts() ) : $locations->the_post(); 
					$location_name = get_the_title();
					$map = get_field('map');
					$address = get_field('address');
					$description = get_field('description');
					$phone = get_field('phone');
					$weather = get_field('weather');
					$video_thumb = get_field('video_thumb');
					$vidmp4 = get_field('video_mp4');
					$vidogg = get_field('video_ogg');
					$thumbnail = ($video_thumb) ? ' style="background-image:url('.$video_thumb['url'].')"' : ''; 
					?>
					<div class="location">
						<div class="wrapinner">
							<div class="box1 clear">
								<?php if ($map) { ?>
								<div class="mapdiv">
									<img src="<?php echo $map['url']; ?>" alt="<?php echo $map['title']; ?>" />
								</div>	
								<?php } ?>
								<h3 class="name"><?php echo $location_name; ?></h3>
								<?php if ($address) { ?>
								<address class="address">
									<?php echo $address ?>
								</address>	
								<?php } ?>
								<?php if ($phone) { ?>
								<div class="phone">
									TEL: <a href="tel:<?php echo format_phone_number($phone); ?>"><?php echo $phone ?></a>
								</div>	
								<?php } ?>
							</div>

							<?php if ($weather) { ?>
							<div class="box-weather">
								<div class="weather-title">Today's Weather Here</div>
								<?php 
								$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $weather);
								preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $html, $result);
								$embedLink = ( isset($result['href'][0]) && $result['href'][0] ) ? $result['href'][0] : '';
								if (strpos($embedLink, 'unit=') !== false) {
								    // will result Celcius
								} else {
									$embedLink .= "?unit=us"; /* will result USA (Fahrenheit) */
								}

								$valCelcius = '';
								$valFahrenheit = '';
								$newLinkCelcius = str_replace("?unit=us","",$embedLink);

								/* Celcius */
								$fcontent = file_get_contents_curl($newLinkCelcius."?unit=us");
								$fdom = new DOMDocument();
								@$fdom->loadHTML($fcontent);
								$fclassName = 'temp';
								$felementsByClass = getElementsByClassName($fdom, $fclassName, 'div');
								$valCelcius = ( isset($felementsByClass[0]->nodeValue) && $felementsByClass[0]->nodeValue ) ? $felementsByClass[0]->nodeValue : '';

								/* Fahrenheit */
								$content = file_get_contents_curl($newLinkCelcius);
								$dom = new DOMDocument();
								@$dom->loadHTML($content);
								$className = 'temp';
								$elementsByClass = getElementsByClassName($dom, $className, 'div');
								$valFahrenheit = ( isset($elementsByClass[0]->nodeValue) && $elementsByClass[0]->nodeValue ) ? $elementsByClass[0]->nodeValue : '';

								/* summary */
								$sumclassName = 'summary';
								$summaryClass = getElementsByClassName($dom, $sumclassName, 'div');
								$valSummary = ( isset($summaryClass[0]->nodeValue) && $summaryClass[0]->nodeValue ) ? $summaryClass[0]->nodeValue : '';


								if($embedLink && filter_var($embedLink, FILTER_VALIDATE_URL) ){ ?>
								<div class="cover"></div>
								<div class="infowrap">
									<div class="weather-info">
										<a class="weatherwidget-io" href="<?php echo $embedLink ?>" data-label_1="" data-units="us" data-mode="Current" data-theme="pure" data-textcolor="#000000">
											<span class="sr-only"><?php echo $location_name; ?></span>
										</a>
									</div>
									<div class="weatherdata">
										<div class="data">
											<div class="fahrenheit"><?php echo $valFahrenheit ?></div>
											<div class="celcius"><?php echo $valCelcius ?></div>
										</div>
									</div>
								</div>
								<?php if ($valSummary) { ?>
									<div class="summary"><?php echo $valSummary ?></div>
									<?php } ?>
								<?php } ?>
							</div>	
							<?php } ?>
							
							<?php if ($vidmp4 || $vidogg) { ?>
							<div class="box-video clear locVideo">
								<div class="inner clear">
									<video id="locvideo<?php echo $i;?>" class="locationvideo" width="400" height="300" >
										<?php if ($vidmp4) { ?><source src="<?php echo $vidmp4; ?>" type="video/mp4"><?php } ?>
										<?php if ($vidogg) { ?><source src="<?php echo $vidogg; ?>" type="video/ogg"><?php } ?>
										<p>Your browser doesn't support HTML5 video. 
											<?php if ($vidmp4) { ?><a href="<?php echo $vidmp4; ?>">Download</a> the video instead. <?php } ?>
										</p>
									</video>
									<div class="loc-video-controls">
									    <button type="button" class="playpauseBtn play">Play</button>
									</div>
									<div class="thumb"<?php echo $thumbnail ?>></div>
								</div>
							</div>
							<?php } ?>
						</div>
						<?php if ($description) { ?>
						<div class="description"><?php echo $description ?></div>	
						<?php } ?>
					</div>
				<?php $i++; endwhile; wp_reset_postdata(); ?>


				</div>
			</div>
		<?php } ?>
		</div><!-- .wrapper-->


		<?php get_template_part('template-parts/content','testimonials'); ?>

		<?php $articles = get_field('articles'); ?>
		<?php if ($articles) { ?>
			<div class="careers-bottom-articles">
				<div class="wrapper">
					<div class="flexbox">
						<?php $i=1; foreach ($articles as $a) { 
						$img = $a['image'];
						$title = $a['title'];
						$description = $a['description'];
						$square = get_bloginfo("template_url").'/images/px2.png';
						?>
						<article class="info<?php echo($i==1) ? ' first':'';?>">
							<div class="inside">
								<?php if ($img) { ?>
								<div class="cimage">
									<span class="img" style="background-image:url('<?php echo $img['url']; ?>')"><img src="<?php echo $square; ?>" alt=""></span>
								</div>	
								<?php } ?>
								<div class="text">
									<?php if ($title) { ?>
									<h3 class="ctitle"><?php echo $title ?></h3>	
									<?php } ?>
									<?php if ($description) { ?>
									<div class="cdesc"><?php echo $description ?></div>	
									<?php } ?>
								</div>
							</div>
						</article>
						<?php $i++; } ?>
					</div>
				</div>
			</div>	
		<?php } ?>


		<?php 
		$positions = get_field('positions'); 
		$optitle = get_field('optitle'); 
		$optext = get_field('optext'); 
		$positionList = array();
		if($positions) {
			foreach($positions as $p) {
				$ploc = $p['location'];
				$pjobs = $p['jobs'];
				if($ploc && $pjobs) {
					$positionList[] = $p;
				}
			}
		}
		$count_class = ($positionList) ? 'column' . count($positionList) : 'fullwidth';
		?>
		<?php if ($positionList) { ?>
			<div class="open-positions">
				<div class="wrapper">
					<?php if ($optitle) { ?>
						<div class="section-title"><?php echo $optitle; ?></div>
					<?php } ?>
					<?php if ($optext) { ?>
						<div class="section-text"><?php echo $optext; ?></div>
					<?php } ?>

					<div class="jobs clear <?php echo $count_class ?>">
					<?php foreach ($positionList as $pos) { 
						$loc = $pos['location'];
						$locationName = ($loc) ? $loc->post_title:'';
						$jobs = $pos['jobs'];
						if($loc && $jobs) { ?>
						<div class="joblist">
							<p class="loc"><?php echo $locationName; ?></p>
							<?php if ($jobs) { ?>
							<ul class="listings">
								<?php foreach ($jobs as $j) { 
									$jobtitle = $j['jobposition'];
									$joblink = ($j['jobinfo']) ? $j['jobinfo'] : '#'; 
									$target = ($joblink=='#') ? '':' target="_blank"'; ?>
									<?php if ($jobtitle) { ?>
									<li><a href="<?php echo $joblink ?>"<?php echo $target ?>><?php echo $jobtitle ?> <span class="arrow">&gt;</span></a></li>	
									<?php } ?>
								<?php } ?>
							</ul>	
							<?php } ?>
						</div>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>


	</main><!-- #main -->


</div><!-- #primary -->


<?php /* Script for weather embed from https://weatherwidget.io/ */ ?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');</script>

<?php
get_footer();
