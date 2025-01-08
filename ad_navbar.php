<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One">

<style type="text/css">
img.resize  {
	width: 200px;
	height: 200px;
	border: 0;
}
.custom-font { /* เป็นของ CHAKAIMUK */
    font-family: Mochiy Pop One, serif;
    font-size: 50px;
    font-weight: bold; 
    color: #CD853F;
}
.custom-font1 { /*เป็นของ login*/ 
    font-family: Mochiy Pop One, serif;
    font-size: 40px;
    color: #CD853F;
}
.custom-font2 { /*เป็นของ username and password*/
    font-family: Mochiy Pop One, serif;
    color: #CD853F;
}
.custom-font3 { /*สำหรับปุ่ม register กับ login*/
    font-family: Mochiy Pop One, serif;
    color: #FF0000;
}
.custom-font4 {
    font-family: Mochiy Pop One, serif;
    color: #CD853F;
}
.navbar-toggler {
  border-color: #CD853F; /* กำหนดสีของขอบปุ่ม */
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3E%3Crect width='30' height='30' fill='%23ffffff'/%3E%3Cpath stroke='%23663300' stroke-width='3' d='M5 7h20M5 15h20M5 23h20'/%3E%3C/svg%3E");
  background-color: #ffffff; /* กำหนดพื้นหลังเป็นสีขาว */
}
.dropdown-menu {
    left: 0; /* ย้าย dropdown ไปทางซ้าย */
    right: auto; /* ปิดการใช้การกำหนดค่า right */
}
/* CSS สำหรับ hover */
.navbar-nav .nav-link:hover {
    color: #663300; /* เปลี่ยนสีข้อความ */
}
.dropdown-menu .dropdown-item:hover {
    color: #663300; /* เปลี่ยนสีข้อความเมื่อ hover */
    background-color: #F5DEB3; /* เพิ่มพื้นหลังอ่อนเพื่อความชัดเจน */
}
</style>

<nav class="navbar navbar-expand-sm connection bg-#663300 navbar-#663300 ">
  <div class="container-fluid">
    <a class="navbar-brand" href="ad_home.php">
    <img src="https://production-shopdit.s3.ap-southeast-1.amazonaws.com/ckm-logo-rec%404x-1659073848350" alt="Avatar Logo" style="width:70px;" class="rounded-pill">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link custom-font2" href="ad_home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-font2" href="ad_user_regis.php">User Risgister</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-font2" href="ad_user_manage.php">User Manage</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link custom-font2" href="ad_order.php">ORDER</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle custom-font2" href="#" role="button" data-bs-toggle="dropdown">UploadBanner&new</a>
          <ul class="dropdown-menu bg-white">
            <li><a class="dropdown-item custom-font2" href="ad_uploadbanner_main.php">UploadBanner</a></li>
            <li><a class="dropdown-item custom-font2" href="ad_editnews.php">New</a></li>
          </ul>
        </li> 
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle custom-font2" href="#" role="button" data-bs-toggle="dropdown">Product</a>
          <ul class="dropdown-menu bg-white">
            <li><a class="dropdown-item custom-font2" href="ad_allproduct.php">All product</a></li>
            <li><a class="dropdown-item custom-font2" href="ad_addproduct.php">Add product</a></li>
            <li><a class="dropdown-item custom-font2" href="ad_product_type.php">product Types</a></li>
          </ul>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle custom-font2" href="#" role="button" data-bs-toggle="dropdown">Mook</a>
          <ul class="dropdown-menu bg-white">
            <li><a class="dropdown-item custom-font2" href="all_mook.php">All Mook</a></li>
            <li><a class="dropdown-item custom-font2" href="add_mook.php">Add Mook</a></li>
          </ul>
        </li>
          <li>
            <a class="nav-link custom-font3" href="logout.php">Logout</a></li>
        </li>
      </ul>
    </div>
  </div>
</nav>

