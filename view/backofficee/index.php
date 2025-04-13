<?php
   require_once '../../Controller/userController.php';
   
   $userController = new UserController();
   
   $users = $userController->listUser();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Purple Admin</title>
      <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
      <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
      <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
      <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <!-- End layout styles -->
      <link rel="shortcut icon" href="assets/images/favicon.png" />
   </head>
   <body>
      <div class="container-scroller">
         <!-- partial:../../partials/_navbar.html -->
         <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
               <a class="navbar-brand brand-logo" href="../../index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
               <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
               <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
               <span class="mdi mdi-menu"></span>
               </button>
               <div class="search-field d-none d-md-block">
                  <form class="d-flex align-items-center h-100" action="#">
                     <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                           <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                     </div>
                  </form>
               </div>
               <ul class="navbar-nav navbar-nav-right">
                  <li class="nav-item nav-profile dropdown">
                     <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                           <img src="assets/images/faces/face1.jpg" alt="image">
                           <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                           <p class="mb-1 text-black">Sarra</p>
                        </div>
                     </a>
                     <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                     </div>
                  </li>
                  <li class="nav-item d-none d-lg-block full-screen-link">
                     <a class="nav-link">
                     <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                     </a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="mdi mdi-email-outline"></i>
                     <span class="count-symbol bg-warning"></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                        <h6 class="p-3 mb-0">Messages</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                           </div>
                           <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                              <p class="text-gray mb-0"> 1 Minutes ago </p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                           </div>
                           <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                              <p class="text-gray mb-0"> 15 Minutes ago </p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                           </div>
                           <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                              <p class="text-gray mb-0"> 18 Minutes ago </p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                     <i class="mdi mdi-bell-outline"></i>
                     <span class="count-symbol bg-danger"></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <h6 class="p-3 mb-0">Notifications</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                 <i class="mdi mdi-calendar"></i>
                              </div>
                           </div>
                           <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                              <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-warning">
                                 <i class="mdi mdi-cog"></i>
                              </div>
                           </div>
                           <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                              <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-info">
                                 <i class="mdi mdi-link-variant"></i>
                              </div>
                           </div>
                           <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                              <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                     </div>
                  </li>
                  <li class="nav-item nav-logout d-none d-lg-block">
                     <a class="nav-link" href="#">
                     <i class="mdi mdi-power"></i>
                     </a>
                  </li>
                  <li class="nav-item nav-settings d-none d-lg-block">
                     <a class="nav-link" href="#">
                     <i class="mdi mdi-format-line-spacing"></i>
                     </a>
                  </li>
               </ul>
               <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
               <span class="mdi mdi-menu"></span>
               </button>
            </div>
         </nav>
         <br>
         <br>
         <!-- partial -->
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Users Table</h4>
                  <p class="card-description"> Liste des utilisateurs <code>.table-striped</code>
                  </p>
                  <div class="text-end mb-3">
            <a href="ajouteruser.php" class="btn btn-primary btn-lg">
               <i class="mdi mdi-account-plus"></i> Ajouter un utilisateur
            </a>
         </div>

                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Nom</th>
                           <th>Prénom</th>
                           <th>Email</th>
                           <th>Téléphone</th>
                           <th>Rôle</th>
                           <th>Supression</th>
                           <th>modification</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $user){ ?>
                        <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                           <td><?= htmlspecialchars($user['nom'])  ?></td>
                           <td><?= htmlspecialchars($user['prenom'])  ?></td>
                           <td><?= htmlspecialchars($user['email']) ?></td>
                           <td><?= htmlspecialchars($user['Tel']) ?></td>
                           <td><?= htmlspecialchars($user['role']) ?></td>
                           <td>
      <form method="POST" action="deleteuser.php" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
         <input type="hidden" name="id" value="<?= $user['id'] ?>">
         <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
      </form>
   </td>
   <td>
   <a href="modifieruser.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
</td>

                        </tr>
                        <?php  } ?>
                        <?php else: ?>
                        <tr>
                           <td colspan="5">Aucun utilisateur trouvé.</td>
                        </tr>
                        <?php endif; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/vendors/js/vendor.bundle.base.js"></script>
      <script src="assets/js/off-canvas.js"></script>
      <script src="assets/js/misc.js"></script>
      <script src="assets/js/settings.js"></script>
      <script src="assets/js/todolist.js"></script>
      <script src="assets/js/jquery.cookie.js"></script>
   </body>
</html>