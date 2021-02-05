<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon ">
      <i class="fas fa-building"></i>
    </div>
    <div class="sidebar-brand-text mx-3">My Library </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Charts -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo site_url('dashboard/read');?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('mahasiswa/read');?>">
      <i class="fas fa-fw fa-users"></i>
      <span>Anggota</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('petugas/read');?>">
      <i class="fas fa-fw fa-users"></i>
      <span>Petugas</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('buku/read');?>">
      <i class="fas fa-fw fa-book"></i>
      <span>Buku</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('peminjaman/read');?>">
      <i class="fas fa-fw fa-folder"></i>
      <span>Peminjaman</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('pengembalian/read');?>">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pengembalian</span></a>
  </li>

</ul>