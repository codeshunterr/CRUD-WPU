<?php
require 'function.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Daftar pemilih</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Daftar pemilih Kaltim</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Kota/Kabupaten</div>
                        <!-- <a class="nav-link" href="balikpapan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Balikpapan
                        </a> -->
                        <button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#samarinda">
                            Samarinda
                        </button>

                        <button name="btg" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#bontang">
                            Bontang
                        </button>



                        <a class="nav-link" href="Logout.php">
                            <div></i></div>
                            logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $_GET['table']; ?></h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>jenis kelamin</th>
                                        <th>usia</th>
                                        <th>kecamatan</th>
                                        <th>desa</th>
                                        <th>TPS</th>
                                        <th>NO TELP</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php foreach ($table as $row) : ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row["nama"] ?></td>
                                            <td><?php echo $row["jenis_kelamin"] ?></td>
                                            <td><?php echo $row["usia"] ?></td>
                                            <td><?php echo $row["kecamatan"] ?></td>
                                            <td><?php echo $row["desa"] ?></td>
                                            <td><?php echo $row["TPS"] ?></td>
                                            <td><?php echo $row["no_telp"] ?></td>
                                            <td><?php echo $row["keterangan"] ?></td>
                                            <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row["id"]; ?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="idbarangygmaudihapus" value="<? $idb; ?>">
                                                <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#blasting<?= $row["id"]; ?>">
                                                    Delete
                                                </button> -->
                                                <a class="btn btn-primary" href="api.php/?nama=<?= $row['nama']; ?>&notelp=<?= $row['no_telp']; ?>">blast</a>
                                            </td>

                                        </tr>

                                        <?php $i++ ?>
                                        <!-- Edit Modal Modal -->
                                        <div class="modal fade" id="edit<?= $row["id"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit profile</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <label for="keterangan">keterangan</label>
                                                            <input id="keterangan" type="text" name="keterangan" value="<?= $row["keterangan"]; ?>" class="form-control">
                                                            <label for="no_telp">no telepon</label>
                                                            <input id="no_telp" type="text" name="no_telp" value="<?= $row["no_telp"]; ?>" class="form-control">
                                                            <br>
                                                            <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                                                            <button type="submit" class="btn btn-primary" name="updateketerangan">Submit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>

                                </tbody>
                            </table>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#blasting">
                                Blasting
                            </button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pdfreporting">
                                Pdf reporting
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                    <br>
                    <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="samarinda">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">query</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="get">
                <div class="modal-body">
                    <input type="hidden" name="table" value="samarinda">
                    <select name="desa" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>kelurahan...</option>
                        <option value="GUNUNG PANJANG">GUNUNG PANJANG</option>
                        <option value="TENUN SAMARINDA">TENUN SAMARINDA</option>
                        <option value="3">Three</option>
                    </select>
                    <br>

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="bontang">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">query</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="get">
                <div class="modal-body">
                    <input type="hidden" name="table" value="bontang">
                    <select name="desa" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>kelurahan...</option>
                        <option value="GUNUNG PANJANG">gunung panjang</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <br>

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="blasting">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">blasting</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="get" action="api.php" target="_bka">
                <div class="modal-body">
                    <input type="hidden" name="table" value="samarinda">
                    <select name="desa" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>kelurahan...</option>
                        <option value="GUNUNG PANJANG">gunung panjang</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <br>

                    <button type="submit" class="btn btn-primary" name="submitblasting">Submit</button>

                </div>
            </form>

        </div>
    </div>
</div>

</html>