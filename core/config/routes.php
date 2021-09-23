<?php

// $routes[controller/function] = uri_string

$routes[''] = "client";
$routes['home'] = "client/index";
$routes['news'] = "client/news";
$routes['events'] = "client/events";
$routes['berita'] = "client/berita";
$routes["berita/print"] = "berita/cetak_single";
$routes["berita/send"] = "client/update_count_view";
$routes['agenda'] = "client/agenda";
$routes['visi-misi'] = "client/visi_misi";
$routes['kontak'] = "client/contact";
$routes['departemen'] = "client/departemen";
$routes['jurusan'] = "client/jurusan";
$routes['comment'] = "client/comment";

$routes["admin-ea"] = "admin";
$routes["admin-ea/admin"] = "admin";
$routes["admin-ea/login"] = "admin/login";
$routes["admin-ea/logout"] = "admin/logout";

$routes["admin-ea/agenda"] = "agenda/index";
$routes["admin-ea/agenda/table"] = "agenda/table";
$routes["admin-ea/agenda/add"] = "agenda/add";
$routes["admin-ea/agenda/edit"] = "agenda/edit";
$routes["admin-ea/agenda/formprocess"] = "agenda/formprocess";
$routes["admin-ea/agenda/deleteprocess"] = "agenda/deleteprocess";
$routes["admin-ea/agenda/toggle"] = "agenda/toggle";
$routes["admin-ea/agenda/preview"] = "agenda/preview";
$routes["admin-ea/agenda/approve"] = "agenda/approve";
$routes["admin-ea/agenda/check"] = "agenda/check";

$routes["admin-ea/berita"] = "berita/index";
$routes["admin-ea/berita/table"] = "berita/table";
$routes["admin-ea/berita/add"] = "berita/add";
$routes["admin-ea/berita/edit"] = "berita/edit";
$routes["admin-ea/berita/formprocess"] = "berita/formprocess";
$routes["admin-ea/berita/deleteprocess"] = "berita/deleteprocess";
$routes["admin-ea/berita/toggle"] = "berita/toggle";
$routes["admin-ea/berita/preview"] = "berita/preview";
$routes["admin-ea/berita/approve"] = "berita/approve";
$routes["admin-ea/berita/check"] = "berita/check";
$routes["admin-ea/berita/print"] = "berita/cetak_single";
$routes["admin-ea/berita/tags"] = "berita/select_hashtag";

$routes["admin-ea/department"] = "department/index";
$routes["admin-ea/department/table"] = "department/table";
$routes["admin-ea/department/add"] = "department/add";
$routes["admin-ea/department/edit"] = "department/edit";
$routes["admin-ea/department/formprocess"] = "department/formprocess";
$routes["admin-ea/department/deleteprocess"] = "department/deleteprocess";
$routes["admin-ea/department/toggle"] = "department/toggle";

$routes["admin-ea/jurusan"] = "jurusan/index";
$routes["admin-ea/jurusan/table"] = "jurusan/table";
$routes["admin-ea/jurusan/add"] = "jurusan/add";
$routes["admin-ea/jurusan/edit"] = "jurusan/edit";
$routes["admin-ea/jurusan/formprocess"] = "jurusan/formprocess";
$routes["admin-ea/jurusan/deleteprocess"] = "jurusan/deleteprocess";
$routes["admin-ea/jurusan/toggle"] = "jurusan/toggle";

$routes["admin-ea/partner"] = "partner/index";
$routes["admin-ea/partner/table"] = "partner/table";
$routes["admin-ea/partner/add"] = "partner/add";
$routes["admin-ea/partner/edit"] = "partner/edit";
$routes["admin-ea/partner/formprocess"] = "partner/formprocess";
$routes["admin-ea/partner/deleteprocess"] = "partner/deleteprocess";
$routes["admin-ea/partner/toggle"] = "partner/toggle";

$routes["admin-ea/sosmed"] = "sosmed/index";
$routes["admin-ea/sosmed/table"] = "sosmed/table";
$routes["admin-ea/sosmed/add"] = "sosmed/add";
$routes["admin-ea/sosmed/edit"] = "sosmed/edit";
$routes["admin-ea/sosmed/formprocess"] = "sosmed/formprocess";
$routes["admin-ea/sosmed/deleteprocess"] = "sosmed/deleteprocess";
$routes["admin-ea/sosmed/toggle"] = "sosmed/toggle";

$routes["admin-ea/users"] = "users/index";
$routes["admin-ea/users/table"] = "users/table";
$routes["admin-ea/users/add"] = "users/add";
$routes["admin-ea/users/edit"] = "users/edit";
$routes["admin-ea/users/formprocess"] = "users/formprocess";
$routes["admin-ea/users/deleteprocess"] = "users/deleteprocess";
$routes["admin-ea/users/toggle"] = "users/toggle";
$routes["admin-ea/users/check"] = "users/check";