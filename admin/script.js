$(document).ready(function(){
    // Tambahkan event handler pada elemen dengan kelas "smooth-scroll"
    $(".smooth-scroll").on('click', function(event) {
      if (this.hash !== "") {
        // Mencegah tindakan default dari link
        event.preventDefault();
        // Ambil hash dari link
        var hash = this.hash;
        // Animasikan pergerakan scroll
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){
          // Setelah animasi selesai, tambahkan hash ke URL
          window.location.hash = hash;
        });
      }
    });
  });
  