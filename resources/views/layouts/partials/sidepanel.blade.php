<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="index.html">
                <img class="logo-icon mr-2" src="{{ asset('images/logo/te-logo.png') }}" alt="logo">
                <span class="logo-text">{{ env('APP_NAME') }}</span>
            </a>
        </div><!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ 'active' : checkActive('home') }"
                       href="{{ route('home') }}">
                        <div class="nav-icon pt-1">
                            <span class="fas fa-tachometer-alt fs-5"></span>
                        </div>
                        <span class="nav-link-text">Overview</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ 'active' : checkActive('questions.index') }"
                       href="{{ route('questions.index') }}">
                        <div class="nav-icon pt-1">
                            <span class="fas fa-question-circle fs-5"></span>
                        </div>
                        <span class="nav-link-text">Questions</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ 'active' : checkActive('customers.index') }"
                       href="{{ route('customers.index') }}">
                        <div class="nav-icon pt-1">
                            <i class="fab fa-creative-commons-by fs-5"></i>
                        </div>
                        <span class="nav-link-text">Customers</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                @if (auth()->user()->isA('super-admin'))
                <li class="nav-item has-submenu">
                    <a id="menu-users" class="nav-link submenu-toggle" href="#" data-toggle="collapse" data-target="#submenu-1"
                        aria-expanded="false" aria-controls="submenu-1">
                        <div class="nav-icon pt-1">
                            <span class="fas fa-users fs-5"></span>
                        </div>
                        <span class="nav-link-text">Users</span>
                        <span class="submenu-arrow">
		                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                          fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                                      />
                                    </svg>
	                             </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="submenu-1" class="submenu submenu-1 collapse show" data-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item">
                                <a class="submenu-link" href="{{ route('users.index') }}"
                                   v-bind:class="{ 'active' : checkActive('users.index') }">Accounts</a>
                            </li>
                            <li class="submenu-item">
                                <a class="submenu-link" href="{{ route('roles.index') }}"
                                   v-bind:class="{ 'active' : checkActive('roles.index') }">Roles</a>
                            </li>
                        </ul>
                    </div>
                </li><!--//nav-item-->
                @endif
            </ul><!--//app-menu-->
        </nav><!--//app-nav-->
    </div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->

<script type="text/javascript">
    const app_nav = new Vue({
        el: '#app-nav-main',
        methods: {
            checkActive(route) {
                return '{{ Route::currentRouteName() }}' === route;
            },
        }
    });
</script>
