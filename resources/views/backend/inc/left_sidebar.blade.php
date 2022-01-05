@php
    use App\Models\User;
    $totalPermissnion = User::checkPermission();
@endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/images/favicon.png') }}" alt="Datagate" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Datagate</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item {{ activeRoutesLi(['role.index', 'role.create', 'role.edit', 'permission.index', 'permission.create', 'permission.edit'])}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p> Our Staffs<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" {{ activeRoutesUl(['role.index', 'role.create', 'role.edit', 'permission.index', 'permission.create', 'permission.edit', 'staff.index', 'staff.create', 'staff.edit']) }}>
              @if(Auth::user()->user_type == 'admin' || array_intersect([1,2,3,4,5], $totalPermissnion))
              <li class="nav-item" >
                <a href="{{route('staff.index')}}" class="nav-link {{ activeRoutesUlLi(['staff.index', 'staff.create', 'staff.edit'])}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Staff</p>
                </a>
              </li>
               @endif
               @if(Auth::user()->user_type == 'admin' || array_intersect([6,7,8,9,10], $totalPermissnion))
              <li class="nav-item click_li">
                <a href="{{route('role.index')}}" class="nav-link {{ activeRoutesUlLi(['role.index', 'role.create', 'role.edit'])}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Roles</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->user_type == 'admin' || array_intersect([29, 30, 31, 32, 33], $totalPermissnion))
              <li class="nav-item click_li">
                <a href="{{route('permission.index')}}" class="nav-link {{ activeRoutesUlLi(['permission.index', 'permission.create', 'permission.edit'])}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Permission</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item {{ activeRoutesLi(['office-expenses.index']) }}">
            <a href="{{ route('office-expenses.index') }}" class="nav-link">
              <i class="nav-icon  fab fa-accusoft"></i>
              <p>
                Office Expenses
              </p>
            </a>
          </li>
          <li class="nav-item {{ activeRoutesLi([
            'project.index', 'project.create', 'project.edit','project.get-payment', 'project.show',
            'get-payment.index', 'get-payment.create', 'get-payment.edit',
            'make-payment.index', 'make-payment.create', 'make-payment.edit',
            'make-order.index', 'make-order.create', 'make-order.edit', 'order-details', 'order-check','make-order.show',
            'supplier.create','supplier.edit','supplier.index','supplier.show',
            'returned.create','returned.edit','return-store','return-check',
            'other-cost.create','other-cost.edit','other-cost.index',
            'project.cost.index', 'project.cost.create', 'project.cost.edit', 'project.cost.show'
            ])}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Projects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('project.create')}}" class="nav-link {{ activeRoutesUlLi(['project.create'])}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Project</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('project.index')}}" class="nav-link {{ activeRoutesUlLi(['project.index', 'project.edit', 'project.show', 'project.cost.show'])}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project List</p>
                </a>
              </li>
              <li class="nav-item {{ activeRoutesUl(['get-payment.index','workers-list.create','supplier.create','make-payment.index',])}}">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>
                    Payment
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview pl-3">
                  <li class="nav-item">
                    <a href="{{route('get-payment.index')}}" class="nav-link {{ activeRoutesUlLi(['get-payment.index']) }}">
                      <i class="fas fa-dot-circle nav-icon"></i>
                      <p>Get Payment</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('make-payment.index')}}" class="nav-link {{ activeRoutesUlLi(['make-payment.index']) }}">
                      <i class="fas fa-dot-circle nav-icon"></i>
                      <p>Make Payment</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item {{ activeRoutesUl(['make-order.index', 'make-order.create', 'make-order.edit', 'order-details', 'order-check','return-store','return-check','make-order.show',])}}">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>
                    Make Order
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview pl-3">
                  <li class="nav-item">
                    <a href="{{route('make-order.create')}}" class="nav-link {{ activeRoutesUlLi(['make-order.create']) }}">
                      <i class="fas fa-dot-circle nav-icon"></i>
                      <p>Order Create</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('make-order.index')}}" class="nav-link {{ activeRoutesUlLi(['make-order.index']) }}">
                      <i class="fas fa-dot-circle nav-icon"></i>
                      <p>Order List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('other-cost.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Other Cost</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('supplier.index')}}" class="nav-link {{ activeRoutesUlLi(['supplier.edit','supplier.index','supplier.show',])}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ activeRoutesLi(['category.index', 'category.create', 'category.edit', 'brand.index', 'brand.edit','product.index', 'product.edit', 'product.create' ]) }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link {{ activeRoutesUlLi(['product.index', 'product.edit', 'product.create']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link {{ activeRoutesUlLi(['category.index', 'category.edit','category.create',]) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categoey</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('brand.index') }}" class="nav-link {{ activeRoutesUlLi(['brand.index', 'brand.edit']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attribute</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-gavel"></i>
              <p>
                Teders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>New Project</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Office expenses</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item  {{ activeRoutesLi(['employees.index', 'employees.create', 'employees.edit', 'employees.show']) }}">
            <a href="#" class="nav-link">
              <i class="fas fa-user-friends"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employees.index') }}" class="nav-link {{ activeRoutesUlLi(['employees.index', 'employees.edit', 'employees.show', 'employee-salary.index']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee-salary.index') }}" class="nav-link {{ activeRoutesUlLi(['employee-salary.index']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pay Salary</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-cogs"></i>
              <p>
                Setup & Configurations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('smtp_settings')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMTP Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('social_login')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Social Login</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e-commerce.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-commerce</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/faq.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contact-us.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact us</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v1
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v1</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v2
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v2</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/search/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Search</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enhanced</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item  pl-2">
                <a href="#" class="nav-link">
                  <i class="fas fa-dot-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item  pl-2">
                <a href="#" class="nav-link">
                  <i class="fas fa-dot-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item pl-2">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item pl-2">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>