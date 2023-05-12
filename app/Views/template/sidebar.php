<?php $session = session(); 
$uri = new \CodeIgniter\HTTP\URI(current_url()); ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/dashboard') ?>" class="brand-link">
      <img src="<?= base_url('/asset/img/agungyama.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI PIUTANG</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">DASHBOARD</li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'dashboard') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="<?= base_url('/dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'user' || $uri->getSegment(2) == 'customer' || $uri->getSegment(2) == 'bank' || $uri->getSegment(2) == 'rekpenerima') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
                if ($session->has('username') && $session->get('role') == 1) : ?>
                  <li class="nav-item">
                    <a href="<?= base_url('/user') ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User</p>
                    </a>
                  </li>
                <?php endif;
              ?>
              <li class="nav-item">
                <a href="<?= base_url('/customer') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/bank') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/rekpenerima') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekening Penerima</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">INVOICE</li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'invoice') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="<?= base_url('/invoice') ?>" class="nav-link">
              <i class="fas fa-file-invoice"></i>
              <p>
                Invoice
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-header">PIUTANG</li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'piutang') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="<?= base_url('/piutang') ?>" class="nav-link">
              <i class="fas fa-hand-holding-usd"></i>
              <p>
                Piutang
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'payment') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="<?= base_url('/payment') ?>" class="nav-link">
              <i class="fas fa-money-check-alt"></i>
              <p>
                Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-header">RETUR</li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'retur') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="<?= base_url('/retur') ?>" class="nav-link">
              <i class="fas fa-undo"></i>
              <p>
                Retur
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item <?php if ($uri->getSegment(2) == 'laporan') { echo 'menu-open'; } else { echo ''; } ?>">
            <a href="<?= base_url('/laporan') ?>" class="nav-link">
              <i class="fas fa-file"></i>
              <p>
                Laporan
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
