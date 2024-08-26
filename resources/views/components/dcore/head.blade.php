<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{config('app.name')}}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/css/style.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/css/components.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
   <style>
/* custom.css */

/* Make sure dropdown menu stays inside screen */
.table-responsive {
    overflow-x: auto; /* Add horizontal scroll if needed */
}

/* Ensure dropdown menu has a high z-index */
.dropdown-menu {
    z-index: 1050 !important; /* Ensure dropdown appears on top */
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Add smooth scrolling for iOS */
    }
    
    .dropdown-menu {
        position: static; /* Position dropdown relative to its container */
        float: none;
    }
}
.password-field {
    cursor: pointer;
}

    </style>
</head>

<body>
