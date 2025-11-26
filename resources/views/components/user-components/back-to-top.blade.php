<button class="button-btt" id="btnBackToTop" aria-label="Kembali ke atas" title="Kembali ke atas">
  <svg class="svgIcon" viewBox="0 0 384 512">
    <path
      d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
    ></path>
  </svg>
</button>

<style>
    .button-btt {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 99;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease, width 0.3s ease, background-color 0.3s ease;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgb(20, 20, 20);
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: #ffffff;
        cursor: pointer;
        overflow: hidden;
    }

    .button-btt.show {
        opacity: 1;
        visibility: visible;
    }

    .button-btt .svgIcon {
        width: 12px;
        transition-duration: 0.3s;
    }

    .button-btt .svgIcon path {
        fill: white;
    }

    .button-btt:hover {
        width: 140px;
        border-radius: 50px;
        background-color: #01baf2;
        align-items: center;
    }

    .button-btt:hover .svgIcon {
        transition-duration: 0.3s;
        transform: translateY(-200%);
    }

    .button-btt::before {
        position: absolute;
        bottom: -20px;
        content: "Back to Top";
        color: white;
        font-size: 0px;
    }

    .button-btt:hover::before {
        font-size: 13px;
        opacity: 1;
        bottom: unset;
        transition-duration: 0.3s;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnBackToTop = document.getElementById('btnBackToTop');

        if (btnBackToTop) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) { 
                    btnBackToTop.classList.add('show');
                } else {
                    btnBackToTop.classList.remove('show');
                }
            });

            btnBackToTop.addEventListener('click', (e) => {
                e.preventDefault(); 
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>