<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">    
    .icon-bar {
        position: fixed;
        top: 50%;
        right: 0; 
        transform: translateY(-50%);
        z-index: 9999;
    }

    .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
    }

    .icon-bar a:hover {
        background-color: #000;
    }

    .facebook { background: #3B5998; }
    .twitter  { background: #55ACEE; }
    .google   { background: #dd4b39; }
    .linkedin { background: #007bb5; }
    .youtube  { background: #bb0000; }

    .content {
        margin-left: 75px;
        font-size: 30px;
    }

    /* ✅ HIDE icon bar on screens smaller than 600px */
    @media screen and (max-width: 600px) {
        .icon-bar {
            display: none;
        }
    }
</style>

<div class="icon-bar">
  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="#" class="google"><i class="fa fa-google"></i></a> 
  <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
  <a href="#" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>
