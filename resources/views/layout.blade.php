
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
	<link rel="shortcut icon" href="{{{ asset('/images/corazon-logo-blue.png') }}}">
    <link href="/css/app.css" rel="stylesheet">


	<title>HealthOnline</title>

	<style>
		.navbar {
			margin-bottom:40px;
		}
	</style>
</head>
<body>
		<?php

			function activeMenu($url) {
				return request()->is($url) ? 'active' : '';
			}
		 ?>

		<!--<h1>{{request()->url()}}</h1>-->
		<!--<h1>{{ request()->is('/') ? 'Estas en el home' : 'No estás en el home'}}</h1>-->


<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container-fluid">
        <div>
        	<img class="logo-cabecera" src="/images/logo-corazon.png" alt="logo-cabecera" style="width: 50px; height:47px;">
			<a class="navbar-brand" href="<?php echo route('home')?>" style="font-size: 15px;">HealthOnline</a>
        </div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ activeMenu('/') }}">
		      <a class="nav-link" href="<?php echo route('home')?>">Inicio</a>
		    </li>
		   
		    <li class="nav-item {{ activeMenu('mensajes/create') }}">
		      <a class="nav-link" href="<?php echo route('mensajes.create')?>">Contactos</a>
		    </li>
		    <li class="nav-item {{ activeMenu('preguntas*') }}">
		      <a class="nav-link" href="<?php echo route('preguntas.index')?>">Preguntas</a>
			</li>
			<li class="nav-item {{ activeMenu('usuarios-profesionales') }}">
		      <a class="nav-link" href="/usuarios-profesionales">Profesionales</a>
			</li>
            @if (auth()->check())
			<li class="nav-item {{ activeMenu('correos*') }}">
		      <a class="nav-link" href="<?php echo route('correos.index')?>"><i class="fa fa-envelope"></i></a>
			</li>

            @if (auth()->user()->hasRoles(['admin','mod']))

			  <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" style="cursor:pointer;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        	Mod
		        </a>
		        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="<?php echo route('mensajes.index')?>">Mensajes</a>
		          <a class="dropdown-item" href="<?php echo route('reportes.index')?>">Reportes</a>
		          <a class="dropdown-item" href="<?php echo route('usuarios.index')?>">Usuarios</a>
		        </div>
	     	 </li>

			  @endif
			  @endif
          </ul>
          <ul class="navbar-nav mr-3">
	    	@if (auth()->check())
	    	<li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle text-warning" style="font-weight: bold; position:relative; padding-left:50px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        	<img src="/uploads/{{auth()->user()->avatar}}" style="width:32px; height:32px; float:left; position:absolute; top:4px; left:10px; border-radius:50%;" alt="">
		         {{auth()->user()->name}}
		        </a>
		        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="/logout">Cerrar sesión</a>
		          <a class="dropdown-item" href="/usuarios/{{auth()->user()->id}}/edit">Editar cuenta</a>
		        </div>
	     	 </li>
		    @else
		    <li class="nav-item {{ activeMenu('login*') }}">
		    	<a class="nav-link" href="/login">Login</a>
		    </li>
		    <li class="nav-item {{ activeMenu('usuarios/create') }}">
		    	<a class="nav-link" href="<?php echo route('usuarios.create') ?>">Registrarse</a>
		    </li>
		    @endif
		   </ul>
        </div>
      </div>
    </nav>


<!--dsadsadddddddddddddddddddddddddddddddddddddddddddddddddddddddddasds-->



	@yield('contenido')


<footer style="margin-top:60px !important">
        	<div class="footer-top">
		        <div class="container">
		        	<div class="row">
		        		<div class="col-md-4 col-lg-3 footer-about">
		        			<img class="logo-footer" src="/images/logo-corazon.png" alt="logo-footer" data-at2x="assets/img/logo.png">
		        			<p>
		        				Página creada por Francisco Manuel Roldán Pérez, web developer. Estudios realizados en IES Francisco Ayala.
		        			</p>
		        			<p><a href="https://github.com/FranRP">Mi Github</a></p>
	                    </div>
		        		<div class="col-md-4 col-lg-4 offset-lg-1 footer-contact">
		        			<h3>Contact</h3>
		                	<p><i class="fa fa-map"></i>Granada, España</p>
		                	<p><i class="fa fa-phone"></i>Contacto: 616 53 11 42</p>
		                	<p><i class="fa fa-envelope"></i> Email: <a href="mailto:hello@domain.com">kirtashblog@gmail.com</a></p>
	                    </div>
	                    <div class="col-md-10 col-lg-4 footer-links">
	                    	<div class="row">
	                    		<div class="col">
	                    			<h3>Links</h3>
	                    		</div>
	                    	</div>
	                    	<div class="row">
	                    		<div class="col-md-12">
	                    			<p class="footer-scroll-top">Volver arriba</p>
	                    		</div>
	                    	</div>
	                    </div>
		            </div>
		        </div>
	        </div>
	        <div class="footer-bottom">
	        	<div class="container">
	        		<div class="row">
	           			<div class="col-md-6 footer-copyright">
	                    	&copy; Derechos reservados por <span class="text-white"> Francisco Manuel Roldán Pérez</span>
	                    </div>
	           			<div class="col-md-6 footer-social">
	                    	<a href="https://www.facebook.com/fran.roldan.16547"><i class="fa fa-facebook"></i></a> 
							<a href="https://twitter.com/Skaydex"><i class="fa fa-twitter"></i></a> 
							<a href="https://github.com/FranRP"><i class="fa fa-github"></i></a> 
	                    </div>
	           		</div>
	        	</div>
	        </div>
</footer>
	
<script src="/js/app.js"></script>
<script src="/js/crud.js"></script>
<script src="/vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="/js/all.js"></script>
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

@yield('scriptQuestion')
</body>
</html>