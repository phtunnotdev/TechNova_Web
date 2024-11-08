<!-- leftbar-tab-menu -->
<div class="startbar d-print-none">
  <!--start brand-->
  <div class="brand">
    <a href="index.html" class="logo">
      <span class="">
        <img
          src="assets/images/light.png"
          alt="logo-large"
          class="logo-lg logo-light"
        />
        <img
          src="assets/images/dark.png"
          alt="logo-large"
          class="logo-lg logo-dark"
        />
      </span>
    </a>
  </div>
  <!--end brand-->
  <!--start startbar-menu-->
  <div class="startbar-menu">
    <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
      <div class="d-flex align-items-start flex-column w-100">
        <!-- Navigation -->
        <ul class="navbar-nav mb-auto w-100">
          <li class="menu-label pt-0 mt-0">
            <!-- <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small> -->
            <span>Main Menu</span>
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Thống Kê" ? "active bg-active" : ""}}" {{-- Nếu classActive là "Thống Kê" thì thêm class bg-active --}}
              href="{{route('admin.index')}}"
            >
              <i class="fas fa-home menu-icon {{$classActive === "Thống Kê" ? "text-primary" : ""}}"></i> {{-- Nếu classActive là "Thông Kể" thì thêm class text-primary --}}
              <span>Thống Kê</span>
            </a>
          </li>
          <!--end nav-item-->
          {{-- <li class="nav-item">
            <a
              class="nav-link"
              href="#sidebarApplications"
              data-bs-toggle="collapse"
              role="button"
              aria-expanded="false"
              aria-controls="sidebarApplications"
            >
              <i class="iconoir-view-grid menu-icon"></i>
              <span>Applications</span>
            </a>
            <div class="collapse" id="sidebarApplications">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#sidebarAnalytics"
                    data-bs-toggle="collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="sidebarAnalytics"
                  >
                    <span>Analytics</span>
                  </a>
                  <div class="collapse" id="sidebarAnalytics">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a href="analytics-customers.html" class="nav-link"
                          >Customers</a
                        >
</li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a href="analytics-reports.html" class="nav-link"
                          >Reports</a
                        >
                      </li>
                      <!--end nav-item-->
                    </ul>
                    <!--end nav-->
                  </div>
                </li>
                <!--end nav-item-->
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#sidebarProjects"
                    data-bs-toggle="collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="sidebarProjects"
                  >
                    <span>Projects</span>
                  </a>
                  <div class="collapse" id="sidebarProjects">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="projects-clients.html"
                          >Clients</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="projects-team.html"
                          >Team</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="projects-project.html"
                          >Project</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="projects-task.html"
                          >Task</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          href="projects-kanban-board.html"
                          >Kanban Board</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="projects-chat.html"
                          >Chat</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="projects-users.html"
                          >Users</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
<a class="nav-link" href="projects-create.html"
                          >Project Create</a
                        >
                      </li>
                      <!--end nav-item-->
                    </ul>
                    <!--end nav-->
                  </div>
                </li>
                <!--end nav-item-->
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#sidebarEcommerce"
                    data-bs-toggle="collapse"
                    role="button"
                    aria-expanded="false"
                    aria-controls="sidebarEcommerce"
                  >
                    <span>Ecommerce</span>
                  </a>
                  <div class="collapse" id="sidebarEcommerce">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="ecommerce-products.html"
                          >Products</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="ecommerce-customers.html"
                          >Customers</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          href="ecommerce-customer-details.html"
                          >Customer Details</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="ecommerce-orders.html"
                          >Orders</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          href="ecommerce-order-details.html"
                          >Order Details</a
                        >
                      </li>
                      <!--end nav-item-->
                      <li class="nav-item">
                        <a class="nav-link" href="ecommerce-refunds.html"
                          >Refunds</a
                        >
                      </li>
                      <!--end nav-item-->
                    </ul>
                    <!--end nav-->
                  </div>
                </li>
                <!--end nav-item-->

                <li class="nav-item">
                  <a class="nav-link" href="apps-chat.html">Chat</a>
                </li>
                <!--end nav-item-->
<li class="nav-item">
                  <a class="nav-link" href="apps-contact-list.html"
                    >Contact List</a
                  >
                </li>
                <!--end nav-item-->
                <li class="nav-item">
                  <a class="nav-link" href="apps-calendar.html">Calendar</a>
                </li>
                <!--end nav-item-->
                <li class="nav-item">
                  <a class="nav-link" href="apps-invoice.html">Invoice</a>
                </li>
                <!--end nav-item-->
              </ul>
              <!--end nav-->
            </div>
            <!--end startbarApplications-->
          </li> --}}
          <!--end nav-item-->
          @if (Auth::user()->role == 1)
          <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Nhân Viên" ? "active bg-active" : ""}}"
              href="{{route('staff.index')}}"
            >
              <i class="fas fa-user-friends menu-icon {{$classActive === "Nhân Viên" ? "text-primary" : ""}}"></i>
              <span>Nhân Viên</span>
            </a>
            <!--end startbarElements-->
          </li>
          @endif
          <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Khách Hàng" ? "active bg-active" : ""}}"
              href="{{route('user.index')}}"
            >
              <i class="fas fa-users menu-icon {{$classActive === "Khách Hàng" ? "text-primary" : ""}}"></i>
              <span>Khách Hàng</span>
            </a>
            <!--end startbarElements-->
          </li>
          <li class="nav-item">
            <a
                class="nav-link {{$classActive === 'Danh mục' ? 'active bg-active' : ''}}"
                href="{{route('categories.index')}}"
            >
                <i class="fas fa-bars menu-icon {{$classActive === 'Danh mục' ? 'text-primary' : ''}}"></i>
                <span>Danh mục</span>
            </a>
          </li>
          <li class="nav-item">
            <a
                class="nav-link {{$classActive === 'Hãng' ? 'active bg-active' : ''}}"
                href="{{route('brand.index')}}"
            >
                <i class="fa-brands fa-bandcamp menu-icon {{$classActive === 'Hãng' ? 'text-primary' : ''}}"></i>
                <span>Hãng</span>
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Sản Phẩm" ? "active bg-active" : ""}}"
              href="{{route('product.index')}}"
            >
              <i class="fas fa-mobile-screen-button menu-icon {{$classActive === "Sản Phẩm" ? "text-primary" : ""}}"></i>
              <span>Sản Phẩm</span>
            </a>
            <!--end startbarElements-->
          </li>
