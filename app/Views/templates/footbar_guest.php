<button id="scrollToTopBtn" class="btn btn-primary">↑</button>

<section class="bg-color1">
<div class="row pb-5" style="width: 100%;">
    <div class="col-md-4 pt-5">
        <div class="d-flex justify-content-center align-items-center mt-2">
            <img src="<?= base_url('images/logo-color2.png') ?>" alt="ecoworm" style="width:200px;">
        </div>
        <p class="text-center text-color2 mt-2">Sumber Brantas, Bumiaji, Batu</p>
    </div>
    <div class="col-md-4 pt-5">
        <div class="d-flex justify-content-center">
            <div>
                <p class="text-color2">Get to know us!</p>
                <hr class="text-color2">
                <a href="" class="text-decoration-none text-color2 d-block btn btn-sm btn-color2 px-3">About Us</a>
                <a href="" class="text-decoration-none text-color2 d-block btn btn-sm btn-color2 px-3 mt-2">Our Team</a>
                <a href="" class="text-decoration-none text-color2 d-block btn btn-sm btn-color2 px-3 mt-2">Developer Profile</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 pt-5">
        <div class="d-flex justify-content-center mb-3">
            <div>
                <p class="text-color2">Our social media:</p>
                <hr class="text-color2">
                <a href="" class="text-decoration-none text-color2 d-block"><i class="fab fa-instagram me-2"></i> instagram</a>
                <a href="" class="text-decoration-none text-color2 d-block"><i class="fab fa-facebook me-2"></i> facebook</a>
            </div>
        </div>
    </div>
</div>
<div class="row text-center bg-color3 d-flex justify-content-center align-items-center" style="width: 100%;">
    <p class="text-color2 fst-italic my-2">© wormvillage <?= date('Y') ?></p>
</div> 
</section>

<style>
#scrollToTopBtn { position: fixed; bottom: 20px; right: 20px; display: none; background-color: var(--color-1); color: white; border: none; border-radius: 50%; font-size: 20px; padding: 10px; cursor: pointer; z-index: 9999; width: 40px; height: 40px; justify-content: center; align-items: center; box-shadow: 0 0 5px rgba(0, 0, 0, 0.8); }
#scrollToTopBtn:hover { background-color: var(--color-3); }
</style>

<script>
window.onscroll = function() {
    var button = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        button.style.display = "flex";
    } else {
        button.style.display = "none";
    }
};

document.getElementById("scrollToTopBtn").onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>