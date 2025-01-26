 <!-- Footer -->
 <footer class="py-5 bg-dark text-white" id="footer">
     <div class="container">
         <div class="row g-4">
             <div class="col-md-3">
                 <h5 class="text-white">Wonderful Ternate</h5>
                 <p>{{ __('pesan.tagline') }}</p>
                 {{-- <p>{{ __('pesan.tagline_desc') }}</p> --}}
             </div>
             <div class="col-md-3 d-flex justify-content-center align-items-center flex-row" style="height: 100%;">
                 <img class="img-fluid" src="{{ asset('assets/Logo_WI_Final_20092017_WHITE_9a2b7d834c.png') }}"
                     alt="" width="200" />
                 {{-- <img class="img-fluid" src="{{ asset('assets/Logo_WI_Final_20092017_WHITE_9a2b7d834c.png') }}"
                    alt="" width="200" /> --}}
             </div>
             <div class="col-md-3 d-flex justify-content-center align-items-center flex-row" style="height: 100%;">
                 <img class="img-fluid" src="{{ asset('assets/WT NEW WHITE.png') }}" alt="" width="200" />
                 {{-- <img class="img-fluid" src="{{ asset('assets/Logo_WI_Final_20092017_WHITE_9a2b7d834c.png') }}"
                     alt="" width="200" /> --}}
             </div>
             <div class="col-md-3">
                 <iframe
                     src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.4408740907597!2d127.37726787447343!3d0.7881194631249376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x329cb3fd2a9df195%3A0x33a307b0c35a4dc6!2sDinas%20Pariwisata%20Kota%20Ternate!5e0!3m2!1sid!2sid!4v1735394373519!5m2!1sid!2sid"
                     width="100%" height="100%" style="border: 0" allowfullscreen="" loading="lazy"
                     referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div>
         </div>

         <!-- Social Media Section -->
         <div class="text-center mt-4 border-top border-secondary pt-3">
             <h5> {{ __('pesan.follow_us') }}</h5>
             <div class="d-flex justify-content-center gap-4 mt-3">
                 <!-- Facebook -->
                 <a href="https://www.facebook.com/61550834804227/photos/122225598386027826/?_rdr" target="_blank"
                     class="social-link">
                     <i class="bi bi-facebook social-icon facebook"></i>
                 </a>
                 <!-- Twitter -->
                 <a href="https://www.twitter.com" target="_blank" class="social-link">
                     <i class="bi bi-twitter social-icon twitter"></i>
                 </a>
                 <!-- Instagram -->
                 <a href="https://www.instagram.com/wonderfulternate" target="_blank" class="social-link">
                     <i class="bi bi-instagram social-icon instagram"></i>
                 </a>
                 <!-- YouTube -->
                 <a href="https://www.youtube.com/@wonderfulternate" target="_blank" class="social-link">
                     <i class="bi bi-youtube social-icon youtube"></i>
                 </a>
                 <!-- TikTok -->
                 <a href="https://www.tiktok.com/@wonderfulternate?_t=ZS-8swYWDlXfGy&_r=1" target="_blank"
                     class="social-link">
                     <i class="bi bi-tiktok social-icon tiktok"></i>
                 </a>
             </div>
         </div>

         <!-- Copyright Section -->
         <div class="text-center border-top border-secondary mt-4 pt-4">
             <p class="mb-0 text-white">
                 &copy; {{ __('pesan.copyright') }}
             </p>
         </div>
     </div>
 </footer>
