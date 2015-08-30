<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>My Home ON</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="{{asset('js/ie/html5shiv.js')}})"></script><![endif]-->
		<link rel="stylesheet" href="{{asset('css/main.css')}}" />
		<!--[if lte IE 8]><link rel="stylesheet" href="{{asset('css/ie8.css')}}" /><![endif]-->
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				

			<!-- Banner -->
				<section id="banner">
                    <!--
					<h2>MyHouse ON</h2>
					<p>Monitoramento e gerenciamento do consumo de energia.</p>
					<ul class="actions">
						<li><a href="#" class="button special">Sign Up</a></li>
						<li><a href="#" class="button">Veja mais</a></li>
					</ul>
                    -->
                    <img src="{{asset('images/logo-novo.jpg')}}">
				</section>

			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2>A sofisticação que a sua casa precisava!
							</h2>
							<p>Sua casa sempre ao alcance das suas mãos<br />
							</p>
						</header>
						<span class="image featured"><img src="images/screenshot.png" alt="" /></span>
					</section>

					<section class="box special features">
						<div class="features-row">
							<section>
								<span class="icon major fa-bolt accent2"></span>
								<h3>Economia</h3>
								<p>Oferece informações para reduzir o consumo de energia.</p>
							</section>
							<section>
								<span class="icon major fa-area-chart accent3"></span>
								<h3>Monitoramento</h3>
								<p>Identifica os horários de pico e o valor da conta.</p>
							</section>
						</div>
						<div class="features-row">
							<section>
								<span class="icon major fa-cloud accent4"></span>
								<h3>Dados salvos na nuvem</h3>
								<p>Acessa o consumo de energia da sua casa de qualquer lugar.</p>
							</section>
							<section>
								<span class="icon major fa-lock accent5"></span>
								<h3>Segurança</h3>
								<p>Desliga dispositivos que oferecem risco à residência.</p>
							</section>
						</div>
					</section>

				</section>

			<!-- CTA -->
				<section id="cta">

					<h2>Interessou? Registre para a fila de espera!</h2>
					<p>Você será informado quando o produto entrar no mercado.</p>

					<form action="{{route('site.storeEmail')}}" method="POST">
                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
						<div class="row uniform 50%">
							<div class="8u 12u(mobilep)">
								<input type="email" name="email" id="email" placeholder="Endereço de email" />
                                @if($errors->has('email'))<p>{{$errors->first('email')}}</p> @endif
                                @if(Session::has('success'))<p>{{Session::get('success')}}</p>@endif
                                @if(Session::has('error'))<p>{{Session::get('error')}}</p>@endif
							</div>
							<div class="4u 12u(mobilep)">
								<input type="submit" value="Registrar" class="fit" />
							</div>
						</div>
					</form>

				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; MyHome ON. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="{{asset('js/jquery.min.js')}}"></script>
			<script src="{{asset('js/jquery.dropotron.min.js')}}"></script>
			<script src="{{asset('js/jquery.scrollgress.min.js')}}"></script>
			<script src="{{asset('js/skel.min.js')}}"></script>
			<script src="{{asset('js/util.js')}}"></script>
			<!--[if lte IE 8]><script src="{{asset('js/ie/respond.min.js')}}"></script><![endif]-->
			<script src="{{asset('js/main.js')}}"></script>

	</body>
</html>