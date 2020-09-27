      <?php
        if($_SESSION['status_pengguna'] == 'superadmin' || $_SESSION['status_pengguna'] == 'admin'){
      ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
          if($_SESSION['status_pengguna'] == 'superadmin'){
          ?>
          <li class="nav-item">
            <a href="form-perizinan.php?data=perizinan&action=perizinan&sd=admin" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="daftar-pengguna.php?data=bantuan&sd=admin" class="nav-link">
              <i class="nav-icon far fa-comments"></i>
              <p>
                Bantuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="daftar-pengguna.php?data=pengguna&sd=admin" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Admin
              </p>
            </a>
          </li>
          <?php
          }
          ?>
          <li class="nav-item">
            <a href="daftar-pengguna.php?data=pengguna&sd=panitia" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Panitia
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="daftar-acara.php?data=acara" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Acara
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="form-perizinan.php?data=perizinan&action=perizinan&sd=panitia" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          <?php
          if($_SESSION['status_pengguna'] == 'superadmin'){
          ?>
          <li class="nav-item">
            <a href="form-info.php?data=info&action=edit" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Data Info
              </p>
            </a>
          </li>
          <?php
          }
          ?>
        </ul>
      </nav>
      <?php
      }
      ?>