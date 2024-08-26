  <!-- General JS Scripts -->
  <script src="https://demo.getstisla.com/assets/modules/jquery.min.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/popper.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/tooltip.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/moment.min.js"></script>
  <script src="https://demo.getstisla.com/assets/js/stisla.js"></script>
  
  <!-- JS Libraries -->
  <script src="https://demo.getstisla.com/assets/modules/jquery.sparkline.min.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/chart.min.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="https://demo.getstisla.com/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="https://demo.getstisla.com/assets/js/page/index.js"></script>
  
  <!-- Template JS File -->
  <script src="https://demo.getstisla.com/assets/js/scripts.js"></script>
  <script src="https://demo.getstisla.com/assets/js/custom.js"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Copy to Clipboard Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var copyButtons = document.querySelectorAll('.copy-btn');

      copyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          var textToCopy = this.closest('tr').querySelector('#text-to-copy').innerText;

          var tempTextarea = document.createElement('textarea');
          tempTextarea.value = textToCopy;
          document.body.appendChild(tempTextarea);
          tempTextarea.select();
          document.execCommand('copy');
          document.body.removeChild(tempTextarea);

          alert('Text copied to clipboard: ' + textToCopy);
        });
      });
    });
  </script>

  <!-- Modal Remote Modem Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Handle the click event on the Remote Modem link
      $('#RemoteModem').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var ip = button.data('ip'); // Extract info from data-* attributes
        
        var modal = $(this);
        modal.find('#ipAddress').val(ip); // Update the modal's input fields
      });
    });
  </script>

  <script>
      $(document).ready(function () {
          $('#remoteModemForm').on('submit', function (e) {
              e.preventDefault();
              
              $.ajax({
                  url: $(this).attr('action'),
                  method: $(this).attr('method'),
                  data: $(this).serialize(),
                  success: function (response) {
                      if (response.success) { // Ganti `response.status` dengan `response.success` sesuai respons JSON
                          Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: response.message,
                              timer: 2000,
                              showConfirmButton: false
                          }).then(() => {
                            // Buka tab baru setelah SweetAlert selesai
                            window.open(response.url, '_blank');
                        });
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: response.message,
                          });
                      }
                  },
                  error: function (xhr, status, error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: 'Terjadi kesalahan dalam pengiriman data.',
                      });
                  }
              });
          });
      });
  </script>
  


  <script>
      $(document).ready(function () {
          // Listener for restart connection button click
          $('.restart-btn').on('click', function (e) {
              e.preventDefault();
              var url = $(this).attr('href');
  
              $.ajax({
                  url: url,
                  method: 'GET',
                  success: function (response) {
                      if (response.success) {
                          Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: response.message,
                              timer: 2000,
                              showConfirmButton: false
                          });
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: response.message
                          });
                      }
                  },
                  error: function (xhr, status, error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: 'Terjadi kesalahan dalam pengiriman data.',
                      });
                  }
              });
          });
      });
  </script>
  
  <!-- DataTable Initialization Script -->
  
<script>
  $(document).ready(function() {
      $('#myTable').DataTable({
          "autoWidth": false,
          "responsive": true, // Enable responsive feature
          "columnDefs": [
              { "width": "10%", "targets": 0 }, // Adjust width for columns
              { "width": "20%", "targets": 1 },
              { "width": "20%", "targets": 2 },
              { "width": "15%", "targets": 3 },
              { "width": "10%", "targets": 4 },
              { "width": "10%", "targets": 5 }
          ]
      });
  });
  
  </script>
  <script>
     $(document).ready(function() {
      $('#myTable2').DataTable({});
  });
  </script>
  <script>
    function updateScheduleTable() {
    $('#scheduleTable').DataTable().ajax.reload(null, false);
}

// Update table setiap detik
setInterval(updateScheduleTable, 10000); // Adjust the interval as needed

  </script>
   <script type="text/javascript">
    $(document).ready(function() {
        function reloadTable() {
            $('#table-container').load(location.href + " #myTable2", function() {
                // Inisialisasi ulang DataTable setelah table dimuat
                $('#myTable2').DataTable({
                    // Konfigurasi DataTable sesuai kebutuhan
                    destroy: true, // Menambahkan destroy agar DataTable bisa diinisialisasi ulang tanpa error
                });
            });
        }

        // Panggil fungsi reloadTable setiap 20 detik
        setInterval(reloadTable, 20000); // 20000 milliseconds = 20 seconds
        
        // Panggil sekali saat pertama kali halaman dimuat
        reloadTable();
    });
</script>

</body>
</html>
