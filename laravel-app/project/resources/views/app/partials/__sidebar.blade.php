<?php 
 extract($session);
 
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <div class="d-flex sidebar-profile">
        <div class="sidebar-profile-image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4n4D5jth4fm4GE7ut7lWW-04lnDO2OkD-sg&s" alt="image">
          <span class="sidebar-status-indicator"></span>
        </div>
        <div class="sidebar-profile-name">
          <p class="sidebar-name">
            <?= $user_details->first_name ?> 
            <?= $user_details->middle_name ?> 
            <?= $user_details->last_name ?>
          </p>
          <p class="sidebar-designation">
            Welcome
          </p>
        </div>
      </div>

      <p class="sidebar-menu-title"> <?= $session['user_role_desc'] ?> MENU</p>
    </li>

    <?php 
    if ($session['user_role'] == 1) { //admin
      ?>
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users-account">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Home Owners Account</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage-book">
              <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              <span class="menu-title">Booking List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="complains-request">
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title"> Complaints and Maintenance </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage-monthly-dues">
              <i class="mdi mdi-note-text menu-icon"></i>
              <span class="menu-title">Monthly Dues </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="officer-list">
              <i class="mdi mdi-human-child menu-icon"></i>
              <span class="menu-title">Officer List </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sms-notifications">
              <i class="mdi mdi-bell-ring-outline menu-icon"></i>
              <span class="menu-title">Annoucement </span>
            </a>
          </li>
      <?php
    }else if ($session['user_role'] == 2) { //officer
      ?>
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users-account">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Home Owner Accounts </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage-book">
              <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              <span class="menu-title">Manage Booking </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="complains-request">
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title">Maintenance </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage-monthly-dues">
              <i class="mdi mdi-note-text menu-icon"></i>
              <span class="menu-title">Manage Monthly Dues </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sms-notifications">
              <i class="mdi mdi-bell-ring-outline menu-icon"></i>
              <span class="menu-title">Annoucement </span>
            </a>
          </li>

      <?php
    }else{ //owner
      ?>
                <li class="nav-item">
                  <a class="nav-link" href="dashboard">
                    <i class="typcn typcn-device-desktop menu-icon"></i>
                    <span class="menu-title">Dashboard </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="request-maintinance">
                    <i class="mdi mdi-wrench menu-icon"></i>
                    <span class="menu-title">Request Maintinance</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="file-complaints">
                    <i class="mdi mdi-file-document menu-icon"></i>
                    <span class="menu-title">File Complaints </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="facility-reservation">
                    <i class="mdi mdi-table-edit menu-icon"></i>
                    <span class="menu-title"> Facility Reservation </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="payment-history">
                    <i class="mdi mdi-cash-usd menu-icon"></i>
                    <span class="menu-title">Payment History</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="received-notification">
                    <i class="mdi mdi-bell-ring-outline menu-icon"></i>
                    <span class="menu-title">Annoucement </span>
                  </a>
                </li>
      <?php
    }
    ?>
    <li class="nav-item">
      <a class="nav-link" href="#" id="showTermsAndCon">
        <i class="mdi mdi-file-document menu-icon"></i>
        <span class="menu-title">About </span>
      </a>
    </li>
  



  </ul>
</nav>