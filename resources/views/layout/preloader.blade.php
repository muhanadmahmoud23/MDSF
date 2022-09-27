   <!-- Preloader -->
   <div class="loader">
       <div class="spinner-border text-light" role="status">
           <span class="sr-only">Loading...</span>
       </div>
   </div>

   <div class="overlay" id="overlay"></div>

<style>
.overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/images/spinner/grid.svg") center no-repeat;
}
/* Turn off scrollbar when body element has the loading class */
body.loading{
    overflow: hidden;   
}
/* Make spinner image visible when body element has the loading class */
body.loading .overlay{
    display: block;
}
</style>