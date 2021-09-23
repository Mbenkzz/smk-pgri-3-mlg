    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <?php if(isAuthorized("OTHER")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "admin" ? "active" : "" : "active" ?>" href="<?= BASE_URL ?>admin-ea/admin">
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php endif ?>
          <?php if(isAuthorized("OTHER")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "users" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/users">
              Users
            </a>
          </li>
          <?php endif; ?>
          <?php if(isAuthorized("OTHER")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "department" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/department">
              Departemen
            </a>
          </li>
          <?php endif; ?>
          <?php if(isAuthorized("OTHER")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "jurusan" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/jurusan">
              Jurusan
            </a>
          </li>
          <?php endif; ?>
          <?php if(isAuthorized("BERITA")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "berita" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/berita">
              Berita
            </a>
          </li>
          <?php endif; ?>
          <?php if(isAuthorized("AGENDA")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "agenda" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/agenda">
              Agenda
            </a>
          </li>
          <?php endif; ?>
          <?php if(isAuthorized("OTHER")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "sosmed" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/sosmed">
              Sosial Media
            </a>
          </li>
          <?php endif; ?>
          <?php if(isAuthorized("OTHER")): ?>
          <li class="nav-item">
            <a class="nav-link <?= isset(explode("/", URI_STRING)[1]) ? explode("/", URI_STRING)[1] == "partner" ? "active" : "" : "" ?>" href="<?= BASE_URL ?>admin-ea/partner">
              Partner
            </a>
          </li>
          <?php endif; ?>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Other</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>admin-ea/admin/logout">
              <span data-feather="file-text"></span>
              Log Out
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              List 2
            </a>
          </li> -->
        </ul>
      </div>
    </nav>