<li class="nav-item">
              <a
                class="nav-link  {{$classActive === "Màu Sắc" ? "active bg-active" : ""}}"
                href="{{ route('color.index') }}"
              >
                <i class="fas fa-wand-magic-sparkles menu-icon  {{$classActive === "Màu Sắc" ? "text-primary" : ""}}"></i>
                <span>Màu Sắc</span>
              </a>
              <!--end startbarElements-->
          </li>
          <li class="nav-item">
              <a
                class="nav-link {{$classActive === "Dung Lượng" ? "active bg-active" : ""}}"
                href="{{ route('ssd.index') }}"
              >
                <i class="fas fa-cloud menu-icon {{$classActive === "Dung Lượng" ? "text-primary" : ""}}"></i>
                <span>Dung Lượng</span>
              </a>
              <!--end startbarElements-->
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Slide Show" ? "active bg-active" : ""}}"
              href="{{ route('slide-show.index') }}"
            >
              <i class="fas fa-sliders menu-icon {{$classActive === "Slide Show" ? "text-primary" : ""}}"></i>
              <span>Slide Show</span>
            </a>
            <!--end startbarElements-->
        </li>
          <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Mã Giảm Giá" ? "active bg-active" : ""}}"
              href="{{ route('voucher.index') }}"
            >
              <i class="fa-solid fa-tag menu-icon {{$classActive === "Mã Giảm Giá" ? "text-primary" : ""}}"></i>
              <span>Mã giảm giá</span>
            </a>
            <!--end startbarElements-->
          </li>
        </li>
        <li class="nav-item">
          <a
            class="nav-link {{$classActive === "Bài viết" ? "active bg-active" : ""}}"
            href="{{ route('post.index') }}"
          >
            <i class="fas fa-rectangle-list menu-icon {{$classActive === "Bài viết" ? "text-primary" : ""}}"></i>
            <span>Bài viết</span>
          </a>
      </li> 
        <li class="nav-item">
            <a
              class="nav-link {{$classActive === "Đơn Hàng" ? "active bg-active" : ""}}"
              href="{{ route('order.index') }}"
            >
              <i class="fas fa-rectangle-list menu-icon {{$classActive === "Đơn Hàng" ? "text-primary" : ""}}"></i>
              <span>Đơn Hàng</span>
            </a>
            <!--end startbarElements-->
        </li>
        </ul>
        <!--end navbar-nav--->
      </div>
    </div>
    <!--end startbar-collapse-->
  </div>
  <!--end startbar-menu-->
</div>
<!--end startbar-->
<div class="startbar-overlay d-print-none"></div>
<!-- end leftbar-tab-menu-->