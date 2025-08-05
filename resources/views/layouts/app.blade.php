<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">


		<!-- FAVICON -->
		<link rel="icon" type="image/png" href="{{ asset('assets/img-peserta/event_default.png')}}">

		<!-- TITLE -->
		<title>@yield('title')</title>

		<!-- BOOTSTRAP CSS -->
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


		<!-- STYLE CSS -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!-- SIDE-MENU CSS -->
		<link href="{{ asset('assets/css/sidemenu.css')}}" rel="stylesheet" id="sidemenu-theme">

		<!--C3 CHARTS CSS -->
		<link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet"/>

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.css') }}" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet"/>

		<!-- SIDEBAR CSS -->
		<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

		<!-- SELECT2 CSS -->
		<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

		<!-- INTERNAL Data table css -->
		<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/datatable/responsive.bootstrap5.css') }}" rel="stylesheet" />

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />

	</head>

	<body class="app sidebar-mini">

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{ asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!--APP-SIDEBAR-->
				<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="index.html">
							<img src="{{ asset('assets/images/logo-evenln.png') }}" class="header-brand-img light-logo1" alt="logo">
						</a><!-- LOGO -->
					</div>
					@auth('admin')
						<ul class="side-menu">
							<li><h3>Main</h3></li>
							<li class="slide">
								<a class="side-menu__item"  data-bs-toggle="slide" href="{{ route('admin.dashboard') }}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
							</li>
							<li><h3>component</h3></li>
							<li>
								<a class="side-menu__item" href="{{ route('divisis.index') }}"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Divisi</span></a>
							</li>
							<li>
								<a class="side-menu__item" href="{{ route('proposals.index') }}"><i class="side-menu__icon fe fe-file"></i><span class="side-menu__label">Proposal</span></a>
							</li>
							<li>
								<a class="side-menu__item" href="{{ route('peserta.index') }}"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Peserta</span></a>
							</li>
							<li>
								<a class="side-menu__item" href="{{ route('panitia.index') }}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Panitia</span></a>
							</li>
							<li>
								<a class="side-menu__item" href="{{ route('admins.index') }}"><i class="side-menu__icon fe fe-user-check"></i><span class="side-menu__label">Admin</span></a>
							</li>
						</ul>
					@endauth

					@auth('panitia')
						<ul class="side-menu">
							<li><h3>Main</h3></li>
							<li class="slide">
								<a class="side-menu__item"  data-bs-toggle="slide" href="{{ route('panitia.dashboard') }}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
							</li>
							<li><h3>component</h3></li>
							<li>
								<a class="side-menu__item" href="{{ route('proposal.panitia.show') }}"><i class="side-menu__icon fe fe-file"></i><span class="side-menu__label">Proposal</span></a>
							</li>
							<li>
								<a class="side-menu__item" href="{{ route('panitia.profile', auth('panitia')->user()->id_panitia) }}"><i class="side-menu__icon fa fa-address-card-o"></i><span class="side-menu__label">Profile</span></a>
							</li>
						</ul>
					@endauth
				</aside>
				<!--/APP-SIDEBAR-->

				<!-- Mobile Header -->
				<div class="app-header header">
					<div class="container-fluid">
						<div class="d-flex">
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
							
							<div class="d-flex order-lg-2 ms-auto header-right-icons">
								<div class="dropdown d-none d-md-flex header-settings">
									<a href="#" class="nav-link icon " data-bs-toggle="sidebar-right" data-target=".sidebar-right">
										<i class="fe fe-menu"></i>
									</a>
								</div>
							</div>
                            
						</div>
					</div>
				</div>
				<!-- /Mobile Header -->

                <!--app-content open-->
				<div class="app-content">
					<div class="side-app">

                         @yield('content')

					</div>
				</div>
				<!-- CONTAINER END -->
            </div>

			<!-- Sidebar-right -->
			<div class="sidebar sidebar-right sidebar-animate">
				<div class="panel panel-primary card mb-0 shadow-none border-0">
					<div class="tab-menu-heading border-0 d-flex p-3">
						<div class="card-title mb-0">Profile</div>
						<div class="card-options ms-auto">
							<a href="#" class="sidebar-icon text-end float-end me-1" data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x text-white"></i></a>
						</div>
					</div>
					<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
						<div class="tabs-menu border-bottom">
							<!-- Tabs -->
							<ul class="nav panel-tabs">
								<li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i class="fe fe-user me-1"></i> Profile</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="side1">
								<div class="card-body text-center">

								@auth('admin')
									<div class="dropdown user-pro-body">
										<div class="">
											<img alt="user-img" class="avatar avatar-xl brround mx-auto text-center" src="{{ asset('assets/images/admin.jpg') }}"><span class="avatar-status profile-status bg-green"></span>
										</div>
										<div class="user-info mg-t-20">
											<h6 class="fw-semibold  mt-2 mb-0">{{ auth('admin')->user()->nama_admin }}</h6>
											<span class="mb-0 text-muted fs-12">{{ auth('admin')->user()->email }}</span>
										</div>
									</div>
								@endauth
								
								@auth('panitia')
									<div class="dropdown user-pro-body">
										<div class="">
											<img alt="user-img" class="avatar avatar-xl brround mx-auto text-center" src="{{ asset('assets/images/admin.jpg') }}"><span class="avatar-status profile-status bg-green"></span>
										</div>
										<div class="user-info mg-t-20">
											<h6 class="fw-semibold  mt-2 mb-0">{{ auth('panitia')->user()->nama_panitia }}</h6>
											<span class="mb-0 text-muted fs-12">{{ auth('panitia')->user()->email }}</span>
										</div>
									</div>
								@endauth
								</div>
                                

								@auth('admin')
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button class="button-logout">
                                        <div class="dropdown-item d-flex border-bottom">
                                            <div class="d-flex"><i class="fe fe-power me-3 tx-20 text-muted"></i>
                                                <div class="pt-1">
                                                    <h6 class="mb-0">Sign Out</h6>
                                                    <p class="tx-12 mb-0 text-muted">Account Signout</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </form>
								@endauth

								@auth('panitia')
                                <form method="POST" action="{{ route('panitia.logout') }}">
                                    @csrf
                                    <button class="button-logout">
                                        <div class="dropdown-item d-flex border-bottom">
                                            <div class="d-flex"><i class="fe fe-power me-3 tx-20 text-muted"></i>
                                                <div class="pt-1">
                                                    <h6 class="mb-0">Sign Out</h6>
                                                    <p class="tx-12 mb-0 text-muted">Account Signout</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </form>
								@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/Sidebar-right-->
		</div>
		@include('sweetalert::alert')

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- JQUERY JS -->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- SPARKLINE JS-->
		<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>

		<!-- CHART-CIRCLE JS-->
		<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

		<!-- CHARTJS CHART JS-->
		<script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>

		<!-- PIETY CHART JS-->
		<script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/peitychart/peitychart.init.js') }}"></script>

		<!-- INTERNAL SELECT2 JS -->
		<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

		<!-- INTERNAL Data tables js-->
		<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>

		<!-- ECHART JS-->
		<script src="{{ asset('assets/plugins/echarts/echarts.js') }}"></script>

		<!-- SIDE-MENU JS-->
		<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

		<!-- SIDEBAR JS -->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>

		<!-- APEXCHART JS -->
		<script src="{{ asset('assets/js/apexcharts.js') }}"></script>

		<!-- INDEX JS -->
		<script src="{{ asset('assets/js/index1.js') }}"></script>

		<!-- CUSTOM JS -->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<!-- sweet alert -->
		@stack('scripts')
	</body>
</html>