<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Yegnan - Manage your listings, bookings, and account" />
    <meta name="author" content="Yegnan Team" />
    <title>Yegnan Dashboard</title>
    <link href="" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow-sm">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.html">
        <img src="" alt="Yegnan" style="height: 40px" />
      </a>
      <!-- Sidebar Toggle-->
      <button
        class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Navbar Search-->
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
          <input
            class="form-control"
            type="text"
            placeholder="Search listings, bookings..."
            aria-label="Search"
            aria-describedby="btnNavbarSearch"
          />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="fas fa-user fa-fw"></i
          ></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#!">Profile</a></li>
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="#!">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Main</div>
              <a class="nav-link" href="index.html">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                Dashboard
              </a>
              <a class="nav-link" href="listings.html">
                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                Manage Listings
              </a>
              <a class="nav-link" href="bookings.html">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                Bookings
              </a>
              <a class="nav-link" href="earnings.html">
                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                Earnings
              </a>
              <div class="sb-sidenav-menu-heading">Account</div>
              <a class="nav-link" href="profile.html">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Profile
              </a>
              <a class="nav-link" href="support.html">
                <div class="sb-nav-link-icon"><i class="fas fa-headset"></i></div>
                Support
              </a>
              <div class="sb-sidenav-menu-heading">Legal</div>
              <a class="nav-link" href="terms.html">
                <div class="sb-nav-link-icon"><i class="fas fa-file-contract"></i></div>
                Terms & Conditions
              </a>
              <a class="nav-link" href="privacy.html">
                <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                Privacy Policy
              </a>
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            John Doe
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Welcome to Yegnan</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
              <li class="breadcrumb-item active">Overview</li>
            </ol>

            <div class="row">
              <!-- Listings Overview -->
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-primary text-white shadow">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h5>Total Listings</h5>
                        <h3>42</h3>
                      </div>
                      <i class="fas fa-building fa-2x"></i>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                    <span>View Details</span>
                    <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                  </a>
                </div>
              </div>

              <!-- Bookings Overview -->
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-success text-white shadow">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h5>Total Bookings</h5>
                        <h3>128</h3>
                      </div>
                      <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                    <span>View Details</span>
                    <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                  </a>
                </div>
              </div>

              <!-- Earnings Overview -->
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-warning text-white shadow">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h5>Total Earnings</h5>
                        <h3>$12,345</h3>
                      </div>
                      <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                    <span>View Details</span>
                    <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                  </a>
                </div>
              </div>
            </div>

            <!-- Listings Table -->
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Active Listings
              </div>
              <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Property Name</th>
                      <th>Location</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Modern Apartment</td>
                      <td>New York, USA</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Cozy Cottage</td>
                      <td>Paris, France</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">© 2024 Yegnan</div>
              <div>
                <a href="#">Privacy Policy</a> &middot;
                <a href="#">Terms & Conditions</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
