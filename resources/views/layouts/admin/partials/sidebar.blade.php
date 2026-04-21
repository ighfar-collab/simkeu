<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
           <b> Aplikasi SIMKEU</b>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
  @role('super-admin')
                    <ul class="sidebar-menu">
                <li class="menu-header"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
           
            <li class="menu-header" >Master Data</li>
                       <li class="active"><a class="nav-link" href="{{ route('barang.index') }}"><i class="far fa-square"></i>
                    <span>Barang</span></a></li>

                          <li class="active"><a class="nav-link" href="{{ route('pembelian.index') }}"><i class="far fa-square"></i>
                    <span>Pembelian Barang</span></a></li>
                      
                          <li class="active"><a class="nav-link" href="{{ route('customers.index') }}"><i class="far fa-square"></i>
                    <span>Customers</span></a></li>
                              <li class="active"><a class="nav-link" href="{{ route('suppliers.index') }}"><i class="far fa-square"></i>
                    <span>Suppliers</span></a></li>
                   <li class="active"><a class="nav-link" href="{{ route('loans.index') }}"><i class="far fa-square"></i>
                    <span>Utang Piutang</span></a></li>
                     <li class="active"><a class="nav-link" href="{{ route('installments.index') }}"><i class="far fa-square"></i>
                            <span>Angsuran</span></a></li>    
      
                     <li class="active"><a class="nav-link" href="{{ route('cashflow.index') }}"><i class="far fa-square"></i>
                                             <span>CashFlow</span></a></li>
                                             <li class="menu-header">Laporan</li>

<li class="nav-item dropdown">

<a href="#" class="nav-link has-dropdown">
<i class="fas fa-file-alt"></i>
<span>Laporan</span>
</a>


<ul class="dropdown-menu">

<li>
<a class="nav-link" href="{{ route('laporan.penjualan.harian') }}">
Penjualan Harian
</a>
</li>

<li>
<a class="nav-link" href="{{ route('laporan.penjualan.bulanan') }}">
Penjualan Bulanan
</a>
</li>

<li>
<a class="nav-link" href="{{ route('laporan.penjualan.tahunan') }}">
Penjualan Tahunan
</a>
</li>

</ul>

</li>


<li>
<a class="nav-link" href="{{ route('laporan.pembelian') }}">
Laporan Pembelian
</a>
</li>

<li>
<a class="nav-link" href="{{ route('laporan.stok') }}">
Laporan Stok Barang
</a>
</li>

<li>
<a class="nav-link" href="{{ route('laporan.cashflow') }}">
Laporan Cashflow
</a>
</li>



</ul>

</li>
                                                    
                    <li class="menu-header"><a class="nav-link" href="{{ route('user.index') }}">Admin</a></li>

          
            @endrole
            @role('admin')
                    <ul class="sidebar-menu">
                <li class="menu-header"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
           
            <li class="menu-header" >Master Data</li>
                       <li class="active"><a class="nav-link" href="{{ route('cargo.index') }}"><i class="far fa-square"></i>
                    <span>Cargo</span></a></li>
                      
                          <li class="active"><a class="nav-link" href="{{ route('driver.index') }}"><i class="far fa-square"></i>
                    <span>Driver</span></a></li>
                   <li class="active"><a class="nav-link" href="{{ route('vehicle.index') }}"><i class="far fa-square"></i>
                    <span>Vehicle</span></a></li>
                                 <li class="active"><a class="nav-link" href="{{ route('mitra.index') }}"><i class="far fa-square"></i>
                    <span>Mitra</span></a></li>
    
     <li class="menu-header"><a class="nav-link" href="{{ route('user.index') }}">Admin</a></li>
   
          
            @endrole
             @role('mitra')
               <ul class="sidebar-menu">
                <li class="menu-header"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
           
            <li class="menu-header" >Master Data</li>
                       <li class="active"><a class="nav-link" href="{{ route('mitra.cargo.index') }}"><i class="far fa-square"></i>
                    <span>Cargo</span></a></li>
                          <li class="active"><a class="nav-link" href="{{ route('driver.index') }}"><i class="far fa-square"></i>
                    <span>Driver</span></a></li>
            @endrole
             @role('driver')
               <ul class="sidebar-menu">
                <li class="menu-header"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
           
            <li class="menu-header" >Master Data</li>
                       <li class="active"><a class="nav-link" href="{{ route('cargo.index') }}"><i class="far fa-square"></i>
                    <span>Cargo</span></a></li>
            @endrole
                
        </ul>

    </aside>
</div>