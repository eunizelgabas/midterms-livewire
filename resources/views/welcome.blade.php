<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @livewireStyles
</head>
<body>
    <div class="navigation-wrap start-header start-style" style="background-color:#f7ca81">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
						<a class="navbar-brand" href="#">

                            <span class="text">MUSIC</span> bar
                        </a>
						<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/">Home</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/post">Band</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="#">Booking</a>
								</li>
							</ul>
						</div>

					</nav>
				</div>
			</div>
		</div>
	</div>
    <div class="container">
        <div class="row mt-5">
            <div class=w-1/4>
                @if (session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
        </div>

        </div>
        <livewire:band.index>

    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        @livewireScripts
</body>
</html>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');
@import url('https://fonts.googleapis.com/css2?family=Delicious+Handrawn&display=swap');
body{
    font-family: 'Poppins', sans-serif;
	font-size: 16px;
	line-height: 24px;
	font-weight: 400;
	color: #212112;
	background-image: url('/asset/uns.jpg');
	background-position: cover;
    background-size: 100%;
	/* background-color: #fff; */
	/* overflow-x: hidden; */
    /* transition: all 200ms linear; */
}

.start-header {
	opacity: 1;
	padding: 20px 0;
	box-shadow: 0 10px 30px 0 rgba(138, 155, 165, 0.15);
	-webkit-transition : all 0.3s ease-out;
	transition : all 0.3s ease-out;
}

.navbar{
	padding: 0;
}

.nav-link{
	color: #212121;
	font-weight: 500;
    transition: all 200ms linear;
}
.nav-item:hover .nav-link{
	color: #90E0EF;
}
.nav-item.active .nav-link{
	color: #777;
}
.nav-link {
	position: relative;
	padding: 5px;
	display: inline-block;
}
.nav-item:after{
	position: absolute;
	bottom: -5px;
	left: 0;
	width: 100%;
	height: 2px;
	content: '';
	background-color: #90E0EF;
	opacity: 0;
    transition: all 200ms linear;
}
.nav-item:hover:after{
	bottom: 0;
	opacity: 1;
}
.nav-item.active:hover:after{
	opacity: 0;
}
.nav-item{
	position: relative;
    transition: all 200ms linear;
}

 a span{
	font-family: 'Delicious Handrawn', cursive;
	font-weight:600;
	font-size: 40px;
	color:#1a7585;

}

</style>



