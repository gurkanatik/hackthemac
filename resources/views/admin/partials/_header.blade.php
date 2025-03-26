<header>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="left-section">
                <a href="{{ route("admin.dashboard") }}" class="text-decoration-none d-flex align-items-center logo">
                    <img src="{{ asset("assets/_img/imac.svg") }}" width="25" class="me-2" alt="{{ env('APP_NAME') }}" loading="lazy"/>
                    <span>{{ env('APP_NAME') }}</span>
                    <span>/admin</span>
                </a>
            </div>
            <div class="right-section custom-navbar d-flex align-items-center justify-content-end">
                <button type="button" class="nav-opener d-flex d-lg-none justify-content-end align-items-center">≡</button>
                <div id="main-nav">
                    <button type="button" class="nav-closer d-flex d-lg-none justify-content-end align-items-center">×</button>
                    <div>
                        <a href="{{ route("admin.dashboard") }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                        <a href="{{ route("admin.tags.index") }}" class="{{ request()->routeIs('admin.tags.index') ? 'active' : '' }}"><i class="bi bi-tags-fill"></i> Tags</a>
                        <a href="{{ route("admin.pages.index") }}" class="{{ request()->routeIs('admin.pages.index') ? 'active' : '' }}"><i class="bi bi-card-text"></i> Pages</a>
                        <a href="{{ route("admin.blog-posts.index") }}" class="{{ request()->routeIs('admin.blog-posts.index') ? 'active' : '' }}"><i class="bi bi-substack"></i> Blog Posts</a>
                        <a href="{{ route("admin.news.index") }}" class="{{ request()->routeIs('admin.news.index') ? 'active' : '' }}"><i class="bi bi-newspaper"></i> News</a>
                        <a href="{{ route("admin.publishers.index") }}" class="{{ request()->routeIs('admin.publishers.index') ? 'active' : '' }}"><i class="bi bi-buildings"></i> Publishers</a>
                        <a href="{{ route("admin.dashboard") }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
