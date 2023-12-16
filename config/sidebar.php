 <div id="layoutSidenav_nav">
     <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
         <div class="sb-sidenav-menu">
             <div class="nav">
                 <div class="sb-sidenav-menu-heading">Super Admin</div>
                 <a class="nav-link" href="./index.php">
                     <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Dashboard
                 </a>
                 <a class="nav-link" href="./admin.php">
                     <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Admins
                 </a>
                 <div class="sb-sidenav-menu-heading">Panels</div>
                 <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                     <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                     All
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                 </a>
                 <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                         <a class="nav-link" href="customers.php">Customers</a>
                         <a class="nav-link" href="orders.php">Orders</a>
                         <!-- <a class="nav-link" href="payments.php">Payments</a> -->
                         <a class="nav-link" href="categories.php">Categories</a>
                         <a class="nav-link" href="foods.php">Foods</a>


                     </nav>
                 </div>

                 <div class="sb-sidenav-menu-heading">Reports</div>
                 <a class="nav-link" href="report.php">
                     <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                     Report
                 </a>
               
                 <div class="sb-sidenav-menu-heading">Others</div>
                 <a class="nav-link" href="../views/user_profile.php">
                     <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                     Profile
                 </a>
                 <a class="nav-link logout" href="../">
                     <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                     Logout
                 </a>
             </div>
         </div>
         <div class="sb-sidenav-footer">
             <!-- <div class="small">Logged in as:</div> -->
             Admins Only
         </div>
     </nav>
 </div>