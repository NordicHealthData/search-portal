<header class="contain-to-grid" id="header" role="banner">
    <nav class="navigation top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name"><h1 id="logo">{!! link_to("/", "Nordic Health Data", array("title" => "Nordic Health Data")) !!}</h1></li>
            <li class="toggle-topbar menu-icon"><a href="#" title="Menu"><span>Menu</span></a></li>
        </ul>
        <!-- /title-area -->

        <section class="top-bar-section">
            <ul class="right">
                <li>{!! link_to("/", "Home", array("title" => "Home")) !!}</li>
                <li>{!! link_to_route("pages.show", "About", array("path" => "about"), array("title" => "About")) !!}</li>
                <li><a href="/search" title="Search Health Data">Search Health Data</a></li>
            </ul>
            <!-- /right -->
        </section>
        <!-- /top-bar-section -->
    </nav>
    <!-- /navigation.top-bar -->
</header>
<!-- /header.contain-to-grid -->
