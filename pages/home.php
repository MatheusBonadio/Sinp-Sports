	<link rel="stylesheet" href="public/css/home.css" type="text/css">
	<?php
		require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/dao/DestaqueDAO.php";
		$dao = new DestaqueDAO();
		$exec = $dao->listar();
	?>
	<div class='slideshow'>
		<div class='highlight_container'>
	<?php
				foreach ($exec as $listar) {
	?>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(public/img/destaque/<?php echo $listar['imagem'] ?>);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						<?php echo $listar['dia']." - ".$listar['tipo']; ?>
					</div>
					<div class='highlight_sport'><?php echo $listar['esporte']; ?></div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						<?php echo $listar['texto']; ?>
					</div>
				</div>
			</div>
	<?php
			}
	?>
		</div>
		<div class='container_dots flex'>
			<div class='dots_line'></div>
			<div class='group_dots'></div>
			<div class='dots_line'></div>
		</div>
		<div class='arrow flex material-icons' onclick='plusSlides(1)'>keyboard_arrow_right</div>
		<div class='arrow flex material-icons' onclick='plusSlides(-1)'>keyboard_arrow_left</div>
	</div>
	<div class='next_games'>
		<div class='match flex'>
			<div class='sport'>cabo de guerra</div>
			<div class='team flex'>
				<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/cloud9-gnd9b0gn.png' width='16%'/>
				<label>1º INF</label>
				<label>V</label>
			</div>
			<div class='team flex'>
				<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/team-solomid-cg2byxoe.png' width='16%'/>
				<label>1º ADM</label>
				<label>D</label>
			</div>
		</div>
		<div class='match flex'>
			<div class='sport'>vôlei masculino</div>
			<div class='team flex'>
				<img src='https://www.festisite.com/static/partylogo/img/logos/fc-barcelona.png' width='16%'/>
				<label>3º INF</label>
				<label>D</label>
			</div>
			<div class='team flex'>
				<img src='https://orig00.deviantart.net/996d/f/2015/307/a/d/bayern_munich_lockglyph__request__by_astoldbyalp-d9fd7qm.png' width='16%'/>
				<label>2º ADM</label>
				<label>V</label>
			</div>
		</div>
	</div>
	<script>
		$('#loader').hide();
		var slides = document.getElementsByClassName("highlight_img");
		for(i = 0; i < slides.length; i++){
			var HTMLString = "<div class='dots' onclick='currentSlide("+(i+1)+")'></div>";
			var ref = document.getElementsByClassName("group_dots")[0];
			var div = document.createElement('div');
			div.innerHTML = HTMLString;  
			ref.appendChild(div);
		}
	</script>
	<script src="public/js/slideshow.js"></script>
	<script>slider($(".header a:eq(1)"))</script>