<?php
// File: index.php

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
    // Jika pengguna sudah login, arahkan ke halaman utama atau dashboard
    header('Location: dashboard.php');
    exit();
}

// Tampilkan splash screen
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Splash Screen</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    .splash-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #ffffff; /* Sesuaikan dengan warna latar belakang yang diinginkan */
      opacity: 0;
      animation: zoomIn 1.5s ease-out forwards;
    }

    .splash-container img {
      max-width: 100%;
      max-height: 100%;
      transform-origin: center center;
    }

    @keyframes zoomIn {
      from {
        opacity: 0;
        transform: scale(0.5); /* Set scale awal menjadi 0.5 */
      }
      to {
        opacity: 1;
        transform: scale(1); /* Set scale akhir menjadi 1 */
      }
    }

    @keyframes fullBackground {
      from {
        background-size: 50%; /* Set ukuran latar belakang awal menjadi 50% */
      }
      to {
        background-size: 100%; /* Set ukuran latar belakang akhir menjadi 100% */
      }
    }

    body.animation-complete .splash-container {
      animation: none; /* Hentikan animasi zoomIn setelah animasi fullBackground dimulai */
    }
 
    body.animation-complete {
      animation: fullBackground 1s ease-out forwards; /* Mulai animasi fullBackground setelah zoomIn selesai */
    }
  </style>
</head>
<body>
  <div class="splash-container">
    <img src="ondong.jpg" alt="Splash Image">
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      setTimeout(function () {
        // Menambahkan kelas untuk memberi tahu CSS bahwa animasi selesai
        document.body.classList.add('animation-complete');
        // Redirect to login page after 1 second (after fullBackground animation)
        setTimeout(function () {
          window.location.href = 'login.php';
        }, 1000);
      }, 3000);
    });
  </script>
</body>
</html>
